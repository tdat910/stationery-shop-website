@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<h3 class="mb-4">Sản phẩm nổi bật</h3>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">

                @if($product->image)
                    <img src="{{ $product->image }}" class="card-img-top" style="height:200px; object-fit:cover;">
                @endif

                <div class="card-body text-center">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <p class="text-danger fw-bold">
                        {{ number_format($product->price) }} VND
                    </p>

                    <a href="/products/{{ $product->id }}" class="btn btn-primary btn-sm">
                        Xem chi tiết
                    </a>
                </div>

            </div>
        </div>
    @endforeach
</div>

@endsection