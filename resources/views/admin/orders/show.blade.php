@extends('layouts.admin')

@section('page-title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Thông tin đơn hàng -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-receipt"></i> Chi tiết đơn hàng #{{ $order->id }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Thông tin khách hàng</h6>
                        <p class="mb-1"><strong>Tên:</strong> {{ $order->user->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                        <p class="mb-0"><strong>SĐT:</strong> {{ $order->user->phone ?? 'Chưa cập nhật' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Thông tin đơn hàng</h6>
                        <p class="mb-1"><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mb-1"><strong>Cập nhật:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}</p>
                        <p class="mb-1"><strong>Trạng thái:</strong>
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger'
                                ];
                                $statusLabels = [
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'shipped' => 'Đã giao',
                                    'delivered' => 'Đã nhận',
                                    'cancelled' => 'Đã hủy'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box"></i> Sản phẩm trong đơn hàng</h5>
            </div>
            <div class="card-body">
                @if($order->orderItems->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product)
                                                    @if($item->product->image)
                                                        <img src="{{ asset($item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="rounded me-3" width="50" height="50">
                                                    @endif
                                                    <div>
                                                        <strong>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</strong>
                                                        @if($item->product)
                                                            <br><small class="text-muted">{{ $item->product->category->name ?? '' }}</small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div>
                                                        <strong class="text-muted">Sản phẩm đã xóa</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                        <td class="fw-bold">{{ number_format($item->quantity * $item->price, 0, ',', '.') }}₫</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                    <td class="fw-bold text-success">{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}₫</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x mb-2"></i>
                        <p class="text-muted">Không có sản phẩm trong đơn hàng này</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Cập nhật trạng thái -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Cập nhật trạng thái</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái đơn hàng</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-admin w-100">
                        <i class="fas fa-save"></i> Cập nhật trạng thái
                    </button>
                </form>
            </div>
        </div>

        <!-- Thao tác -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-cogs"></i> Thao tác</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                    <button class="btn btn-info" onclick="window.print()">
                        <i class="fas fa-print"></i> In đơn hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection