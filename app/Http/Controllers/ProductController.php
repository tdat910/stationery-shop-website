<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function index(Request $request)
{
    $query = Product::query();

    // ✅ LỌC DANH MỤC (fix lỗi "tất cả")
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // ✅ TÌM KIẾM
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // ✅ SẮP XẾP GIÁ (bạn đang thiếu)
    if ($request->filled('sort')) {
        $query->orderBy('price', $request->sort);
    }

    $products = $query->paginate(12);
    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
