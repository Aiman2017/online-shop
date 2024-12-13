<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('admin.dashboard')}}" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link @activeLink('admin.dashboard')">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link @activeLink('admin.categories.index')">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">{{ __('Category') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.brands.index') }}" class="nav-link @activeLink('admin.brands.index')">
                    <i class="link-icon" data-feather="bold"></i>
                    <span class="link-title">{{ __('Brands') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link @activeLink('admin.products.index')">
                    <i class="link-icon" data-feather="shopping-bag"></i>
                    <span class="link-title">{{ __('Products') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.banners.index') }}" class="nav-link @activeLink('admin.banners.index')">
                    <i class="link-icon" data-feather="sliders"></i>
                    <span class="link-title">{{ __('Banners') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link @activeLink('admin.orders.index')">
                    <i class="link-icon" data-feather="circle"></i>
                    <span class="link-title">{{ __('Orders') }}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
