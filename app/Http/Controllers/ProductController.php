<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách tất cả sản phẩm
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Nếu có filter theo category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Nếu có sắp xếp theo giá
        if ($request->has('sort') && $request->sort != '') {
            if ($request->sort == 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'desc') {
                $query->orderBy('price', 'desc');
            }
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Hiển thị chi tiết một sản phẩm
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.show', compact('product', 'categories'));
    }
}
