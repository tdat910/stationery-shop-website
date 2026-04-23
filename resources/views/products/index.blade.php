@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')


@if(isset($keyword))
    <h5>Kết quả tìm kiếm cho: "{{ $keyword }}"</h5>
@endif

@if($products->isEmpty())
    <p>Không tìm thấy sản phẩm nào.</p>
@else
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>{{ $product->name }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<h3 class="mb-4">Danh sách sản phẩm</h3>
<!-- ========== PHẦN LỌC SẢN PHẨM ========== -->
<!-- row: hàng Bootstrap, mb-4: margin dưới 4 đơn vị -->
<div class="row mb-4">
    <!-- col-12: chiếm toàn bộ chiều rộng -->
    <div class="col-12">
        <div class="card p-3 mb-3 bg-light">
            <!-- row: hàng, 2 cột lọc -->
            <div class="row">
                <div class="col-md-6">
                    <!-- form method="get": gửi dữ liệu qua URL (không lưu mật khẩu) -->
                    <!-- action="{{ route('products.index') }}": gửi về trang /products -->
                    <form method="get" action="{{ route('products.index') }}">
                        <!-- onchange="this.form.submit()": khi thay đổi, tự động gửi form -->
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Tất cả danh mục --</option>
                            @forelse($categories as $category)
                                <!-- request('category') == $category->id: kiểm tra xem lựa chọn này có được chọn đợc không -->
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Form sắp xếp theo giá -->
                    <form method="get" action="{{ route('products.index') }}">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Sắp xếp theo --</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        </select>
                        <!-- Nếu đã chọn category, giữ lại khi sắp xếp -->
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($products->isEmpty())
    <p class="text-muted">Không có sản phẩm nào</p>
@else
<!-- ========== LƯỚI SẢN PHẨM ========== -->
<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="overflow-hidden" style="height: 200px; background: #f5f5f5;">
                    <!-- Ảnh sản phẩm -->
                    <!-- {{ $product->image ?: '...' }}: nếu không có ảnh, dùng placeholder -->
                    <img 
                        src="{{ $product->image ?: 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                        class="card-img-top"
                        style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.3s;"
                        alt="{{ $product->name }}"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'"
                    >
                </div>

                <!-- card-body: nội dung thẻ, text-center: canh giữa -->
                <div class="card-body text-center">
                    <!-- Tên sản phẩm, -webkit-line-clamp: 2 - giới hḞa 2 dòng -->
                    <h6 class="card-title text-truncate" style="font-size: 14px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $product->name }}
                    </h6>

                    <!-- Giá sản phẩm, text-danger: màu đỏ, fw-bold: đậm, number_format: định dạng số -->
                    <p class="text-danger fw-bold mb-2" style="font-size: 16px;">
                        {{ number_format($product->price) }} VND
                    </p>

                    <!-- Nút "Xem chi tiết", btn btn-sm: button nhỏ, btn-primary: nàu xanh -->
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- ========== PHÂN TRANG ========== -->
<div class="d-flex justify-content-center mt-5">
    {{ $products->appends(request()->query())->render('pagination::bootstrap-5') }}
</div>
@endif

@endsection