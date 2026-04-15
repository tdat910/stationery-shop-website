<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\GeminiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    //Danh sách các AI
    // public function testAIModels()
    // {
    //     $apiKey = env('GEMINI_API_KEY');
    //     $response = Http::withoutVerifying()
    //         ->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

    //     if ($response->successful()) {
    //         $models = $response->json();
    //         dd($models); 
    //     }

    //     return "Lỗi gọi API: " . $response->status() . " - " . $response->body();
    // }

    /**
     * Hiển thị Trang chủ (Route: /home)
     * Tích hợp AI lấy danh sách sản phẩm gợi ý
     */
    public function home(GeminiService $geminiService)
    {
        $userId = auth()->id();
        $suggestedProducts = collect();

        // 1. Nếu đã đăng nhập, cố gắng lấy gợi ý từ Gemini AI
        if ($userId) {
            $mostViewed = DB::table('views')
                ->join('products', 'views.product_id', '=', 'products.id')
                ->where('views.user_id', $userId)
                ->select('products.id', 'products.name', DB::raw('count(*) as total'))
                ->groupBy('products.id', 'products.name')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get();

            if ($mostViewed->isNotEmpty()) {
                $viewHistory = $mostViewed->map(fn($item) => "- {$item->name} (xem {$item->total} lần)")->implode("\n");

                $productSelection = Product::limit(50)
                    ->get(['id', 'name'])
                    ->map(fn($p) => "ID:{$p->id} - {$p->name}")
                    ->implode("\n");

                $recommendedIds = $geminiService->getRecommendations($viewHistory, $productSelection);

                if (!empty($recommendedIds)) {
                    $suggestedProducts = Product::whereIn('id', $recommendedIds)
                        ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $recommendedIds) . ")"))
                        ->get();
                }
            }
        }

        // 2. MỞ KHÓA HIỂN THỊ: Fallback nếu AI lỗi, người dùng chưa đăng nhập, hoặc chưa có lịch sử xem
        if ($suggestedProducts->isEmpty()) {
            $suggestedProducts = $this->getAIRecommendationsFallback();
        }

        // 3. Xử lý biến $featured_by_category cho view home.blade.php
        $categories = Category::all();
        $featured_by_category = [];
        foreach ($categories as $category) {
            $featured_by_category[$category->id] = Product::where('category_id', $category->id)->latest()->take(4)->get();
        }

        return view('home', [
            'products' => Product::latest()->paginate(12),
            'suggestedProducts' => $suggestedProducts,
            'categories' => $categories,
            'featured_by_category' => $featured_by_category
        ]);
    }

    /**
     * Hiển thị danh sách tất cả sản phẩm với lọc và phân trang (Route: /products)
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('sort') && $request->sort != '') {
            $query->orderBy('price', $request->sort == 'asc' ? 'asc' : 'desc');
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Hiển thị chi tiết một sản phẩm (Route: /products/{id})
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all();

        // Ghi lại lượt xem
        DB::table('views')->insert([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('products.show', compact('product', 'categories'));
    }

    /**
     * Logic dự phòng nội bộ nếu không dùng được Gemini AI
     */
    private function getAIRecommendationsFallback()
    {
        $userId = auth()->id();
        
        if (!$userId) {
            // Nếu chưa đăng nhập: Gợi ý top sản phẩm mới nhất hoặc xem nhiều nhất
            return Product::inRandomOrder()->take(4)->get();
        }

        $topProductIds = DB::table('views')
            ->where('user_id', $userId)
            ->select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->pluck('product_id');

        $favoriteCategory = Product::whereIn('id', $topProductIds)
            ->select('category_id', DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->orderBy('count', 'desc')
            ->first();

        if ($favoriteCategory) {
            return Product::where('category_id', $favoriteCategory->category_id)
                ->whereNotIn('id', $topProductIds) 
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }

        return Product::inRandomOrder()->take(4)->get();
    }

}