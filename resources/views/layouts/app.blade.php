<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }

        /* Custom Carousel */
        .hero-carousel {
            height: 350px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .hero-carousel .carousel-inner {
            height: 100%;
        }

        .hero-carousel .carousel-item {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hero-carousel .carousel-item img {
            object-fit: cover;
            height: 100%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 45px;
            height: 45px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .carousel-indicators {
            bottom: -50px;
        }

        .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
        }

        .carousel-indicators .active {
            background-color: #007bff;
            width: 30px;
            border-radius: 5px;
        }

        /* Utilities */
        .text-danger {
            color: #dc3545 !important;
        }

        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- CONTENT --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Danh sách categories để lookup
        const categoryNames = {
            @foreach($all_categories as $category)
                {{ $category->id }}: '{{ $category->name }}',
            @endforeach
        };

        const sortLabels = {
            'asc': 'Giá tăng dần',
            'desc': 'Giá giảm dần'
        };

        function updateFilterDisplay() {
            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = urlParams.get('category');
            const sortValue = urlParams.get('sort');

            const filterDisplay = document.getElementById('filterDisplay');
            if (!filterDisplay) return;

            let displayText = '';

            if (categoryId || sortValue) {
                displayText = '<strong style="color: #333;">Đang lọc:</strong> ';
                const filters = [];

                if (categoryId) {
                    const categoryName = categoryNames[categoryId] || 'N/A';
                    filters.push(`Danh mục: <span style="color: #007bff;">${categoryName}</span>`);
                }

                if (sortValue) {
                    const sortLabel = sortLabels[sortValue] || 'N/A';
                    filters.push(`Sắp xếp: <span style="color: #007bff;">${sortLabel}</span>`);
                }

                displayText += filters.join(' | ');
            }

            filterDisplay.innerHTML = displayText;
        }

        function filterByCategory(categoryId) {
            const priceSort = document.getElementById('priceSort') ? document.getElementById('priceSort').value : '';
            const params = new URLSearchParams();

            if (categoryId) {
                params.append('category', categoryId);
            }
            if (priceSort) {
                params.append('sort', priceSort);
            }

            const url = `/products${params.toString() ? '?' + params.toString() : ''}`;
            window.location.href = url;
        }

        function filterByPrice(sort) {
            const categorySelect = document.querySelector('select[onchange="filterByCategory(this.value)"]');
            const categoryId = categorySelect ? categorySelect.value : '';
            const params = new URLSearchParams();

            if (categoryId) {
                params.append('category', categoryId);
            }
            if (sort) {
                params.append('sort', sort);
            }

            const url = `/products${params.toString() ? '?' + params.toString() : ''}`;
            window.location.href = url;
        }

        // Restore filter display on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateFilterDisplay();
        });
    </script>

</body>
</html>
