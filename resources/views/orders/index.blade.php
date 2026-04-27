@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-shopping-bag"></i> Đơn hàng của tôi
    </h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Order ID & Date -->
                                <div class="col-md-3">
                                    <h6 class="mb-1">
                                        <strong>Đơn hàng #{{ $order->id }}</strong>
                                    </h6>
                                    <small class="text-muted">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>

                                <!-- Total Price -->
                                <div class="col-md-2">
                                    <h6 class="mb-1">Tổng tiền</h6>
                                    <strong class="text-danger">
                                        {{ number_format($order->total_price, 0, ',', '.') }}₫
                                    </strong>
                                </div>

                                <!-- Status -->
                                <div class="col-md-2">
                                    <h6 class="mb-1">Trạng thái</h6>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'shipped' => 'primary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'shipped' => 'Đã giao',
                                            'delivered' => 'Đã nhận',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </div>

                                <!-- Items Count -->
                                <div class="col-md-2">
                                    <h6 class="mb-1">Số sản phẩm</h6>
                                    <strong>{{ $order->orderItems->count() }}</strong>
                                </div>

                                <!-- Actions -->
                                <div class="col-md-3 text-end">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </a>
                                    @if($order->canBeCancelled())
                                        <button type="button" class="btn btn-sm btn-danger"
                                                onclick="cancelOrder({{ $order->id }})">
                                            <i class="fas fa-times"></i> Hủy
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
                        <h5 class="text-muted mb-3">Bạn chưa có đơn hàng nào</h5>
                        <p class="text-muted mb-4">Hãy bắt đầu mua sắm để tạo đơn hàng</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag"></i> Bắt đầu mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn hủy đơn hàng này? Hành động này không thể hoàn tác.</p>
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> Bạn chỉ có thể hủy những đơn hàng đang chờ xử lý hoặc đang xử lý.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="confirmCancel()">
                    <i class="fas fa-trash"></i> Xác nhận hủy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let cancelOrderId = null;

function cancelOrder(orderId) {
    cancelOrderId = orderId;
    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
    modal.show();
}

function confirmCancel() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
    modal.hide();

    fetch(`/orders/${cancelOrderId}/cancel`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            window.location.reload();
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại!');
    });
}
</script>
@endsection
