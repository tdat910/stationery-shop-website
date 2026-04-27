@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')

<div class="container mt-5">

    <!-- TIÊU ĐỀ -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Liên hệ với chúng tôi</h2>
        <p class="text-muted">Nếu bạn có câu hỏi, hãy gửi cho chúng tôi</p>
    </div>

    <!-- THÔNG BÁO -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <!-- FORM -->
        <div class="col-md-7">
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <textarea name="message" rows="5" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Gửi liên hệ
                </button>
            </form>
        </div>

        <!-- THÔNG TIN -->
        <div class="col-md-5">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">Thông tin liên hệ</h5>
                <p>📍 Địa chỉ: Đà Nẵng</p>
                <p>📞 Điện thoại: 0123 456 789</p>
                <p>📧 Email: support@gmail.com</p>
            </div>
        </div>

    </div>

</div>

@endsection