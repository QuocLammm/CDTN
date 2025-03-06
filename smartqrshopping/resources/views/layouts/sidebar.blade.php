<aside>
    <div class="toggle">
        <div class="logo">
            <h2>TRUCDOAN<span class="danger">PHAM</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
        </div>
    </div>
    <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="material-icons-sharp">analytics</span>
            <h3>Trang Quản Trị</h3>
        </a>
        <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">person</span>
            <h3>Người dùng</h3>
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">inventory_2</span>
            <h3>Sản phẩm</h3>
        </a>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">category</span>
            <h3>Loại sản phẩm</h3>
        </a>
        <a href="{{ route('faqs.index') }}" class="{{ request()->routeIs('faqs.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">quiz</span>
            <h3>FAQ</h3>
        </a>
        <a href="{{ route('statics.index') }}" class="{{ request()->routeIs('statics.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">equalizer</span>
            <h3>Thống kê</h3>
        </a>
        <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index') ? 'active' : '' }}">
            <span class="material-icons-sharp">dashboard</span>
            <h3>Phân quyền</h3>
        </a>
        <a href="#" class="{{ request()->routeIs('logout') ? 'active' : '' }}">
            <span class="material-icons-sharp">logout</span>
            <h3>Đăng Xuất</h3>
        </a>
    </div>
</aside>
