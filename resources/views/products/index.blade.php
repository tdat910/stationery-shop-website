@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')



<h3 class="mb-4">Danh sách sản phẩm</h3>
<!-- ========== PHẦN LỌC SẢN PHẨM ========== -->
<!-- row: hàng Bootstrap, mb-4: margin dưới 4 đơn vị -->
<div class="row mb-4">
    <!-- col-12: chiếm toàn bộ chiều rộng -->
    <div class="col-12">
        <!-- Tiêu đề phân trang -->
        
        <!-- card: thẻ chứa các bộ lọc, bg-light: nền xám nhạt -->
        <div class="card p-3 mb-3 bg-light">
            <!-- row: hàng, 2 cột lọc -->
            <div class="row">
                <!-- Cột 1: Lỏc theo danh mục -->
                <div class="col-md-6">
                    <!-- form method="get": gửi dữ liệu qua URL (không lưu mật khẩu) -->
                    <!-- action="{{ route('products') }}": gửi về trang /products -->
                    <form method="get" action="{{ route('products') }}">
                        <!-- form-select: style dropdown -->
                        <!-- onchange="this.form.submit()": khi thay đổi, tự động gửi form -->
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <!-- option value="": không chọn (hiển thị tất cả) -->
                            <option value="">-- Tất cả danh mục --</option>
                            <!-- Lặp qua từng danh mục -->
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
                <!-- Cột 2: Sắp xếp theo giá -->
                <div class="col-md-6">
                    <!-- Form sắp xếp theo giá -->
                    <form method="get" action="{{ route('products') }}">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Sắp xếp theo --</option>
                            <!-- asc: giá từ thấp đến cao -->
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <!-- desc: giá từ cao xuống thấp -->
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

<!-- Kiểm tra nếu không có sản phẩm (không có kến quả) -->
@if($products->isEmpty())
    <p class="text-muted">Không có sản phẩm nào</p>
@else
<!-- ========== LƯỚI SẢN PHẨM ========== -->
<!-- row: hàng chứa danh sách sản phẩm -->
<div class="row">
    <!-- Lặp mặt qua từng sản phẩm -->
    @foreach($products as $product)
        <!-- col-md-3: mỗi sản phẩm chiếm 25% (4 cột), mb-4: margin dưới -->
        <div class="col-md-3 mb-4">
            <!-- card: thẻ sản phẩm, h-100: chiều cao 100%, shadow-sm: bóng nhỏ, border-0: không viền -->
            <div class="card h-100 shadow-sm border-0">
                <!-- overflow-hidden: ảnh vượt quá sẽ bị ẩn -->
                <div class="overflow-hidden" style="height: 200px; background: #f5f5f5;">
                    <!-- Ảnh sản phẩm -->
                    <!-- {{ $product->image ?: '...' }}: nếu không có ảnh, dùng placeholder -->
                    <!-- object-fit: cover: ảnh sẽ phủ toàn bộ không bị méo -->
                    <!-- onmouseover/onmouseout: hình phóng to khi di chuột qua -->
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
<!-- d-flex: hiển thị theo hàng, justify-content-center: canh giữa -->
<div class="d-flex justify-content-center mt-5">
    <!-- $products->appends(request()->query()): giữ lại các bộ lọc khi chuyển trang -->
    <!-- render('pagination::bootstrap-5'): vẽ pagination dùng Bootstrap 5 -->
    <!-- Điều này hiển thị các nút: First, Previous, 1, 2, 3, ..., Next, Last -->
    {{ $products->appends(request()->query())->render('pagination::bootstrap-5') }}
</div>
@endif

@endsection