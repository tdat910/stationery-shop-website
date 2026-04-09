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

        // Restore dropdown values từ URL parameters khi page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = urlParams.get('category');
            const sortValue = urlParams.get('sort');
            
            // Restore category dropdown
            if (categoryId) {
                const categorySelect = document.querySelector('select[onchange="filterByCategory(this.value)"]');
                if (categorySelect) {
                    categorySelect.value = categoryId;
                }
            }
            
            // Restore price sort dropdown
            if (sortValue) {
                const priceSort = document.getElementById('priceSort');
                if (priceSort) {
                    priceSort.value = sortValue;
                }
            }
            
            // Hiển thị filter đang áp dụng
            updateFilterDisplay();
        });

        function updateFilterDisplay() {
            const urlParams = new URLSearchParams(window.location.search);
            const categoryId = urlParams.get('category');
            const sortValue = urlParams.get('sort');
            
            const filterDisplay = document.getElementById('filterDisplay');
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
            const priceSort = document.getElementById('priceSort').value;
            const params = new URLSearchParams();
            
            if (categoryId) {
                params.append('category', categoryId);
            }
            if (priceSort) {
                params.append('sort', priceSort);
            }
            
            const url = `/home${params.toString() ? '?' + params.toString() : ''}`;
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
            
            const url = `/home${params.toString() ? '?' + params.toString() : ''}`;
            window.location.href = url;
        }
    </script>




</body>
</html>