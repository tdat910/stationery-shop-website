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
                'data:image/jpeg;base64,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',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxwkoMvUB4nJiwJd79zWrYbeS6C7s-HoRdEA&s',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0TBLs8mqsJmrJbdfm46F_qD4NOKeQuxcZvA&s',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrLmvlOVSwK_e0MEzZh7wSuRe9yq9Z6KGG_w&s',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzOs84X_z0wrAxnot-rpsJjMIngW9Gukgh0g&s',
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
        {{-- @php
            //  Danh sách tên các file hình ảnh lưu trong folder public/images
            $banners = [
                'banner5.jpg',
                'banner1.jpg',
                'banner2.jpg',
                'banner3.jpg',
                'banner4.jpg',
            ];
        @endphp
        
        <!-- Lặp qua danh sách tất cả hình ảnh banner -->
        @forelse($banners as $index => $banner)
            <!-- carousel-item: mỗi slide trong carousel -->
            <!-- {{ $index == 0 ? 'active' : '' }}: slide đầu tiên được hiển thị (active) -->
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <!-- src="/images/{{ $banner }}": đường dẫn đến file hình (vd: /images/banner.jpg) -->
                <!-- d-block w-100: hiển thị full width -->
                <!-- object-fit: cover: ảnh sẽ phủ toàn bộ chiều cao mà không bị méo -->
                <img src="/images/{{ $banner }}" class="d-block w-100" alt="Banner {{ $index + 1 }}" style="height: 350px; object-fit: cover;">
            </div>
        @empty
            <div class="carousel-item active">
                <div class="d-flex align-items-center justify-content-center h-100" style="color: white; font-size: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    Chưa có hình ảnh banner
                </div>
            </div>
        @endforelse
    </div> --}}
    <!-- Nút điều khiển carousel (Previous và Next) -->
    <!-- data-bs-target="#carouselBanner": chỉ tới carousel cần điều khiển -->
    <!-- data-bs-slide="prev/next": điều khiển slide trước/sau -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    <!-- carousel-indicators: các dấu chấm dưới cùng để chỉ slide hiện tại -->
    <div class="carousel-indicators">
        <!-- Lặp qua mỗi banner để tạo một dấu chấm -->
        @forelse($banners as $index => $banner)
            <!-- data-bs-slide-to="{{ $index }}": slide nào được nhấp -->
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

                <!-- ========== TAB ĐIỀU HƯỚNG ========== -->
                <!-- nav nav-tabs: tạo các tab điều hướng -->
                <!-- (Lưu ý: Hiện tại chỉ là demo, chưa có tính năng lọc thực sự) -->
                {{-- <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#">Tất cả</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mới nhất</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Bán chạy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Giá tốt nhất</a></li>
                </ul> --}}

                <!-- ========== LƯỚI SẢN PHẨM ========== -->
                <!-- row: hàng chứa các sản phẩm -->
                <div class="row">
                    <!-- Lặp qua 6 sản phẩm nổi bật của danh mục này -->
                    @foreach($featured_by_category[$category->id] as $product)
                        <!-- col-md-4: mỗi sản phẩm chiếm 33.33% (3 cột) -->
                        <div class="col-md-4 mb-4">
                            <!-- card: thẻ sản phẩm, h-100: chiều cao 100%, shadow-sm: bóng nhỏ, border-0: không viền -->
                            <div class="card h-100 shadow-sm border-0">
                                <!-- overflow-hidden: ẩn phần hình vượt quá kích thước -->
                                <div class="overflow-hidden" style="height: 200px; background: #f5f5f5;">
                                    <!-- Hình ảnh sản phẩm, nếu không có dùng placeholder -->
                                    <!-- object-fit: cover: hình ảnh phủ toàn bộ không bị méo -->
                                    <!-- onmouseover/onmouseout: khi di chuột, hình phóng to 5% -->
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