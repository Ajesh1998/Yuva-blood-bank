<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yuva Blood Bank - Saving Lives Together</title>
    
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
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Yuva Blood Bank - Professional Blood Donor Management System. Connecting donors with those in need. Every drop counts, every life matters.">
    <meta name="keywords" content="blood bank, blood donation, donor management, Yuva, blood drive, save lives">
    <meta name="author" content="Yuva Blood Bank">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #dc3545 0%, #8b0000 50%, #dc3545 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="hearts" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><text x="10" y="15" text-anchor="middle" font-size="12" fill="rgba(255,255,255,0.1)">♥</text></pattern></defs><rect width="100" height="100" fill="url(%23hearts)"/></svg>');
            opacity: 0.3;
            animation: float 20s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-20px) translateY(-20px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-main {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            margin-bottom: 1rem;
            transition: all 0.4s ease;
        }
        
        .logo-main:hover {
            transform: scale(1.1) rotate(5deg);
            border-color: #fff;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }
        
        .brand-name {
            font-size: 3.5rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
            letter-spacing: 2px;
            background: linear-gradient(45deg, #fff, #f8f9fa);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .brand-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 0.5rem;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
        }
        
        .hero-tagline {
            font-size: 1.2rem;
            font-weight: 500;
            margin: 1.5rem 0;
            color: rgba(255, 255, 255, 0.9);
            font-style: italic;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        .hero-description {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.85);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Action Buttons */
        .action-buttons {
            margin-top: 2rem;
        }
        
        .btn-hero {
            padding: 15px 35px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-hero:hover::before {
            left: 100%;
        }
        
        .btn-primary-hero {
            background: linear-gradient(45deg, #fff, #f8f9fa);
            color: #dc3545;
            border: 3px solid transparent;
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }
        
        .btn-primary-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.4);
            color: #8b0000;
        }
        
        .btn-outline-hero {
            background: transparent;
            color: #fff;
            border: 3px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-outline-hero:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
            transform: translateY(-3px);
            color: #fff;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }
        
        /* Statistics Section */
        .stats-section {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 800px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            margin-top: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }
        
        .stat-card:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        
        .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .brand-name {
                font-size: 2.5rem;
            }
            
            .brand-subtitle {
                font-size: 1.2rem;
            }
            
            .hero-tagline {
                font-size: 1rem;
            }
            
            .hero-description {
                font-size: 1rem;
                padding: 0 20px;
            }
            
            .btn-hero {
                display: block;
                margin: 10px auto;
                text-align: center;
                width: 80%;
                max-width: 300px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
                padding: 0 20px;
            }
            
            .stat-card {
                padding: 15px 10px;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .stat-label {
                font-size: 0.8rem;
            }
            
            .logo-main {
                width: 80px;
                height: 80px;
            }
            
            .stats-section {
                bottom: 30px;
                position: relative;
                margin-top: 3rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                padding: 20px 10px;
            }
            
            .brand-name {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .btn-hero {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Main Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="hero-content text-center">
                        <!-- Logo and Branding -->
                        <div class="logo-container">
                            <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" class="logo-main">
                            <h1 class="brand-name">YUVA</h1>
                            <h2 class="brand-subtitle">Blood Bank</h2>
                        </div>

                        <!-- Hero Content -->
                        <p class="hero-tagline">
                            <i class="fas fa-hands-helping me-2"></i>
                            Saving Lives Together
                        </p>

                        <p class="hero-description">
                            Welcome to Yuva Blood Bank Management System - where every drop counts and every life matters. 
                            Our professional platform connects generous donors with those in urgent need, 
                            making the life-saving process of blood donation simple, efficient, and impactful.
                        </p>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('login') }}" class="btn-hero btn-primary-hero">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Staff Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="stats-section">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Lives Saved</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">250+</div>
                        <div class="stat-label">Active Donors</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Blood Types</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Availability</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>