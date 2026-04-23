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

<!-- Hiển thị hình ảnh banner trượt tự động -->
<div id="carouselBanner" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        @php
            // Danh sách link hình ảnh banner từ Google / Internet
            $banners = [
                'https://vppnguyenanh.com/wp-content/uploads/2018/08/banner1.png',
                'https://vanphongphamhanoi.net/wp-content/uploads/2023/03/van-phong-pham-quan-Ha-Dong-1.png',
                'https://png.pngtree.com/thumb_back/fw800/background/20220902/pngtree-rewritten-image-title-office-supplies-or-school-stationery-on-wooden-surface-photo-image_39041786.jpg',
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

<div class="container mb-5">
    <h3 class="mb-4">Gợi ý riêng cho bạn ✨</h3>
    <div class="row g-4"> 
        @foreach($suggestedProducts as $item)
            <div class="col-md-3 d-flex"> <div class="card w-100 shadow-sm"> <div style="height: 200px; overflow: hidden;">
                        <img src="{{ $item->image }}" 
                             class="card-img-top w-100 h-100" 
                             style="object-fit: contain; padding: 10px;" 
                             alt="{{ $item->name }}">
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fs-6" style="height: 3rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            {{ $item->name }}
                        </h5>
                        
                        <p class="text-danger fw-bold mt-auto mb-2">
                            {{ number_format($item->price) }}đ
                        </p>
                        
                        <a href="{{ route('products.show', $item->id) }}" class="btn btn-primary w-100">
                            Xem ngay
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mb-5">
    <h3 class="mb-4">Danh mục sản phẩm ✨</h3>
<!-- Bố cục 2 cột: col-lg-9 (chính) + col-lg-3 (sidebar) -->
<div class="row">
        @forelse($categories as $category)
            <!-- Kiểm tra nếu danh mục này có sản phẩm nổi bật -->
            @if($featured_by_category[$category->id]->count() > 0)
                <!-- ========== TIÊU ĐỀ DANH MỤC ========== -->
                <div class="mb-4">
                    <span class="badge bg-danger p-2" style="font-size: 14px;">
                        📦 {{ strtoupper($category->name) }}
                    </span>
                </div>

              
                <!-- row: hàng chứa các sản phẩm -->
                <div class="row">
                    <!-- Lặp qua 6 sản phẩm nổi bật của danh mục này -->
                    @foreach($featured_by_category[$category->id] as $product)
                        <!-- col-md-3: mỗi sản phẩm chiếm 25% (4 cột) -->
                        <div class="col-md-3 mb-3">
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
                                    <h6 class="card-title text-truncate" style="font-size: 14px; font-weight: 600; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $product->name }}
                                    </h6>
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
                <div class="text-center mt-3">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-primary fw-bold text-decoration-none">
                        Tất cả →
                    </a>
                </div>
            @endif
        @empty
            <p class="text-muted">Không có danh mục sản phẩm nào</p>
        @endforelse

<!-- ========== NÚT XEM TẤT CẢ SẢN PHẨM ========== -->
<div class="text-center mt-5 pt-4" style="border-top: 1px solid #ddd;">
    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
        Xem tất cả sản phẩm
    </a>
</div>
@endsection