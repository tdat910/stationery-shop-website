<!-- MAIN HEADER -->
<div class="bg-white shadow-sm py-3">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <div class="d-flex align-items-center gap-2">
            <img src="images/logo.jpg" alt="Logo" width="50">
            <strong>DTT Shop</strong>
        </div>

        <!-- SEARCH -->
        <div class="flex-grow-1 mx-4">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    {{-- <button class="btn btn-outline-secondary">🔍</button> --}}
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="d-flex align-items-center gap-3">

            <!-- CART -->
            <div style="position: relative;">
                🛒
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    0
                </span>
            </div>

            <!-- USER MENU -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        👤 {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/dashboard">Hồ sơ của tôi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <!-- LOGIN -->
                <a href="/login" class="btn btn-primary btn-sm">Đăng nhập</a>

                <!-- REGISTER -->
                <a href="/register" class="btn btn-outline-primary btn-sm">Đăng ký</a>
            @endauth

        </div>

    </div>
</div>

<!-- NAVBAR -->
<nav class="bg-light py-2 border-top border-bottom">
    <div class="container d-flex gap-4">
        <a href="/home" class="text-decoration-none text-dark">Trang chủ</a>
        {{-- <a href="/products" class="text-decoration-none text-dark">Danh mục sản phẩm</a> --}}
        <a href="/services" class="text-decoration-none text-dark">Dịch vụ</a>
        <a href="/contact" class="text-decoration-none text-dark">Liên hệ</a>
    </div>
</nav>

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
</div>
    </div>
</div>