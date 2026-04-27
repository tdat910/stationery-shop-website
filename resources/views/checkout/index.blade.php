@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-receipt"></i> Thanh toán đơn hàng
    </h2>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Danh sách sản phẩm -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Chi tiết đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-end" style="width: 80px;">Giá</th>
                                    <th class="text-center" style="width: 80px;">Số lượng</th>
                                    <th class="text-end" style="width: 100px;">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if($item->product->image)
                                                    <img src="{{ asset($item->product->image) }}"
                                                         alt="{{ $item->product->name }}"
                                                         width="50" height="50" class="rounded">
                                                @endif
                                                <strong>{{ $item->product->name }}</strong>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($item->product->price, 0, ',', '.') }}₫
                                        </td>
                                        <td class="text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}₫
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-light">
                                    <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                    <td class="text-end fw-bold text-danger fs-5">
                                        {{ number_format($total, 0, ',', '.') }}₫
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Thanh toán -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin thanh toán</h5>
                </div>
                <div class="card-body">
                    <form id="checkoutForm">
                        @csrf

                        <!-- Thông tin khách hàng -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên khách hàng</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="tel" class="form-control" value="{{ $user->phone ?? 'Chưa cập nhật' }}" disabled>
                        </div>

                        <hr>

                        <!-- Địa chỉ giao hàng -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt"></i> Địa chỉ giao hàng *
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="4"
                                      placeholder="Nhập địa chỉ giao hàng chi tiết (tối thiểu 10 ký tự)"
                                      required></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Phương thức thanh toán -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Phương thức thanh toán *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="payment_cod" value="cod" checked>
                                <label class="form-check-label" for="payment_cod">
                                    <i class="fas fa-hand-holding-usd"></i> Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                       id="payment_bank" value="bank_transfer">
                                <label class="form-check-label" for="payment_bank">
                                    <i class="fas fa-university"></i> Chuyển khoản ngân hàng
                                </label>
                            </div>
                        </div>

                        <hr>

                        <!-- Tổng tiền -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Tổng thanh toán:</strong>
                                <strong class="text-danger fs-4">
                                    {{ number_format($total, 0, ',', '.') }}₫
                                </strong>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg" id="submitBtn">
                                <i class="fas fa-check-circle"></i> Xác nhận đặt hàng
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                            </a>
                        </div>

                        <small class="text-muted d-block mt-3">
                            <i class="fas fa-shield-alt"></i> Thông tin của bạn được bảo mật 100%
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-danger mb-3" role="status">
                    <span class="visually-hidden">Đang xử lý...</span>
                </div>
                <p class="mb-0">Đang xử lý đơn hàng của bạn...</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const address = document.getElementById('address').value;
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    // Validate address
    if (address.trim().length < 10) {
        alert('Vui lòng nhập địa chỉ giao hàng chi tiết (tối thiểu 10 ký tự)');
        return;
    }

    // Show loading
    const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
    loadingModal.show();

    fetch('{{ route("checkout.place-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            address: address,
            payment_method: paymentMethod,
        }),
    })
    .then(response => response.json())
    .then(data => {
        loadingModal.hide();

        if (data.status === 'success') {
            alert(data.message);
            window.location.href = data.redirect;
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => {
        loadingModal.hide();
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại!');
    });
});
</script>
@endsection
