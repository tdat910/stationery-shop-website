@extends('layouts.admin')

@section('page-title', 'Quản lý sản phẩm')

@section('content')
<style>
/* Ẩn dấu mũi tên trong pagination ở cuối trang */
.page-pagination .page-link[aria-label="Previous"],
.page-pagination .page-link[aria-label="Next"] {
    display: none;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-box"></i> Danh sách sản phẩm</h5>

                @if($products->count() > 0 && $products->hasPages())
                    <div class="flex-grow-1 d-flex justify-content-center mx-3">
                        <div class="d-flex align-items-center">
                            @if($products->onFirstPage())
                                <span class="text-muted">« Previous</span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="text-decoration-none text-primary fw-bold">« Previous</a>
                            @endif
                            <span class="mx-2 text-muted">|</span>
                            @if($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="text-decoration-none text-primary fw-bold">Next »</a>
                            @else
                                <span class="text-muted">Next »</span>
                            @endif
                        </div>
                    </div>
                @endif

                <a href="{{ route('admin.products.create') }}" class="btn btn-admin">
                    <i class="fas fa-plus"></i> Thêm sản phẩm mới
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50" height="50" class="rounded">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                        </td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td class="text-success fw-bold">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                        <td>
                                            <span class="badge bg-success">Còn hàng</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination - chỉ hiển thị số trang -->
                    <div class="d-flex justify-content-center mt-4">
                        <div class="page-pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Chưa có sản phẩm nào</h5>
                        <p class="text-muted">Hãy thêm sản phẩm đầu tiên của bạn</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-admin">
                            <i class="fas fa-plus"></i> Thêm sản phẩm đầu tiên
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection