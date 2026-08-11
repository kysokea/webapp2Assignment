<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="/storage/img/shoplogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-white"
            style="opacity: .8">
        <span class="brand-text font-weight-bold english-text">Coffee <span class="text-primary">IT</span></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ Auth::user()->avatar
    ? asset('storage/img/' . Auth::user()->avatar)
    : asset('storage/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"
                    style="width: 40px; height: 40px; object-fit: cover;">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->name }}
                </a>

                <small class="text-muted">
                    {{ Auth::user()->role }}
                </small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- Management --}}
                <li
                    class="nav-item {{ request()->is('user*') || request()->routeIs('customer.*') || request()->routeIs('products.*') || request()->routeIs('category.*') || request()->routeIs('sales.*') ? 'menu-open' : '' }}">

                    <a href="#"
                        class="nav-link {{ request()->is('user*') || request()->routeIs('customer.*') || request()->routeIs('products.*') || request()->routeIs('category.*') || request()->routeIs('sales.*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>
                            Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        {{-- User --}}
                        <li class="nav-item">
                            <a href="{{ url('user') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">

                                <i class="fa-solid fa-users nav-icon" style="color: rgb(116, 192, 252);"></i>

                                <p>User</p>
                            </a>
                        </li>

                        {{-- Customer --}}
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}"
                                class="nav-link {{ request()->routeIs('customer.*') ? 'active' : '' }}">

                                <i class="fa-solid fa-user nav-icon" style="color: rgb(116, 192, 252);"></i>

                                <p>Customer</p>
                            </a>
                        </li>

                        {{-- Product --}}
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                                class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

                                <i class="fa-solid fa-list nav-icon" style="color: rgb(116, 192, 252);"></i>

                                <p>Product</p>
                            </a>
                        </li>

                        {{-- Category --}}
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">

                                <i class="fa-solid fa-hashtag nav-icon" style="color: rgb(116, 192, 252);"></i>

                                <p>Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('sales.index') }}"
                                class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">

                                <i class="fa-solid fa-cart-shopping" style="color: rgb(116, 192, 252);"></i>

                                <p>Sale Details</p>
                            </a>
                        </li>

                        {{-- Sale --}}
                        <li class="nav-item">
                            <a href="{{ route('sales.index') }}"
                                class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">

                                <i class="fa-brands fa-shopify" style="color: rgb(116, 192, 252);"></i>

                                <p>Sale</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Product Sales
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('actions.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        

                    </ul>
                </li>

            </ul>
        </nav>
</aside>
