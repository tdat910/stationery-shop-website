@extends('layouts.app')

@section('title', 'Dịch vụ')

@section('content')

<div class="container mt-5">

    <!-- TIÊU ĐỀ -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Dịch vụ của chúng tôi</h2>
        <p class="text-muted">Chúng tôi cung cấp những dịch vụ tốt nhất cho bạn</p>
    </div>

    <div class="row">

        <!-- SERVICE 1 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">🚚 Giao hàng nhanh</h5>
                    <p class="text-muted">
                        Giao hàng toàn quốc, nhanh chóng và đảm bảo.
                    </p>
                </div>
            </div>
        </div>

        <!-- SERVICE 2 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">💳 Thanh toán tiện lợi</h5>
                    <p class="text-muted">
                        Hỗ trợ nhiều hình thức thanh toán an toàn.
                    </p>
                </div>
            </div>
        </div>

        <!-- SERVICE 3 -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">📞 Hỗ trợ 24/7</h5>
                    <p class="text-muted">
                        Luôn sẵn sàng hỗ trợ khách hàng mọi lúc.
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection