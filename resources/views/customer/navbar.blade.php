<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5 fixed-top">
            <a href="" class="navbar-brand">
                <h1 class="m-0 text-secondary"><span class="text-primary">Track</span>Laundry</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('customerPages') }}" class="nav-item nav-link {{ Request::routeIs('customerPages') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('orderCustomer') }}" class="nav-item nav-link {{ Request::routeIs('orderCustomer') ? 'active' : '' }}">Orders</a>
                    <a href="{{ route('aboutCustomer') }}" class="nav-item nav-link {{ Request::routeIs('aboutCustomer') ? 'active' : '' }}">About</a>
                    <a href="{{ route('serviceCustomer') }}" class="nav-item nav-link {{ Request::routeIs('serviceCustomer') ? 'active' : '' }}">Services</a>
                    <a href="{{ route('pricingCustomer') }}" class="nav-item nav-link {{ Request::routeIs('pricingCustomer') ? 'active' : '' }}">Pricing</a>
                    <a href="{{ route('contactCustomer') }}" class="nav-item nav-link {{ Request::routeIs('contactCustomer') ? 'active' : '' }}">Contact</a>
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item nav-link">Logout <i class="fas fa-sign-out-alt"></i></a>
                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
