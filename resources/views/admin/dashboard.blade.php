@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="alert alert-warning mt-4" role="alert">
        ⚙️ Xin chào Admin <strong>{{ Auth::user()->name }}</strong>! Bạn sẽ quay lại trang chủ trong 2 giây...
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = '/home';
    }, 2000);
</script>

@endsection
