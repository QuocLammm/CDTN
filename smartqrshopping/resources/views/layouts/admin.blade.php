<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    @stack('styles')
    <title>@yield('title', 'Admin Dashboard')</title>
</head>
<body>
<div class="sidebar" id="sidebar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <div class="admin-info">
        <img src="{{ asset('images/avatar.png') }}" alt="Admin Avatar">
        <p>Admin Name</p>
    </div>
    <ul>
        <li data-page="dashboard"><a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: black;" >📊 Trang quản trị</a></li>
        <li data-page="customers"><a href="{{ route('customer.index') }}" style="text-decoration: none; color: black">👥 Khách hàng</a></li>
        <li data-page="categories"><a href="{{ route('categories.index') }}" style="text-decoration: none; color: black;">📂 Loại sản phẩm</a></li>
        <li data-page="products"><a href="{{ route('products.index') }}" style="text-decoration: none; color: black;">🛒 Sản phẩm</a></li>
        <li data-page="faq"><a href="{{ route('faqs.index') }}" style="text-decoration: none; color: black;">❓ FAQ</a></li>
        <li data-page="roles"><a href="{{ route('roles.index') }}" style="text-decoration: none; color: black;">❓ Phân quyền</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header" id="header">
        <button onclick="toggleSidebar()">☰</button>
        <div class="header-right">
            <button>🔔</button>
            <button>Đăng xuất</button>
        </div>
    </div>

    <!-- Nội dung trang con -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Lớp phủ mờ (ẩn mặc định) -->
    <div id="overlay" class="overlay"></div>

    <!-- Vòng tròn Loading (ẩn mặc định) -->
    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>
</div>

<script src="{{ asset('js/admin/script.js') }}"></script>
</body>
</html>
