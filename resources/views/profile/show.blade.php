@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân - ' . Auth::user()->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Thông tin cá nhân</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Tên:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $user->phone ?: 'Chưa cập nhật' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Sở thích:</strong> {{ $user->preferences ?: 'Chưa cập nhật' }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Chỉnh sửa hồ sơ</a>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Đổi mật khẩu</button>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Địa chỉ giao hàng</h4>
            </div>
            <div class="card-body">
                @forelse($addresses as $address)
                    <div class="border p-3 mb-2">
                        <p>{{ $address->address_line }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}, {{ $address->country }}</p>
                        @if($address->is_default)
                            <span class="badge bg-success">Mặc định</span>
                        @endif
                        <form method="POST" action="{{ route('profile.delete-address', $address->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </div>
                @empty
                    <p>Chưa có địa chỉ nào.</p>
                @endforelse
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAddressModal">Thêm địa chỉ</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Đơn hàng gần đây</h4>
            </div>
            <div class="card-body">
                @forelse($orders as $order)
                    <div class="mb-3">
                        <p><strong>Đơn #{{ $order->id }}</strong> - {{ $order->status }}</p>
                        <p>{{ $order->created_at->format('d/m/Y') }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                    </div>
                @empty
                    <p>Chưa có đơn hàng nào.</p>
                @endforelse
                <a href="{{ route('orders.index') }}" class="btn btn-link">Xem tất cả đơn hàng</a>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.change-password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.add-address') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Địa chỉ</label>
                        <input type="text" name="address_line" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Thành phố</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tỉnh/Bang</label>
                        <input type="text" name="state" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Mã bưu điện</label>
                        <input type="text" name="zip_code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Quốc gia</label>
                        <input type="text" name="country" class="form-control" value="Vietnam" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_default" class="form-check-input" id="is_default">
                        <label class="form-check-label" for="is_default">Đặt làm địa chỉ mặc định</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm địa chỉ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection