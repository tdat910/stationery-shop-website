<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $orders = Auth::user()
            ->orders()
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel order
     */
    public function cancel(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập!'], 401);
        }

        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Validate order can be cancelled
        if (!$order->canBeCancelled()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể hủy đơn hàng này! (Chỉ có thể hủy đơn đang chờ xử lý hoặc đang xử lý)',
            ], 400);
        }

        // Request validation - reason is required
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        // Update order status and add cancellation reason
        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $validated['reason'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Đơn hàng đã được hủy thành công!',
            'redirect' => route('orders.show', $order->id),
        ]);
    }
}
