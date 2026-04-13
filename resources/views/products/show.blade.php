@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')

<div class="row">
    
    <div class="col-md-5">
        @if($product->image)
            <img src="{{ $product->image }}" class="img-fluid">
        @endif
    </div>

    <div class="col-md-7">
        <h3>{{ $product->name }}</h3>

        <p class="text-danger fs-4 fw-bold">
            {{ number_format($product->price) }} VND
        </p>

        <p>{{ $product->description }}</p>

        <button class="btn btn-success">Thêm vào giỏ</button>
    </div>

</div>

@endsection