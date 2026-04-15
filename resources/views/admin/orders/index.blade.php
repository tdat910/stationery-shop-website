@extends('layouts.admin')

@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Danh sách đơn hàng</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>
                                            <strong>{{ $order->user->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </td>
                                        <td class="text-success fw-bold">
                                            {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}₫
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="processing">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-play text-info"></i> Đang xử lý
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="shipped">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-truck text-primary"></i> Đã giao
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="delivered">
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-check text-success"></i> Đã nhận
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="cancelled">
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                                    <i class="fas fa-times"></i> Hủy đơn
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Chưa có đơn hàng nào</h5>
                        <p class="text-muted">Đơn hàng sẽ xuất hiện sau khi khách hàng đặt hàng</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection