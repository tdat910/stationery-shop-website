<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display checkout form with address
     */
    public function showCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Get only selected items
        $cartItems = $cart->items()->with('product')->where('selected', true)->get();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn ít nhất một sản phẩm để tiếp tục!');
        }

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $user = Auth::user();

        return view('checkout.index', compact('cartItems', 'total', 'user'));
    }

    /**
     * Place order
     */
    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập!'], 401);
        }

        // Validate input
        $validated = $request->validate([
            'address' => 'required|string|max:500|min:10',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items()->count() === 0) {
            return response()->json(['message' => 'Giỏ hàng trống!'], 400);
        }

        // Get only selected items
        $cartItems = $cart->items()->with('product')->where('selected', true)->get();

        if ($cartItems->count() === 0) {
            return response()->json(['message' => 'Vui lòng chọn ít nhất một sản phẩm để tiếp tục!'], 400);
        }

        // Start transaction
        try {
            DB::beginTransaction();

            // Validate product availability and stock
            foreach ($cartItems as $item) {
                if (!$item->product) {
                    throw new \Exception('Sản phẩm ' . $item->id . ' không tồn tại!');
                }
            }

            // Calculate total
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'address' => $validated['address'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Remove only selected items from cart
            $cart->items()->where('selected', true)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Đơn hàng đã được đặt thành công!',
                'order_id' => $order->id,
                'redirect' => route('orders.show', $order->id),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi khi đặt hàng: ' . $e->getMessage(),
            ], 500);
        }
    }
}
