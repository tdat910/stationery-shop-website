@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')

<h3 class="mb-4">Danh sách sản phẩm</h3>

@if($products->isEmpty())
    <p>Không có sản phẩm nào</p>
@else
<div class="row">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">

                <img 
                    src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300x200' }}" 
                    class="card-img-top"
                    style="height:200px; object-fit:cover;"
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
@endif

@endsection