<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng!');
        }

        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart ? $cart->items()->with('product')->get() : collect();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total', 'cart'));
    }

    /**
     * Add product to cart (AJAX)
     */
    public function addToCart(Request $request)
    {
        // Validate authentication
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập để mua hàng!'], 401);
        }

        // Validate input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:1000',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];

        // Get or create cart for user
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Check if product is already in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->increment('quantity', $quantity);
            $message = 'Đã cập nhật số lượng sản phẩm trong giỏ hàng!';
        } else {
            // Create new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $message = 'Đã thêm sản phẩm vào giỏ hàng thành công!';
        }

        // Get updated cart count
        $cartCount = $cart->items()->count();

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'cartCount' => $cartCount,
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeItem(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập!'], 401);
        }

        $validated = $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($validated['cart_item_id']);

        // Verify ownership
        if ($cartItem->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Không có quyền!'], 403);
        }

        $cartItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập!'], 401);
        }

        $validated = $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1|max:1000',
        ]);

        $cartItem = CartItem::findOrFail($validated['cart_item_id']);

        // Verify ownership
        if ($cartItem->cart->user_id !== Auth::id()) {
            return response()->json(['message' => 'Không có quyền!'], 403);
        }

        $cartItem->update(['quantity' => $validated['quantity']]);

        return response()->json([
            'status' => 'success',
            'message' => 'Đã cập nhật số lượng!',
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clearCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập!'], 401);
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa toàn bộ giỏ hàng!',
        ]);
    }
}
