<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyStore - E-Commerce')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container d-flex flex-column align-items-center">

            <!-- Logo + icon buttons -->
            <div class="w-100 d-flex justify-content-between align-items-center mb-2 px-2">
                <div class="d-flex align-items-center">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h2 class="logo mb-0"><i class="bi bi-shop"></i> MyStore</h2>
                    </a>
                </div>

                <div class="icon-buttons pe-3 pt-2 d-flex align-items-center">
                    <a href="{{ route('products.index') }}" class="text-dark">
                        <i class="fas fa-search me-3"></i>
                    </a>

                    @auth
                    <div class="dropdown d-inline-block">
                        <a href="#" class="text-dark dropdown-toggle" id="userIconDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-3"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userIconDropdown">
                            <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-box"></i> My Orders
                                </a>
                            </li>

                            @if(Auth::user()->isAdmin())
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Admin Panel
                                </a>
                            </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('cart.index') }}" class="text-dark position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger cart-badge">
                            {{ Auth::user()->cart->sum('quantity') }}
                        </span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="text-dark">
                        <i class="fas fa-user me-3"></i>
                    </a>
                    <a href="{{ route('login') }}" class="text-dark">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    @endauth

                    <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <!-- Free delivery / promo banner -->
            <div class="alert">
                <div class="container">
                    <marquee direction="left" scrollamount="6">
                        <span class="alert-text1">Free delivery for all orders $50+</span>
                        <span class="alert-text1">New arrivals are now in stock!</span>
                        <span class="alert-text1">Get 25% off on your first order</span>
                    </marquee>
                </div>
            </div>

            <!-- Nav links -->
            <div class="w-100">
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav d-flex flex-row flex-wrap justify-content-center gap-5" style="gap: 1cm;">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item dropdown position-static">
                            <a class="nav-link dropdown-toggle" href="{{ route('products.index') }}"
                                id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Products
                            </a>

                            @isset($navCategories)
                            <div class="dropdown-menu p-3 w-100" aria-labelledby="productsDropdown">
                                <div class="row">
                                    @foreach($navCategories->chunk(ceil($navCategories->count() / 4)) as $columnCategories)
                                    <div class="col-md-3">
                                        @foreach($columnCategories as $category)
                                        <a class="dropdown-item"
                                            href="{{ route('products.category', $category->slug) }}">
                                            <i class="bi bi-tag"></i> {{ $category->name }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endisset
                        </li>

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                        </li>
                        @endauth

                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">

                <!-- Brand -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h4 class="fw-bold">
                        <i class="bi bi-shop"></i> MyShop
                    </h4>
                    <p class="text-white-50">
                        Your trusted online fashion store.
                        Discover the latest trends with quality products
                        and a seamless shopping experience.
                    </p>

                    <div>
                        <a href="#" class="text-white me-3 fs-5">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#" class="text-white me-3 fs-5">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#" class="text-white me-3 fs-5">
                            <i class="bi bi-twitter-x"></i>
                        </a>

                        <a href="#" class="text-white fs-5">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>


                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        Quick Links
                    </h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">
                                Home
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">
                                Products
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ route('orders.index') }}" class="text-white-50 text-decoration-none">
                                My Orders
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('profile') }}" class="text-white-50 text-decoration-none">
                                Profile
                            </a>
                        </li>
                    </ul>
                </div>


                <!-- Customer Service -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        Customer Service
                    </h5>

                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2">
                            <i class="bi bi-truck"></i>
                            Fast Delivery
                        </li>

                        <li class="mb-2">
                            <i class="bi bi-arrow-repeat"></i>
                            Easy Return
                        </li>

                        <li class="mb-2">
                            <i class="bi bi-shield-check"></i>
                            Secure Payment
                        </li>

                        <li>
                            <i class="bi bi-headset"></i>
                            24/7 Support
                        </li>
                    </ul>
                </div>


                <!-- Contact -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="fw-bold mb-3">
                        Contact Us
                    </h5>

                    <p class="text-white-50 mb-2">
                        <i class="bi bi-geo-alt"></i>
                        Phnom Penh, Cambodia
                    </p>

                    <p class="text-white-50 mb-2">
                        <i class="bi bi-envelope"></i>
                        support@myshop.com
                    </p>

                    <p class="text-white-50">
                        <i class="bi bi-telephone"></i>
                        +855 964 944 571
                    </p>
                </div>

            </div>
        </div>


        <!-- Bottom Footer -->
        <div class="border-top border-secondary">
            <div class="container py-3">
                <div class="row">

                    <div class="col-md-6 text-center text-md-start">
                        <small class="text-white-50">
                            &copy; {{ date('Y') }} MyShop. All rights reserved.
                        </small>
                    </div>

                    <div class="col-md-6 text-center text-md-end">
                        <small>
                            <a href="#" class="text-white-50 text-decoration-none me-3">
                                Privacy Policy
                            </a>

                            <a href="#" class="text-white-50 text-decoration-none">
                                Terms & Conditions
                            </a>
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>