@extends('layouts.admin')

@section('page-title', 'Chỉnh sửa danh mục')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Chỉnh sửa danh mục: {{ $category->name }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Thông tin bổ sung -->
                    <div class="mb-3">
                        <label class="form-label">Thông tin danh mục</label>
                        <div class="border rounded p-3 bg-light">
                            <small>
                                <strong>ID:</strong> {{ $category->id }}<br>
                                <strong>Số sản phẩm:</strong> {{ $category->products->count() }}<br>
                                <strong>Tạo lúc:</strong> {{ $category->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Cập nhật:</strong> {{ $category->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                        <div>
                            <button type="submit" class="btn btn-admin">
                                <i class="fas fa-save"></i> Cập nhật danh mục
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Sản phẩm trong danh mục -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box"></i> Sản phẩm trong danh mục</h5>
            </div>
            <div class="card-body">
                @if($category->products->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($category->products->take(10) as $product)
                            <div class="list-group-item px-0">
                                <div class="d-flex align-items-center">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                             class="rounded me-3" width="40" height="40">
                                    @endif
                                    <div class="flex-grow-1">
                                        <strong class="text-truncate" style="max-width: 200px;">{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ number_format($product->price, 0, ',', '.') }}₫</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($category->products->count() > 10)
                        <div class="text-center mt-3">
                            <small class="text-muted">... và {{ $category->products->count() - 10 }} sản phẩm khác</small>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-box-open text-muted fa-2x mb-2"></i>
                        <p class="text-muted mb-0">Chưa có sản phẩm nào</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection