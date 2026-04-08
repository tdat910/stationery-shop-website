<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: url('/images/banner.jpg') center/cover no-repeat;
            height: 250px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    @include('partials.header')

    {{-- CONTENT --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>