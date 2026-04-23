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
                                    <th style="width: 40px;" class="text-center">
                                        <input type="checkbox" id="selectAll" class="form-check-input" onchange="toggleSelectAll()">
                                    </th>
                                    <th>Sản phẩm</th>
                                    <th style="width: 100px;">Giá</th>
                                    <th style="width: 140px;">Số lượng</th>
                                    <th style="width: 100px;">Thành tiền</th>
                                    <th style="width: 100px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="align-middle" id="row_{{ $item->id }}">
                                        <!-- Checkbox Selection -->
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input item-checkbox"
                                                   data-item-id="{{ $item->id }}"
                                                   {{ $item->selected ? 'checked' : '' }}
                                                   onchange="toggleSelected({{ $item->id }})">
                                        </td>

                                        <!-- Product Info -->
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product->image)
                                                    <img src="{{ asset($item->product->image) }}"
                                                         alt="{{ $item->product->name }}"
                                                         width="60" height="60" class="rounded object-fit-cover">
                                                @else
                                                    <div class="bg-light rounded p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div style="flex: 1;">
                                                    <h6 class="mb-2">
                                                        <a href="{{ route('products.show', $item->product->id) }}"
                                                           class="text-decoration-none text-dark">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h6>
                                                    @if($item->product->category)
                                                        <small class="text-muted d-block">
                                                            {{ $item->product->category->name }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td>
                                            <span class="text-danger fw-bold d-block">
                                                {{ number_format($item->product->price, 0, ',', '.') }}₫
                                            </span>
                                        </td>

                                        <!-- Quantity -->
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <button class="btn btn-sm btn-outline-secondary"
                                                        style="padding: 4px 8px; min-width: 36px; font-weight: bold;"
                                                        onclick="decreaseQty({{ $item->id }})"
                                                        title="Giảm số lượng">
                                                    <i class="fas fa-minus" style="font-size: 14px; margin-right: 2px;"></i>−
                                                </button>
                                                <input type="number" id="qty_{{ $item->id }}"
                                                       value="{{ $item->quantity }}" min="1" max="1000"
                                                       class="form-control form-control-sm text-center"
                                                       style="width: 50px; padding: 4px 6px; font-size: 13px;"
                                                       onchange="updateQuantity({{ $item->id }})"
                                                       title="Số lượng">
                                                <button class="btn btn-sm btn-outline-secondary"
                                                        style="padding: 4px 8px; min-width: 36px; font-weight: bold;"
                                                        onclick="increaseQty({{ $item->id }})"
                                                        title="Tăng số lượng">
                                                    <i class="fas fa-plus" style="font-size: 14px; margin-right: 2px;"></i>+
                                                </button>
                                            </div>
                                        </td>

                                        <!-- Subtotal -->
                                        <td>
                                            <span class="fw-bold d-block" id="subtotal_{{ $item->id }}">
                                                {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}₫
                                            </span>
                                        </td>

                                        <!-- Remove -->
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="removeItem({{ $item->id }})"
                                                    style="white-space: nowrap;">
                                                <i class="fas fa-trash"></i> Xóa
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
                        <h5 class="card-title mb-4">
                            <i class="fas fa-receipt"></i> Tóm tắt đơn hàng
                        </h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Sản phẩm chọn:</span>
                            <strong id="selected_count">0</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <span>Tổng tiền:</span>
                            <strong id="selected_total" class="text-danger">0₫</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-4 fs-5">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-danger" id="final_total">
                                <span id="total_amount">0</span>₫
                            </strong>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 mb-2" id="checkoutBtn">
                            <i class="fas fa-credit-card"></i> Tiến hành thanh toán
                        </a>

                        <button type="button" class="btn btn-outline-danger w-100" onclick="clearCart()">
                            <i class="fas fa-trash"></i> Xóa toàn bộ
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
// Hàm cập nhật tóm tắt đơn hàng
function updateOrderSummary() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    const selectedCount = checkboxes.length;

    let selectedTotal = 0;
    checkboxes.forEach(checkbox => {
        const itemId = checkbox.getAttribute('data-item-id');
        const subtotal = document.getElementById('subtotal_' + itemId).textContent.replace(/\D/g, '');
        selectedTotal += parseInt(subtotal) || 0;
    });

    document.getElementById('selected_count').textContent = selectedCount;
    document.getElementById('selected_total').textContent =
        new Intl.NumberFormat('vi-VN').format(selectedTotal) + '₫';
    document.getElementById('total_amount').textContent =
        new Intl.NumberFormat('vi-VN').format(selectedTotal);

    // Disable/enable checkout button
    const checkoutBtn = document.getElementById('checkoutBtn');
    if (selectedCount === 0) {
        checkoutBtn.disabled = true;
        checkoutBtn.classList.add('disabled');
    } else {
        checkoutBtn.disabled = false;
        checkoutBtn.classList.remove('disabled');
    }

    // Update select all checkbox
    const allCheckboxes = document.querySelectorAll('.item-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    selectAllCheckbox.checked = allCheckboxes.length === selectedCount && allCheckboxes.length > 0;
}

// Toggle select all
function toggleSelectAll() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const allCheckboxes = document.querySelectorAll('.item-checkbox');

    allCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
        const itemId = checkbox.getAttribute('data-item-id');
        // Make API call for each item to update database
        toggleSelected(itemId, false);
    });
}

// Toggle select individual item
function toggleSelected(itemId, skipApi = false) {
    if (skipApi) {
        updateOrderSummary();
        return;
    }

    const checkbox = document.querySelector(`input[data-item-id="${itemId}"]`);

    fetch('{{ route("cart.toggle-selected") }}', {
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
            updateOrderSummary();
        } else {
            checkbox.checked = !checkbox.checked; // Revert on error
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        checkbox.checked = !checkbox.checked; // Revert on error
    });
}

// Tăng số lượng
function increaseQty(itemId) {
    const input = document.getElementById('qty_' + itemId);
    input.value = parseInt(input.value) + 1;
    updateQuantity(itemId);
}

// Giảm số lượng
function decreaseQty(itemId) {
    const input = document.getElementById('qty_' + itemId);
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        updateQuantity(itemId);
    }
}

// Cập nhật số lượng
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
            // Fetch updated prices without full reload
            fetch('{{ route("cart.index") }}')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newSubtotal = doc.querySelector('#subtotal_' + itemId)?.textContent || '0₫';
                    document.getElementById('subtotal_' + itemId).textContent = newSubtotal;
                    updateOrderSummary();
                });
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Xóa sản phẩm
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
                document.getElementById('row_' + itemId).remove();
                updateOrderSummary();

                // Reload if cart is empty
                if (document.querySelectorAll('tbody tr').length === 0) {
                    location.reload();
                }
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Xóa toàn bộ giỏ hàng
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
                location.reload();
            } else {
                alert('Lỗi: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateOrderSummary();
});
</script>

<style>
.object-fit-cover {
    object-fit: cover !important;
}

.btn-sm {
    font-size: 12px;
}

/* Improve table readability */
table tbody tr td {
    vertical-align: middle;
    word-break: break-word;
}
</style>
@endsection
