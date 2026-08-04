
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            background: #ffffff;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 30px 25px;
            text-align: center;
            border-bottom: none;
        }

        .card-header .icon-wrapper {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            backdrop-filter: blur(10px);
        }

        .card-header .icon-wrapper i {
            font-size: 35px;
            color: #fff;
        }

        .card-header h3 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 28px;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 15px;
        }

        .card-body {
            padding: 35px 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-group label i {
            margin-right: 8px;
            color: #667eea;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f7fafc;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            background: #ffffff;
        }

        .form-control.is-invalid {
            border-color: #fc8181;
            background: #fff5f5;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 129, 129, 0.15);
        }

        .invalid-feedback {
            color: #fc8181;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .password-hint {
            font-size: 12px;
            color: #718096;
            margin-top: 5px;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            border-radius: 12px;
            width: 100%;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: #fff;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register i {
            margin-right: 8px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #4a5568;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            font-size: 14px;
        }

        .alert-danger {
            background: #fff5f5;
            color: #c53030;
            border-left: 4px solid #fc8181;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-danger ul li {
            margin-bottom: 3px;
        }

        .alert-success {
            background: #f0fff4;
            color: #276749;
            border-left: 4px solid #68d391;
        }

        .alert i {
            margin-right: 8px;
        }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #fc8181;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #f6ad55;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #68d391;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .card-header {
                padding: 25px 20px 20px;
            }

            .card-header h3 {
                font-size: 24px;
            }

            .card-body {
                padding: 25px 20px;
            }

            .card-header .icon-wrapper {
                width: 60px;
                height: 60px;
            }

            .card-header .icon-wrapper i {
                font-size: 28px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom checkbox */
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        /* Floating label effect */
        .form-floating-label {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card">
            <div class="card-header">
                <div class="icon-wrapper">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h3>Create Account</h3>
                <p>Join us and start shopping today</p>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">
                            <i class="bi bi-person"></i> Full Name
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter your full name"
                               required 
                               autofocus>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">
                            <i class="bi bi-envelope"></i> Email Address
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email"
                               required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Enter password (min 8 characters)"
                               required>
                        <div class="password-hint">
                            <i class="bi bi-info-circle"></i> Must be at least 8 characters
                        </div>
                        <!-- Password strength indicator -->
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="bi bi-check-circle"></i> Confirm Password
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirm your password"
                               required>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="terms" 
                                   name="terms" 
                                   required>
                            <label class="form-check-label" for="terms" style="font-weight: normal; font-size: 14px;">
                                I agree to the <a href="#" class="text-primary">Terms of Service</a> and 
                                <a href="#" class="text-primary">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-register" id="registerBtn">
                        <i class="bi bi-person-plus"></i> Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="login-link">
                        Already have an account? <a href="{{ route('login') }}">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            
            // Check password strength
            let strength = 0;
            
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]+/)) strength += 1;
            if (password.match(/[A-Z]+/)) strength += 1;
            if (password.match(/[0-9]+/)) strength += 1;
            if (password.match(/[$@#&!]+/)) strength += 1;
            
            // Update strength bar
            if (password.length === 0) {
                strengthBar.className = 'password-strength-bar';
                strengthBar.style.width = '0%';
            } else if (strength <= 2) {
                strengthBar.className = 'password-strength-bar weak';
            } else if (strength <= 3) {
                strengthBar.className = 'password-strength-bar medium';
            } else {
                strengthBar.className = 'password-strength-bar strong';
            }
        });

        // Form validation before submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms');
            const errorMessages = [];

            // Validate password match
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            // Validate password length
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long!');
                return false;
            }

            // Validate terms
            if (!terms.checked) {
                e.preventDefault();
                alert('Please agree to the Terms of Service and Privacy Policy.');
                return false;
            }

            // Show loading state
            const btn = document.getElementById('registerBtn');
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Creating Account...';
            btn.disabled = true;
        });

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>