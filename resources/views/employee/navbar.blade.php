<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="" class="navbar-brand">
                <h1 class="m-0 text-secondary"><span class="text-primary">Track</span>Laundry</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('employeePages') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('orderan') }}" class="nav-item nav-link active">Orders</a>
                    <a href="{{ route('aboutEmployee') }}" class="nav-item nav-link">About</a>
                    <a href="{{ route('serviceEmployee') }}" class="nav-item nav-link">Services</a>
                    <a href="{{ route('pricingEmployee') }}" class="nav-item nav-link">Pricing</a>
                    <a href="{{ route('contactEmployee') }}" class="nav-item nav-link">Contact</a>
                    <li class="nav-item d-none d-sm-inline-block">
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link nav-item">
                                <p>              
                                    Logout
                                    <i class="fas fa-sign-out-alt"></i> 
                                </p>
                            </a>
                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                @csrf
                            </form>
                    </li>
                </div>
            </div>
        </nav>
    </div>
  </div>