@extends('layouts.app')

@section('title', 'Trang chủ - Cửa hàng đồ văn phòng phẩm')

@section('content')

<!-- FILTER -->
<div class="container mt-3">
    <div class="bg-white p-3 rounded shadow-sm">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <strong>☰ Bộ lọc:</strong>

            <div class="d-flex align-items-center gap-2">
                <label class="text-muted" style="font-size: 0.9rem;">Danh mục:</label>
                <select class="form-select w-auto" onchange="filterByCategory(this.value)" style="min-width: 200px;">
                    <option value="">Tất cả danh mục</option>
                    @foreach($all_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex align-items-center gap-2">
                <label class="text-muted" style="font-size: 0.9rem;">Giá:</label>
                <select class="form-select w-auto" id="priceSort" onchange="filterByPrice(this.value)" style="min-width: 180px;">
                    <option value="">Sắp xếp theo giá</option>
                    <option value="asc">Giá tăng dần</option>
                    <option value="desc">Giá giảm dần</option>
                </select>
            </div>

            <!-- Hiển thị filter đang áp dụng -->
            <div id="filterDisplay" style="margin-left: auto; font-size: 0.9rem; color: #666;">
                <!-- Script sẽ render tại đây -->
            </div>
        </div>
    </div>
</div> <br>

<!-- ========== PHẦN CAROUSEL BANNER ========== -->
<!-- Hiển thị hình ảnh banner trượt tự động -->
<!-- id="carouselBanner" - định danh của carousel -->
<!-- data-bs-ride="carousel" - tự động chạy carousel -->
<!-- hero-carousel - tên CSS tùy chỉnh trong app.blade.php -->
<div id="carouselBanner" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">
    <!-- carousel-inner - container chứa tất cả slide images -->
    <div class="carousel-inner">
        @php
            // Danh sách link hình ảnh banner từ Google / Internet
            $banners = [
                
            ];
        @endphp

        @forelse($banners as $index => $banner)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $banner }}" class="d-block w-100" alt="Banner {{ $index + 1 }}" style="height: 350px; object-fit: cover;">
            </div>
        @empty
            <div class="carousel-item active">
                <div class="d-flex align-items-center justify-content-center h-100" style="color: white; font-size: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    Chưa có hình ảnh banner
                </div>
            </div>
        @endforelse
    </div>
        
    <!-- Nút điều khiển carousel (Previous và Next) -->
    <!-- data-bs-slide="prev/next": điều khiển slide trước/sau -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    <!-- carousel-indicators: các dấu chấm dưới cùng để chỉ slide hiện tại -->
    <div class="carousel-indicators">
        @forelse($banners as $index => $banner)
          
            <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
        @empty
            <!-- Nếu không có banner nào, hiển thị một dấu chấm inactive -->
            <button type="button" class="active"></button>
        @endforelse
    </div>
</div>

<!-- ========== PHẦN NỘI DUNG CHÍNH ========== -->
<!-- row: hàng Bootstrap -->
<!-- Bố cục 2 cột: col-lg-9 (chính) + col-lg-3 (sidebar) -->
<div class="row">
    <!-- ========== CỘT CHÍNH (col-lg-9) ========== -->
    <!-- col-lg-9: chiếm 75% chiều rộng trên màn hình lớn -->
    <div class="col-lg-9">
        <!-- Lặp qua tất cả danh mục sản phẩm từ controller -->
        @forelse($categories as $category)
            <!-- Kiểm tra nếu danh mục này có sản phẩm nổi bật -->
            @if($featured_by_category[$category->id]->count() > 0)
            <!-- mb-5: margin dưới, pb-4: padding dưới, border-bottom: đường viền dưới -->
            <div class="mb-5 pb-4" style="border-bottom: 2px solid #e8e8e8;">
                <!-- ========== TIÊU ĐỀ DANH MỤC ========== -->
                <div class="mb-4">
                    <!-- badge: nhãn hiệu, bg-danger: màu đỏ, strtoupper: viết hoa tên danh mục -->
                    <span class="badge bg-danger p-2" style="font-size: 14px;">
                        📦 {{ strtoupper($category->name) }}
                    </span>
                </div>

              
                <!-- row: hàng chứa các sản phẩm -->
                <div class="row">
                    <!-- Lặp qua 6 sản phẩm nổi bật của danh mục này -->
                    @foreach($featured_by_category[$category->id] as $product)
                        <!-- col-md-4: mỗi sản phẩm chiếm 33.33% (3 cột) -->
                        <div class="col-md-4 mb-4">
                            <!-- card: thẻ sản phẩm, h-100: chiều cao 100%, shadow-sm: bóng nhỏ, border-0: không viền -->
                            <div class="card h-100 shadow-sm border-0">
                                <div class="overflow-hidden" style="height: 200px; background: #f5f5f5;">
                                    <img 
                                        src="{{ $product->image ?: 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                                        class="card-img-top"
                                        style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.3s;"
                                        alt="{{ $product->name }}"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'"
                                    >
                                </div>
                                <!-- card-body: nội dung thẻ, text-center: canh giữa -->
                                <div class="card-body text-center">
                                    <!-- Tên sản phẩm, -webkit-line-clamp: 2 - giới hạn 2 dòng -->
                                    <h6 class="card-title text-truncate" style="font-size: 14px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->name }}
                                    </h6>
                                    <!-- Giá sản phẩm, text-danger: màu đỏ, number_format: định dạng số (1000000 → 1.000.000) -->
                                    <p class="text-danger fw-bold mb-2" style="font-size: 16px;">
                                        {{ number_format($product->price) }} VND
                                    </p>
                                    <!-- Nút xem chi tiết, route('products.show', $product->id): link tới trang chi tiết -->
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Link "Xem tất cả sản phẩm" của danh mục này -->
                <!-- route('products'): đi tới trang danh sách sản phẩm -->
                <!-- ['category' => $category->id]: lọc theo danh mục này -->
                <div class="text-center mt-3">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-primary fw-bold text-decoration-none">
                        Tất cả →
                    </a>
                </div>
            </div>
            @endif
        @empty
            <p class="text-muted">Không có danh mục sản phẩm nào</p>
        @endforelse
    </div>

    <!-- ========== CỘT PHỤ (col-lg-3) - SIDEBAR SẢN PHẨM NỔI BẬT ========== -->
    <!-- col-lg-3: chiếm 25% chiều rộng trên màn hình lớn -->
    <div class="col-lg-3">
        <!-- bg-light: nền xám nhạt, p-4: padding đều 4 đơn vị -->
        <!-- position: sticky; top: 20px: sidebar không di chuyển khi cuộn trang -->
        <div class="bg-light p-4 rounded" style="position: sticky; top: 20px;">
            <!-- Tiêu đề sidebar -->
            <h5 class="fw-bold mb-4 pb-2" style="border-bottom: 2px solid #ddd;">
                🌟 Sản phẩm nổi bật
            </h5>

            <!-- Lặp qua 5 sản phẩm nổi bật (slice(0, 5): lấy 5 sản phẩm đầu tiên) -->
            @forelse($featured_products->slice(0, 5) as $product)
                <!-- d-flex: hiển thị theo hàng, gap-2: khoảng cách giữa các phần tử -->
                <div class="d-flex gap-2 mb-3 pb-3" style="border-bottom: 1px solid #e8e8e8;">
                    <!-- Ảnh sản phẩm 70x70 pixels -->
                    <!-- rounded: bo góc, overflow-hidden: ảnh vượt quá sẽ bị ẩn -->
                    <div class="rounded overflow-hidden flex-shrink-0" style="width: 70px; height: 70px; background: #f0f0f0;">
                        <!-- object-fit: cover: ảnh sẽ phủ toàn bộ kích thước -->
                        <img 
                            src="{{ $product->image ?: 'https://via.placeholder.com/70x70?text=No+Image' }}" 
                            class="w-100 h-100"
                            style="object-fit: cover;" 
                            alt="{{ $product->name }}"
                        >
                    </div>
                    <!-- flex-grow-1: phần còn lại chiếm hết chiều rộng -->
                    <div class="flex-grow-1">
                        <!-- Tên sản phẩm, -webkit-line-clamp: 2 - tối đa 2 dòng -->
                        <h6 class="small fw-bold mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $product->name }}
                        </h6>
                        <!-- Giá sản phẩm, small: chữ nhỏ -->
                        <p class="text-danger fw-bold small mb-1">
                            {{ number_format($product->price) }} VND
                        </p>
                        <!-- Link xem chi tiết -->
                        <a href="{{ route('products.show', $product->id) }}" class="text-primary text-decoration-none small fw-bold">
                            Xem →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted small">Chưa có sản phẩm nổi bật</p>
            @endforelse
        </div>
    </div>
</div>

<!-- ========== NÚT XEM TẤT CẢ SẢN PHẨM ========== -->
<!-- text-center: canh giữa, mt-5: margin-top lớn, pt-4: padding-top, border-top: đường viền trên -->
<div class="text-center mt-5 pt-4" style="border-top: 1px solid #ddd;">
    <!-- btn btn-primary: button xanh, btn-lg: button lớn -->
    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
        Xem tất cả sản phẩm
    </a>
</div>

@endsection