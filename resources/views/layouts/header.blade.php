<!-- MAIN HEADER -->
<div class="bg-white py-3 border-bottom">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <div class="d-flex align-items-center gap-2">
            <img src="images/logo1.png" alt="Logo" width="45" class="rounded-circle">
            <span class="fw-bold text-danger fs-5">DTT Shop</span>
        </div>

        <!-- SEARCH -->
        <div class="flex-grow-1 mx-4">
            <form action="{{ route('products.search') }}" method="GET">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="keyword"
                        class="form-control rounded-start-pill" 
                        placeholder="🔍 Tìm kiếm sản phẩm..."
                        value="{{ request('keyword') }}" >
                    <button class="btn btn-danger rounded-end-pill px-4">
                        Tìm
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT -->
        <div class="d-flex align-items-center gap-3">

            <!-- CART -->
            <div class="position-relative">
                <span class="fs-5">🛒</span>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    0
                </span>
            </div>

            <!-- USER -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                        👤 {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/dashboard">Hồ sơ</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Đăng xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm rounded-pill px-3">
                        Đăng nhập
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        Đăng ký
                    </a>
                @endauth
            </div>
         </div>
    </div>

<!-- NAVBAR -->
<nav class="bg-light py-2">
    <div class="container d-flex gap-3">

        <a href="/home"
           class="btn btn-sm {{ request()->is('home') ? 'btn-danger' : 'btn-outline-secondary' }}">
            Trang chủ
        </a>

        <a href="/services"
           class="btn btn-sm {{ request()->is('services') ? 'btn-danger' : 'btn-outline-secondary' }}">
            Dịch vụ
        </a>

        <a href="/contact"
           class="btn btn-sm {{ request()->is('contact') ? 'btn-danger' : 'btn-outline-secondary' }}">
            Liên hệ
        </a>
    </div>
</nav>