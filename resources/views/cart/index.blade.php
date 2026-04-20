@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn
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

    @if($cartItems->count() > 0)
        <div class="row">
            <!-- Danh sách sản phẩm -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th style="width: 100px;">Giá</th>
                                    <th style="width: 120px;">Số lượng</th>
                                    <th style="width: 100px;">Thành tiền</th>
                                    <th style="width: 80px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="align-middle">
                                        <!-- Product Info -->
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product->image)
                                                    <img src="{{ asset($item->product->image) }}"
                                                         alt="{{ $item->product->name }}"
                                                         width="60" height="60" class="rounded">
                                                @else
                                                    <div class="bg-light rounded p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-1">
                                                        <a href="{{ route('products.show', $item->product->id) }}"
                                                           class="text-decoration-none text-dark">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h6>
                                                    @if($item->product->category)
                                                        <small class="text-muted">
                                                            {{ $item->product->category->name }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="text-danger fw-bold">
                                            {{ number_format($item->product->price, 0, ',', '.') }}₫
                                        </td>

                                        <!-- Quantity -->
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm btn-outline-secondary" onclick="decreaseQty({{ $item->id }})">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" id="qty_{{ $item->id }}"
                                                       value="{{ $item->quantity }}" min="1" max="1000"
                                                       class="form-control form-control-sm text-center" style="width: 60px;"
                                                       onchange="updateQuantity({{ $item->id }})">
                                                <button class="btn btn-sm btn-outline-secondary" onclick="increaseQty({{ $item->id }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="fw-bold">
                                            <span id="subtotal_{{ $item->id }}">
                                                {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                            </span>₫
                                        </td>

                                        <!-- Remove -->
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger" onclick="removeItem({{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Continue Shopping -->
                <div class="mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Tóm tắt đơn hàng</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Số sản phẩm:</span>
                            <strong id="item_count">{{ $cartItems->count() }}</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span>Tổng tiền hàng:</span>
                            <strong id="subtotal_total">{{ number_format($total, 0, ',', '.') }}₫</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3 fs-5">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-danger">
                                <span id="total_amount">{{ number_format($total, 0, ',', '.') }}</span>₫
                            </strong>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 mb-2">
                            <i class="fas fa-credit-card"></i> Tiến hành thanh toán
                        </a>

                        <button type="button" class="btn btn-outline-danger w-100" onclick="clearCart()">
                            <i class="fas fa-trash"></i> Xóa giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                        <h5 class="text-muted mb-3">Giỏ hàng của bạn trống</h5>
                        <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- JavaScript -->
<script>
function increaseQty(itemId) {
    const input = document.getElementById('qty_' + itemId);
    input.value = parseInt(input.value) + 1;
    updateQuantity(itemId);
}

function decreaseQty(itemId) {
    const input = document.getElementById('qty_' + itemId);
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        updateQuantity(itemId);
    }
}

function updateQuantity(itemId) {
    const quantity = document.getElementById('qty_' + itemId).value;

    fetch('{{ route("cart.update-quantity") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            cart_item_id: itemId,
            quantity: quantity,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            location.reload();
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function removeItem(itemId) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
        fetch('{{ route("cart.remove-item") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                cart_item_id: itemId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                location.reload();
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function clearCart() {
    if (confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')) {
        fetch('{{ route("cart.clear") }}', {
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
                location.reload();
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection
