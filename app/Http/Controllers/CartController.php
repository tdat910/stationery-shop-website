<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // 1. Kiểm tra đăng nhập
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập để mua hàng!'], 401);
        }

        // 2. Validate dữ liệu
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // 3. Lấy hoặc tạo Giỏ hàng (Cart) cho User thông qua relationship
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // 4. Cập nhật hoặc thêm mới sản phẩm vào giỏ
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sản phẩm vào giỏ hàng thành công!'
        ]);
    }
}
