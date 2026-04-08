<!-- TOP BAR -->
{{-- <div class="bg-primary text-white py-1">
    {{-- <div class="container d-flex justify-content-between">
        <small>Miễn phí vận chuyển cho đơn hàng từ 200.000đ</small>
        <small>Hotline: 1900-xxxx</small>
    </div> --}}

<!-- MAIN HEADER -->
<div class="bg-white shadow-sm py-3">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <div class="d-flex align-items-center gap-2">
            {{-- <div class="bg-primary text-white rounded p-2">📘</div> --}}
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

            <!-- LOGIN -->
            <a href="/login" class="btn btn-primary btn-sm">Đăng nhập</a>

            <!-- REGISTER -->
            <a href="/register" class="btn btn-outline-primary btn-sm">Đăng ký</a>

        </div>

    </div>
</div>

<!-- NAVBAR -->
<nav class="bg-light py-2 border-top border-bottom">
    <div class="container d-flex gap-4">
        <a href="/" class="text-decoration-none text-dark">Trang chủ</a>
        <a href="/products" class="text-decoration-none text-dark">Danh mục sản phẩm</a>
        <a href="/services" class="text-decoration-none text-dark">Dịch vụ</a>
        <a href="/contact" class="text-decoration-none text-dark">Liên hệ</a>
    </div>
</nav>

<!-- FILTER -->
<div class="container mt-3">
    <div class="bg-white p-3 rounded shadow-sm d-flex align-items-center gap-3">

        <strong>☰ Bộ lọc:</strong>

        <select class="form-select w-auto">
            <option>Danh mục sản phẩm</option>

        </select>

        <select class="form-select w-auto">
            <option>Giá tăng dần</option>
            <option>Giá giảm dần</option>
        </select>

        {{-- <select class="form-select w-auto">
            <option>Tất cả</option>
        </select> --}}

    </div>
</div>