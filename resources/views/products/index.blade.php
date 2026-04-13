@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')

<div class="container">
    <h3 class="mb-4">Gợi ý riêng cho bạn ✨</h3>
    <div class="row">
        @foreach($suggestedProducts as $item)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ $item->image }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="text-danger">{{ number_format($item->price) }}đ</p>
                        <a href="{{ route('products.show', $item->id) }}" class="btn btn-primary">Xem ngay</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<h3 class="mb-4">Danh sách sản phẩm</h3>

@if($products->isEmpty())
    <p>Không có sản phẩm nào</p>
@else
<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">

                <img 
                    src="{{ $product->image ?: 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                    class="card-img-top"
                    style="height:200px; object-fit:cover;"
                    alt="{{ $product->name }}"
                >

                <div class="card-body text-center">
                    <h6>{{ $product->name }}</h6>

                    <p class="text-danger fw-bold">
                        {{ number_format($product->price) }} VND
                    </p>

                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">
                        Xem chi tiết
                    </a>
                </div>

            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $products->render('pagination::simple-bootstrap-4') }}
</div>
@endif

@endsection