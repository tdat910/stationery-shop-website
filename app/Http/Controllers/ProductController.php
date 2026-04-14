<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\GeminiService;

class ProductController extends Controller
{
    /**
     * Hiển thị trang chủ với carousel và danh sách sản phẩm
     * 
     * Phương thức này lấy dữ liệu cho trang chủ gồm:
     * - 5 sản phẩm ngẫu nhiên hiển thị ở sidebar "Sản phẩm nổi bật"
     * - Tất cả danh mục (categories)
     * - 6 sản phẩm ngẫu nhiên cho mỗi danh mục để hiển thị ở phần chính
     */
    public function home()
    {
        // Lấy 5 sản phẩm ngẫu nhiên cho sidebar "Sản phẩm nổi bật"
        // inRandomOrder(): sắp xếp ngẫu nhiên
        // limit(5): lấy tối đa 5 sản phẩm
        // get(): lấy kết quả
        $featured_products = Product::inRandomOrder()->limit(5)->get();
        
        // Lấy TẤT CẢ danh mục từ database
        $categories = Category::all();
        
        // Khởi tạo mảng rỗng để chứa sản phẩm nổi bật cho mỗi danh mục
        $featured_by_category = [];
        
        // Vòng lặp qua từng danh mục
        foreach ($categories as $category) {
            // Lấy 6 sản phẩm ngẫu nhiên cho danh mục này
            // where('category_id', $category->id): lọc theo category_id
            $featured_by_category[$category->id] = Product::where('category_id', $category->id)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        }
        
        // Gửi dữ liệu tới view home.blade.php
        // compact(): tạo mảng rồi gửi tới view
        return view('home', compact('featured_products', 'categories', 'featured_by_category'));
    }

    /**
     * Hiển thị danh sách tất cả sản phẩm với lọc và phân trang
     * 
     * Phương thức này:
     * - Lọc sản phẩm theo danh mục (nếu có)
     * - Sắp xếp theo giá (nếu có)
     * - Phân trang 12 sản phẩm trên mỗi trang
     * 
     * URL ví dụ: /products?category=1&sort=asc
     */

    //Danh sách các AI
    // public function index()
    // {
    //     $apiKey = env('GEMINI_API_KEY');
    //     // Gọi đến endpoint lấy danh sách models
    //     $response = \Illuminate\Support\Facades\Http::withoutVerifying()
    //         ->get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

    //     if ($response->successful()) {
    //         $models = $response->json();
    //         dd($models); // Dừng lại và hiển thị danh sách models
    //     }

    //     return "Lỗi gọi API: " . $response->status() . " - " . $response->body();
    // }

    public function index(Request $request, GeminiService $geminiService)
    {

        // Tạo query builder rỗng
        // $query = Product::query() này giống Product::where()
        $query = Product::query();
        
        // ========== LỌC THEO DANH MỤC ==========
        // Kiểm tra nếu người dùng chọn kategori
        // $request->has('category'): kiểm tra tham số URL có 'category' không
        // $request->category != '': kiểm tra giá trị không rỗng
        if ($request->has('category') && $request->category != '') {
            // Lọc sản phẩm theo category_id
            $query->where('category_id', $request->category);
        }
        
        // ========== SẮP XẾP THEO GIÁ ==========
        // Kiểm tra nếu có tham số sort
        if ($request->has('sort') && $request->sort != '') {
            // Nếu sort = 'asc': sắp xếp giá từ thấp đến cao
            if ($request->sort == 'asc') {
                $query->orderBy('price', 'asc');
            } 
            // Nếu sort = 'desc': sắp xếp giá từ cao xuống thấp
            elseif ($request->sort == 'desc') {
                $query->orderBy('price', 'desc');
            }
        }
        
        // ========== PHÂN TRANG ==========
        // paginate(12): hiển thị 12 sản phẩm/trang
        // Phương thức này tự động xử lý:
        // - Bỏ qua số sản phẩm đã xem (skip)
        // - Lấy đúng 12 sản phẩm tiếp theo (take)
        // - Tạo các link Previous/Next
        $products = $query->paginate(12);
        
        // Lấy tất cả danh mục để hiển thị ở dropdown lọc
        $categories = Category::all();
        
        // Gửi dữ liệu tới view products/index.blade.php
        return view('products.index', compact('products', 'categories'));
    

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
     * 
     * Phương thức này lấy sản phẩm theo ID và hiển thị trang chi tiết
     * findOrFail($id): tìm theo ID, nếu không tìm thấy sẽ hiển thị lỗi 404
     * 
     * URL ví dụ: /products/1
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
