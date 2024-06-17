<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5 fixed-top">
            <a href="" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('img/logo_laundry.png') }}" alt="Laundry Logo" class="brand-image img-circle" style="opacity: 0.8; width: 50px; height: auto; margin-right: 10px;">
                <h1 class="m-0 text-secondary"><span class="text-primary">Track</span>Laundry</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('pages') }}" class="nav-item nav-link {{ Request::routeIs('pages') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link {{ Request::routeIs('about') ? 'active' : '' }}">About</a>
                    <a href="{{ route('services') }}" class="nav-item nav-link {{ Request::routeIs('services') ? 'active' : '' }}">Services</a>
                    <a href="{{ route('pricing') }}" class="nav-item nav-link {{ Request::routeIs('pricing') ? 'active' : '' }}">Pricing</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Contact</a>
                    @if (Auth::check())
                        @if (Auth::user()->role == 'Super-admin')
                            <li><a href="{{ route('admin') }}" class="nav-item nav-link">Admin</a></li>
                        @elseif (Auth::user()->role == 'Employee')
                            <li><a href="{{ route('employeePages') }}" class="nav-item nav-link">Employee</a></li>
                        @elseif (Auth::user()->role == 'Customer')
                            <li><a href="{{ route('customerPages') }}" class="nav-item nav-link">Customer</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="nav-item nav-link {{ Request::routeIs('login') ? 'active' : '' }}">Login</a></li>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
