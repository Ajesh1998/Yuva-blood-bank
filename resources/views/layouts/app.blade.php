<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yuva Blood Bank - Donor Management System')</title>
    
    <!-- Favicon and App Icons -->
    <link rel="icon" type="image/jpeg" href="{{ asset('yuva.jpg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('yuva.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('yuva.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('yuva.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="32x32" href="{{ asset('yuva.jpg') }}">
    <link rel="icon" type="image/jpeg" sizes="16x16" href="{{ asset('yuva.jpg') }}">
    <meta name="msapplication-TileImage" content="{{ asset('yuva.jpg') }}">
    <meta name="msapplication-TileColor" content="#dc3545">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    @yield('head')
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            max-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            z-index: 1000;
            transition: all 0.3s ease;
            border-right: 3px solid rgba(220, 53, 69, 0.3);
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        /* Custom Scrollbar for Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #c82333 0%, #e8690b 100%);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }
        
        .sidebar::-webkit-scrollbar-thumb:active {
            background: linear-gradient(135deg, #a71e2a 0%, #d15608 100%);
        }
        
        /* Firefox Scrollbar */
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: #dc3545 rgba(0, 0, 0, 0.1);
        }
        
        /* Sidebar Content Wrapper */
        .sidebar-content {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 18px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s ease;
            position: relative;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 15px;
            margin: 2px 8px;
            border-radius: 12px;
            border-bottom: none;
        }
        
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.15) 0%, rgba(253, 126, 20, 0.15) 100%);
            color: #fff;
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
            border-left: 4px solid #dc3545;
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: #fff;
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            transform: translateX(8px);
            border-left: 4px solid #fff;
        }
        
        .sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 12px solid #dc3545;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
        }
        
        .sidebar .nav-link i {
            font-size: 18px;
            min-width: 24px;
            text-align: center;
        }
        
        /* Navigation Menu Container */
        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
        }
        
        /* Logout section at bottom */
        .sidebar-logout {
            margin-top: auto;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
            padding: 20px 8px 15px;
        }
        
        .sidebar-logout .nav-link {
            border-bottom: none;
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.2) 0%, rgba(253, 126, 20, 0.2) 100%);
            border: 2px solid rgba(220, 53, 69, 0.3);
            margin: 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .sidebar-logout .nav-link:hover {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.3) 0%, rgba(253, 126, 20, 0.3) 100%);
            transform: translateX(0) scale(1.02);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
            border-color: #dc3545;
        }
        
        .sidebar .sidebar-brand {
            padding: 30px 20px;
            text-align: center;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar .sidebar-brand::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="hearts" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><text x="7.5" y="12" text-anchor="middle" font-size="10" fill="rgba(255,255,255,0.1)">♥</text></pattern></defs><rect width="100" height="100" fill="url(%23hearts)"/></svg>');
            opacity: 0.2;
        }
        
        .sidebar .sidebar-brand .brand-content {
            position: relative;
            z-index: 2;
        }
        
        .sidebar .sidebar-brand h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
            font-size: 1.6rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
            letter-spacing: 1px;
        }
        
        .sidebar .sidebar-brand .brand-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            margin-bottom: 15px;
        }
        
        .sidebar .sidebar-brand .brand-logo:hover {
            transform: scale(1.15) rotate(10deg);
            border-color: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.6);
        }
        
        .sidebar .sidebar-brand small {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            font-weight: 600;
            display: block;
            margin-top: 8px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }
        
        .sidebar .sidebar-brand .tagline {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.8rem;
            font-style: italic;
            margin-top: 12px;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .content-header {
            background: #fff;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .content-body {
            padding: 20px;
        }
        
        /* User Info in Sidebar - REMOVED */
        /* This section has been removed for cleaner design */
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        /* Menu Icons */
        .sidebar .nav-link i {
            width: 24px;
            margin-right: 15px;
            font-size: 18px;
            text-align: center;
        }
        
        /* Smooth Scrolling */
        .sidebar {
            scroll-behavior: smooth;
        }
        
        /* Scrollbar Animation */
        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        /* Add padding to prevent content cutoff */
        .sidebar-content {
            padding-bottom: 20px;
        }
        
        /* Scroll indicator shadow at top/bottom */
        .sidebar::before {
            content: '';
            position: sticky;
            top: 0;
            display: block;
            height: 10px;
            background: linear-gradient(to bottom, rgba(26, 26, 46, 0.8) 0%, transparent 100%);
            z-index: 10;
            pointer-events: none;
        }
        
        .sidebar::after {
            content: '';
            position: sticky;
            bottom: 0;
            display: block;
            height: 10px;
            background: linear-gradient(to top, rgba(15, 52, 96, 0.8) 0%, transparent 100%);
            z-index: 10;
            pointer-events: none;
            margin-top: -10px;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navigation for non-authenticated users -->
    @if(!session('user'))
        @yield('content')
    @else
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-content">
            <!-- Brand -->
            <div class="sidebar-brand">
                <div class="brand-content">
                    <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" class="brand-logo">
                    <h4><i class="fas fa-heart me-2"></i>Yuva</h4>
                    <small>Blood Bank</small>
                    <div class="tagline">
                        <i class="fas fa-hands-helping me-1"></i>Saving Lives Together
                    </div>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="sidebar-nav">
                <div class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <i class="fas fa-user"></i>Profile
                    </a>
                    <a class="nav-link {{ request()->routeIs('register.donor') ? 'active' : '' }}" href="{{ route('register.donor') }}">
                        <i class="fas fa-heart"></i>Register Donor
                    </a>
                    <a class="nav-link {{ request()->routeIs('donors.list') ? 'active' : '' }}" href="{{ route('donors.list') }}">
                        <i class="fas fa-list"></i>Donors List
                    </a>
                    <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}" href="{{ route('settings') }}">
                        <i class="fas fa-cog"></i>Settings
                    </a>
                </div>
                
                <!-- Logout -->
                <div class="sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent text-start w-100" style="color: #ecf0f1;">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Content Header -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-outline-primary d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h5 class="mb-0 d-inline-block ms-2">@yield('page-title', 'Dashboard')</h5>
                </div>
                <div>
                    <span class="text-muted">{{ now()->format('M d, Y H:i') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Content Body -->
        <div class="content-body">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
        
        // Menu item active state management
        function setActiveMenuItem(element) {
            // Remove active class from all nav links
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to clicked element
            element.classList.add('active');
        }
        
        // Add click event to all nav links
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.sidebar .nav-link:not([type="submit"])').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.getAttribute('onclick')) {
                        setActiveMenuItem(this);
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
