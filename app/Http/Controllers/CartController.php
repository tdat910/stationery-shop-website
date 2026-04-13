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

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // 3. Lấy hoặc tạo Giỏ hàng (Cart) cho User
        // firstOrCreate sẽ tìm cart của user, nếu chưa có tự động tạo mới
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // 4. Kiểm tra sản phẩm đã có trong CartItem của giỏ hàng này chưa
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // Nếu có rồi thì tăng số lượng
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có thì tạo mới dòng sản phẩm trong giỏ
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sản phẩm vào giỏ hàng thành công!'
        ]);
    }
}
