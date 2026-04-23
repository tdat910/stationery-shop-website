@extends('layouts.admin')

@section('page-title', 'Chỉnh sửa người dùng')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Chỉnh sửa người dùng: {{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Tên -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Quyền <span class="text-danger">*</span></label>
                                <select class="form-select @error('role') is-invalid @enderror"
                                        id="role" name="role" required>
                                    <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Thông tin bổ sung -->
                            <div class="mb-3">
                                <label class="form-label">Thông tin tài khoản</label>
                                <div class="border rounded p-3 bg-light">
                                    <small>
                                        <strong>ID:</strong> {{ $user->id }}<br>
                                        <strong>Đăng ký:</strong> {{ $user->created_at->format('d/m/Y H:i') }}<br>
                                        <strong>Cập nhật:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}<br>
                                        @if($user->google_id)
                                            <strong>Google ID:</strong> {{ $user->google_id }}<br>
                                            <span class="badge bg-info"><i class="fab fa-google"></i> Google Account</span>
                                        @else
                                            <span class="badge bg-secondary">Local Account</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                        <div>
                            <button type="submit" class="btn btn-admin">
                                <i class="fas fa-save"></i> Cập nhật người dùng
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection