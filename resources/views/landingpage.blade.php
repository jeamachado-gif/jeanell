<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Modern Event Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --light-purple: #E9D5FF;
            --medium-purple: #C084FC;
            --dark-purple: #9333EA;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(147, 51, 234, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--dark-purple) !important;
            font-size: 1.5rem;
        }

        .btn-purple {
            background: var(--dark-purple);
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-purple:hover {
            background: #7E22CE;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(147, 51, 234, 0.3);
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--dark-purple);
            color: var(--dark-purple);
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            background: transparent;
            transition: all 0.3s;
        }

        .btn-outline-purple:hover {
            background: var(--dark-purple);
            color: white;
            transform: translateY(-2px);
        }

        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--light-purple) 0%, #FDFCFD 50%, var(--light-purple) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(192, 132, 252, 0.3) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark-purple);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.3rem;
            color: #6B7280;
            margin-bottom: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(147, 51, 234, 0.08);
            transition: all 0.3s;
            border: 1px solid rgba(147, 51, 234, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(147, 51, 234, 0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--light-purple);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--dark-purple), var(--medium-purple));
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px;
            border: 2px solid #E5E7EB;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--medium-purple);
            box-shadow: 0 0 0 3px rgba(192, 132, 252, 0.2);
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .stats-section {
            background: white;
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark-purple);
            display: block;
        }

        .stat-label {
            color: #6B7280;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Success & Error Notifications -->
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">EventHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item ms-3">
                        <button class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Log In
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1>Manage Events Effortlessly</h1>
                    <p>Create, organize, and manage events with our modern registration system. Simple, powerful, and designed for everyone.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Get Started
                        </button>
                        <button class="btn btn-outline-purple">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=600&fit=crop" alt="Event" class="img-fluid rounded" style="border-radius: 20px; box-shadow: 0 20px 60px rgba(147, 51, 234, 0.2);">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 stat-item">
                    <span class="stat-number">10K+</span>
                    <span class="stat-label">Events Created</span>
                </div>
                <div class="col-md-4 stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Active Users</span>
                </div>
                <div class="col-md-4 stat-item">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Satisfaction Rate</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5" style="background: #FAFAFA;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: var(--dark-purple); font-size: 2.5rem;">Why Choose EventHub?</h2>
                <p class="text-muted fs-5">Everything you need to manage successful events</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h4 class="fw-bold mb-3">Easy Registration</h4>
                        <p class="text-muted">Streamlined registration process for participants. Quick, simple, and user-friendly.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h4 class="fw-bold mb-3">Real-time Analytics</h4>
                        <p class="text-muted">Track registrations and engagement with powerful analytics dashboard.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h4 class="fw-bold mb-3">Secure & Reliable</h4>
                        <p class="text-muted">Enterprise-grade security to keep your event data safe and protected.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Create Your Account</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Create a password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option selected disabled>Select your role</option>
                                <option value="admin">Admin</option>
                                <option value="organizers">Organizer</option>
                                <option value="participant">Participant</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-purple w-100 mt-3">Register Now</button>
                        <div class="text-center mt-3">
                            <small class="text-muted">Already have an account? <a href="#" style="color: var(--dark-purple); font-weight: 600;" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Log in</a></small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Welcome Back</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option selected disabled>Select your role</option>
                                <option value="admin">Admin</option>
                                <option value="organizer">Organizer</option>
                                <option value="participant">Participant</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" style="color: var(--dark-purple); font-size: 0.9rem;">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-purple w-100">Log In</button>
                        <div class="text-center mt-3">
                            <small class="text-muted">Don't have an account? <a href="#" style="color: var(--dark-purple); font-weight: 600;" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Sign up</a></small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>