@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Sản phẩm</a></li>
            @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->id]) }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-5 mb-4">
            <div class="card">
                <div class="card-body p-0">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid w-100" style="max-height: 500px; object-fit: contain;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                            <i class="fas fa-image text-muted fa-5x"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-7">
            <!-- Category Badge -->
            @if($product->category)
                <span class="badge bg-secondary mb-3">{{ $product->category->name }}</span>
            @endif

            <!-- Product Name -->
            <h2 class="mb-3">{{ $product->name }}</h2>

            <!-- Price -->
            <div class="mb-3">
                <span class="text-danger fs-3 fw-bold">
                    {{ number_format($product->price, 0, ',', '.') }} VND
                </span>
                <br>
                <small class="text-muted">Giá có thể thay đổi tùy theo chính sách khuyến mãi</small>
            </div>

            <!-- Rating (optional) -->
            <div class="mb-4">
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star-half-alt text-warning"></i>
                <span class="ms-2 text-muted">(148 đánh giá)</span>
            </div>

            <hr>

            <!-- Description -->
            <div class="mb-4">
                <h5>Mô tả sản phẩm</h5>
                <p class="text-muted lh-lg">{{ $product->description }}</p>
            </div>

            <hr>

            <!-- Quantity & Add to Cart -->
            <div class="card bg-light mb-4">
                <div class="card-body">
                    <form id="addToCartForm">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Số lượng</label>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty()" style="min-width: 44px;">
                                    <i class="fas fa-minus"></i> −
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="1000"
                                       class="form-control text-center" style="width: 80px;">
                                <button type="button" class="btn btn-outline-secondary" onclick="increaseQty()" style="min-width: 44px;">
                                    <i class="fas fa-plus"></i> +
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if(Auth::check())
                            <button type="submit" class="btn btn-success btn-lg w-100 mb-2">
                                <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                                <i class="fas fa-eye"></i> Xem giỏ hàng
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-lg w-100 mb-2">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập để mua hàng
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Product Details Info -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin chi tiết</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>SKU:</strong> <span class="text-muted">{{ 'SKU-' . $product->id }}</span>
                        </li>
                        <li class="mb-2">
                            <strong>Danh mục:</strong>
                            @if($product->category)
                                <a href="{{ route('products.index', ['category' => $product->category->id]) }}" class="text-decoration-none">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span class="text-muted">Chưa phân loại</span>
                            @endif
                        </li>
                        <li>
                            <strong>Trạng thái:</strong> <span class="badge bg-success">Còn hàng</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="mt-5">
        <h4 class="mb-4">Sản phẩm liên quan</h4>
        @if($product->category && $product->category->products->count() > 1)
            <div class="row">
                @foreach($product->category->products->where('id', '!=', $product->id)->take(4) as $relatedProduct)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100">
                            @if($relatedProduct->image)
                                <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                     class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title" style="min-height: 3rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $relatedProduct->name }}
                                </h6>
                                <p class="text-danger fw-bold mt-auto mb-3">
                                    {{ number_format($relatedProduct->price, 0, ',', '.') }}₫
                                </p>
                                <a href="{{ route('products.show', $relatedProduct->id) }}" class="btn btn-primary btn-sm">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function increaseQty() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQty() {
    const input = document.getElementById('quantity');
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const quantity = document.getElementById('quantity').value;
    const productId = document.querySelector('input[name="product_id"]').value;

    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            // Reset form
            document.getElementById('quantity').value = 1;
        } else {
            alert('Lỗi: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection
