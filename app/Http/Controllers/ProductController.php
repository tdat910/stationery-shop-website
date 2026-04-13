<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\GeminiService;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách tất cả sản phẩm
     */
    public function index(Request $request, GeminiService $geminiService)
    {
        $userId = auth()->id();
        $suggestedProducts = collect();

        if ($userId) {
                // 1. Lấy lịch sử xem
                $mostViewed = \DB::table('views')
                    ->join('products', 'views.product_id', '=', 'products.id')
                    ->where('views.user_id', $userId)
                    ->select('products.id', 'products.name', \DB::raw('count(*) as total'))
                    ->groupBy('products.id', 'products.name')
                    ->orderBy('total', 'desc') 
                    ->limit(5)
                    ->get();

            // 2. Chỉ gọi AI nếu ĐÃ CÓ lịch sử xem
            if ($mostViewed->isNotEmpty()) {
                $viewHistory = $mostViewed->map(fn($item) => "- {$item->name} (xem {$item->total} lần)")->implode("\n");

                $productSelection = \App\Models\Product::limit(50) 
                    ->get(['id', 'name'])
                    ->map(fn($p) => "ID:{$p->id} - {$p->name}")
                    ->implode("\n");

                $recommendedIds = $geminiService->getRecommendations($viewHistory, $productSelection);
                
            // ĐẠT THÊM DÒNG NÀY ĐỂ XEM ID TRẢ VỀ LÀ GÌ:
            // dd($recommendedIds);

                if (!empty($recommendedIds)) {
                    $suggestedProducts = \App\Models\Product::whereIn('id', $recommendedIds)
                        ->orderByRaw(\DB::raw("FIELD(id, " . implode(',', $recommendedIds) . ")"))
                        ->get();
                }
            }
        }

        // 3. FIX CHỖ NÀY: Nếu sau tất cả mà vẫn chưa có gợi ý (do AI lỗi, hoặc chưa xem gì)
        // thì lấy đại 4 cái ngẫu nhiên/mới nhất để trang web không bị trống.
        // if ($suggestedProducts->isEmpty()) {
        //     $suggestedProducts = \App\Models\Product::inRandomOrder()->take(4)->get();
        // }

        return view('products.index', [
            'products' => \App\Models\Product::latest()->paginate(12),
            'suggestedProducts' => $suggestedProducts,
            'categories' => \App\Models\Category::all()
        ]);
    
    }
    /**
     * Hiển thị chi tiết một sản phẩm
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all();

        // Ghi lại lượt xem
        \DB::table('views')->insert([
            'product_id' => $id,
            'user_id' => auth()->id(), // null nếu chưa login
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('products.show', compact('product', 'categories'));
    }

    private function getAIRecommendations()
    {
        $userId = auth()->id();
        
        // Nếu chưa đăng nhập: Gợi ý top sản phẩm xem nhiều nhất toàn trang (Trending)
        if (!$userId) {
            return Product::withCount('views')
                ->orderBy('views_count', 'desc')
                ->take(4)
                ->get();
        }

        // Nếu đã đăng nhập: Thuật toán cá nhân hóa
        // 1. Tìm ID các sản phẩm user này xem nhiều nhất
        $topProductIds = \DB::table('views')
            ->where('user_id', $userId)
            ->select('product_id', \DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->pluck('product_id');

        // 2. Tìm Category mà user này quan tâm nhất (dựa trên lượt xem)
        $favoriteCategoryId = Product::whereIn('id', $topProductIds)
            ->select('category_id', \DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->orderBy('count', 'desc')
            ->first()?->category_id;

        // 3. Lấy sản phẩm gợi ý: Ưu tiên cùng Category yêu thích nhưng chưa xem nhiều
        return Product::where('category_id', $favoriteCategoryId)
            ->whereNotIn('id', $topProductIds) // Gợi ý cái mới chưa xem
            ->limit(4)
            ->get();
    }
}
