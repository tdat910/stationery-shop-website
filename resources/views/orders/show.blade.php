@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="container mt-4">
    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Quay lại danh sách đơn hàng
    </a>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Order Info -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt"></i> Đơn hàng #{{ $order->id }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Thông tin khách hàng</h6>
                            <p class="mb-1">
                                <strong>Tên:</strong> {{ $order->user->name }}
                            </p>
                            <p class="mb-1">
                                <strong>Email:</strong> {{ $order->user->email }}
                            </p>
                            <p class="mb-0">
                                <strong>SĐT:</strong> {{ $order->user->phone ?? 'Chưa cập nhật' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Thông tin đơn hàng</h6>
                            <p class="mb-1">
                                <strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-1">
                                <strong>Cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <strong>Trạng thái:</strong>
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
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-2">Địa chỉ giao hàng</h6>
                    <p class="text-muted mb-0">
                        <i class="fas fa-map-marker-alt"></i> {{ $order->address }}
                    </p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-box"></i> Chi tiết sản phẩm
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($order->orderItems->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-end">Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr class="align-middle">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($item->product)
                                                        @if($item->product->image)
                                                            <img src="{{ asset($item->product->image) }}"
                                                                 alt="{{ $item->product->name }}"
                                                                 width="50" height="50" class="rounded">
                                                        @else
                                                            <div class="bg-light rounded p-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fas fa-image text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $item->product->name }}</strong>
                                                            @if($item->product->category)
                                                                <br>
                                                                <small class="text-muted">{{ $item->product->category->name }}</small>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div>
                                                            <strong class="text-muted">Sản phẩm đã xóa</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-end fw-bold">
                                                {{ number_format($item->price, 0, ',', '.') }}₫
                                            </td>
                                            <td class="text-center">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="text-end fw-bold">
                                                {{ number_format($item->quantity * $item->price, 0, ',', '.') }}₫
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-light fw-bold">
                                        <td colspan="3" class="text-end">Tổng cộng:</td>
                                        <td class="text-end text-danger fs-5">
                                            {{ number_format($order->total_price, 0, ',', '.') }}₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center">
                            <p class="text-muted">Không có sản phẩm trong đơn hàng này</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Info -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-credit-card"></i> Thông tin thanh toán
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1">
                                <strong>Phương thức:</strong>
                                @if($order->payment_method === 'cod')
                                    Thanh toán khi nhận hàng (COD)
                                @elseif($order->payment_method === 'bank_transfer')
                                    Chuyển khoản ngân hàng
                                @else
                                    {{ $order->payment_method }}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1">
                                <strong>Trạng thái thanh toán:</strong>
                                <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'danger' }}">
                                    {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Tóm tắt</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Số sản phẩm:</span>
                        <strong>{{ $order->orderItems->count() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tiền hàng:</span>
                        <strong>{{ number_format($order->total_price, 0, ',', '.') }}₫</strong>
                    </div>
                    <div class="d-flex justify-content-between pb-2 border-bottom">
                        <span>Phí vận chuyển:</span>
                        <strong>Miễn phí</strong>
                    </div>
                    <div class="d-flex justify-content-between pt-2 fs-5">
                        <strong>Tổng cộng:</strong>
                        <strong class="text-danger">{{ number_format($order->total_price, 0, ',', '.') }}₫</strong>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @if($order->canBeCancelled())
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <p class="mb-3 text-muted small">
                            <i class="fas fa-info-circle"></i> Bạn vẫn có thể hủy đơn hàng này
                        </p>
                        <button type="button" class="btn btn-danger w-100" onclick="cancelOrder()">
                            <i class="fas fa-times-circle"></i> Hủy đơn hàng
                        </button>
                    </div>
                </div>
            @else
                @if($order->status === 'cancelled')
                    <div class="card bg-danger bg-opacity-10 mb-4">
                        <div class="card-body text-center">
                            <p class="text-danger mb-0">
                                <i class="fas fa-check-circle"></i> Đơn hàng đã được hủy
                            </p>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Help -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-question-circle"></i> Hỗ trợ
                    </h5>
                </div>
                <div class="card-body">
                    <p class="small mb-3">
                        Nếu bạn có bất kỳ câu hỏi nào về đơn hàng này, vui lòng liên hệ với chúng tôi.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-envelope"></i> Liên hệ hỗ trợ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hủy đơn hàng #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn hủy đơn hàng này? Hành động này không thể hoàn tác.</p>
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
function cancelOrder() {
    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
    modal.show();
}

function confirmCancel() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('cancelModal'));
    modal.hide();

    fetch(`/orders/{{ $order->id }}/cancel`, {
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
