<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
    public function index(Request $request)
    {
        // Tạo query builder rỗng
        // $query = Product::query() này giống Product::where()
        $query = Product::query();
        
        // ========== LỏC THEO DANH MỤC ==========
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
        // Tìm sản phẩm theo ID
        // findOrFail(): nếu không tìm thấy sẽ throw exception 404
        $product = Product::findOrFail($id);
        
        // Lấy tất cả danh mục (để hiển thị ở các menu)
        $categories = Category::all();
        
        // Gửi dữ liệu tới view products/show.blade.php
        return view('products.show', compact('product', 'categories'));
    }
}
