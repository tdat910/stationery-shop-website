@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        🎉 Admin Dashboard
                    </h4>
                </div>
                <div class="card-body">
                    <h5>Chào mừng, <strong>{{ Auth::user()->name }}</strong>!</h5>
                    <p class="text-muted mb-0">Đây là trang admin dành cho các nhà quản lý hệ thống.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">📊 Thống kê</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tổng sản phẩm
                            <span class="badge bg-primary rounded-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tổng đơn hàng
                            <span class="badge bg-success rounded-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tổng người dùng
                            <span class="badge bg-info rounded-pill">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">⚙️ Quản lý</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            📦 Quản lý sản phẩm
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            🛒 Quản lý đơn hàng
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            👥 Quản lý người dùng
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            🏷️ Quản lý danh mục
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📝 Thông tin account</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Tên:</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Role:</th>
                            <td>
                                @if(Auth::user()->role == 1)
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
