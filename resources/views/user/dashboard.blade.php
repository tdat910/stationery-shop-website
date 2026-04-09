@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container">
    <div class="alert alert-success mt-4" role="alert">
        ✅ Chào mừng <strong>{{ Auth::user()->name }}</strong>! Đăng nhập thành công.
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = '/home';
    }, 1000);
</script>

@endsection
