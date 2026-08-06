<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyStore - E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-shop"></i> MyStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item position-relative me-2">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                        <span class="badge bg-danger cart-badge">
                            {{ Auth::user()->cart->sum('quantity') }}
                        </span>
                        </a>


                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <!-- Profile -->
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person"></i> My Profile
                                </a>
                            </li>


                            <!-- Orders -->
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-box"></i> My Orders
                                </a>
                            </li>


                            @if(Auth::user()->isAdmin())

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Admin Panel
                                </a>
                            </li>

                            @endif


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <!-- Logout -->
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>

                                </form>
                            </li>

                        </ul>
                        @if(Auth::user()->isAdmin())
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Admin Panel
                        </a></li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>

                @endauth
                </ul>
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
                            © {{ date('Y') }} MyShop. All rights reserved.
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