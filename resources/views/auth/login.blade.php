@extends('layouts.app')

@section('title', 'Yuva Blood Bank Login - Donor Management System')

@section('head')
<!-- Favicon and App Icons -->
<link rel="icon" type="image/jpeg" href="{{ asset('yuva.jpg') }}">
<link rel="shortcut icon" type="image/jpeg" href="{{ asset('yuva.jpg') }}">
<link rel="apple-touch-icon" href="{{ asset('yuva.jpg') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('yuva.jpg') }}">
<link rel="icon" type="image/jpeg" sizes="32x32" href="{{ asset('yuva.jpg') }}">
<link rel="icon" type="image/jpeg" sizes="16x16" href="{{ asset('yuva.jpg') }}">
<meta name="msapplication-TileImage" content="{{ asset('yuva.jpg') }}">

<!-- PWA Manifest -->
<link rel="manifest" href="{{ asset('manifest.json') }}">

<!-- Mobile App Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Yuva Blood Bank">
<meta name="theme-color" content="#dc3545">
<meta name="msapplication-navbutton-color" content="#dc3545">
<meta name="msapplication-TileColor" content="#dc3545">

<!-- Prevent zoom on input focus for iOS -->
<meta name="format-detection" content="telephone=no">
@endsection

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #dc3545 0%, #8b0000 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        position: relative;
        overflow-x: hidden;
    }
    
    /* Mobile-First Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 10px;
        }
        
        .blood-container {
            padding: 10px;
            min-height: 100vh;
        }
        
        .login-wrapper {
            margin: 0;
            border-radius: 15px;
            max-width: 100%;
        }
        
        .blood-bank-info {
            padding: 20px;
            text-align: center;
        }
        
        .login-form {
            padding: 20px;
        }
        
        .blood-drop {
            width: 60px;
            height: 60px;
        }
        
        .hero-text h1 {
            font-size: 1.8rem !important;
        }
        
        .hero-text p {
            font-size: 0.9rem !important;
        }
        
        .statistics-grid {
            grid-template-columns: 1fr !important;
            gap: 10px !important;
        }
        
        .stat-item {
            padding: 15px !important;
        }
    }
    
    @media (max-width: 576px) {
        .login-wrapper {
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .blood-bank-info {
            padding: 15px;
        }
        
        .login-form {
            padding: 15px;
        }
        
        .hero-text h1 {
            font-size: 1.5rem !important;
            line-height: 1.3;
        }
        
        .hero-text p {
            font-size: 0.85rem !important;
        }
        
        .btn-blood {
            padding: 12px !important;
            font-size: 1rem !important;
        }
        
        .statistics-grid {
            gap: 8px !important;
        }
        
        .stat-item {
            padding: 12px !important;
        }
        
        .stat-item h3 {
            font-size: 1.2rem !important;
        }
        
        .stat-item small {
            font-size: 0.7rem !important;
        }
        
        /* Hide some background animations on mobile for better performance */
        .blood-vein,
        .blood-drop-flow,
        .blood-pulse {
            display: none;
        }
    }
    
    /* Touch-friendly form elements */
    @media (max-width: 768px) {
        .form-control {
            padding: 12px 15px;
            font-size: 16px; /* Prevents zoom on iOS */
            border-radius: 10px;
        }
        
        .btn {
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 10px;
            min-height: 48px; /* Touch target size */
        }
        
        .alert {
            font-size: 14px;
            padding: 10px 15px;
        }
    }
    
    /* Blood Flow Animation Background */
    .blood-flow-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }
    
    .blood-vein {
        position: absolute;
        background: linear-gradient(90deg, transparent, rgba(139, 0, 0, 0.3), transparent);
        animation: flow 4s infinite ease-in-out;
    }
    
    .blood-vein.vein-1 {
        top: 10%;
        left: -100%;
        width: 200px;
        height: 2px;
        animation-delay: 0s;
    }
    
    .blood-vein.vein-2 {
        top: 30%;
        right: -100%;
        width: 150px;
        height: 1px;
        animation-delay: 1s;
        animation-direction: reverse;
    }
    
    .blood-vein.vein-3 {
        top: 60%;
        left: -100%;
        width: 180px;
        height: 1.5px;
        animation-delay: 2s;
    }
    
    .blood-vein.vein-4 {
        top: 80%;
        right: -100%;
        width: 120px;
        height: 1px;
        animation-delay: 3s;
        animation-direction: reverse;
    }
    
    @keyframes flow {
        0% { transform: translateX(0); opacity: 0; }
        20% { opacity: 1; }
        80% { opacity: 1; }
        100% { transform: translateX(calc(100vw + 200px)); opacity: 0; }
    }
    
    .blood-drop-flow {
        position: absolute;
        width: 8px;
        height: 12px;
        background: #8b0000;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        animation: dropFlow 6s infinite linear;
    }
    
    .blood-drop-flow:nth-child(1) { left: 10%; animation-delay: 0s; }
    .blood-drop-flow:nth-child(2) { left: 25%; animation-delay: 1.5s; }
    .blood-drop-flow:nth-child(3) { left: 45%; animation-delay: 3s; }
    .blood-drop-flow:nth-child(4) { left: 65%; animation-delay: 4.5s; }
    .blood-drop-flow:nth-child(5) { left: 80%; animation-delay: 2s; }
    
    @keyframes dropFlow {
        0% {
            top: -20px;
            opacity: 0;
            transform: rotate(-45deg) scale(0.5);
        }
        10% {
            opacity: 1;
            transform: rotate(-45deg) scale(1);
        }
        90% {
            opacity: 1;
            transform: rotate(-45deg) scale(1);
        }
        100% {
            top: calc(100vh + 20px);
            opacity: 0;
            transform: rotate(-45deg) scale(0.5);
        }
    }
    
    .blood-pulse {
        position: absolute;
        width: 50px;
        height: 50px;
        border: 2px solid rgba(139, 0, 0, 0.4);
        border-radius: 50%;
        animation: pulse-ring 3s infinite ease-out;
    }
    
    .blood-pulse:nth-child(1) { top: 20%; left: 15%; animation-delay: 0s; }
    .blood-pulse:nth-child(2) { top: 50%; right: 20%; animation-delay: 1s; }
    .blood-pulse:nth-child(3) { bottom: 30%; left: 30%; animation-delay: 2s; }
    
    @keyframes pulse-ring {
        0% {
            transform: scale(0.1);
            opacity: 1;
        }
        80%, 100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }
    
    .blood-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        z-index: 2;
    }
    
    .login-wrapper {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        backdrop-filter: blur(10px);
        margin: 20px auto;
    }
    
    /* Mobile-specific wrapper adjustments */
    @media (max-width: 768px) {
        .login-wrapper {
            margin: 10px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }
    }
    
    @media (max-width: 576px) {
        .login-wrapper {
            margin: 5px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    }
    
    .blood-bank-info {
        background: linear-gradient(45deg, #dc3545, #b52d3c);
        color: white;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .blood-bank-info::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: float 20s infinite linear;
    }
    
    .blood-bank-info::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 60% 20%, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
        animation: bloodParticles 8s infinite ease-in-out;
    }
    
    @keyframes bloodParticles {
        0%, 100% { opacity: 0.3; transform: translateY(0px); }
        50% { opacity: 0.8; transform: translateY(-10px); }
    }
    
    @keyframes float {
        0% { transform: translateX(-50px) translateY(-50px); }
        100% { transform: translateX(-50px) translateY(-50px) translateX(60px) translateY(60px); }
    }
    
    .blood-drop {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        margin: 0 auto 20px;
        position: relative;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: rotate(-45deg) scale(1); }
        50% { transform: rotate(-45deg) scale(1.1); }
    }
    
    .blood-drop::before {
        content: '❤️';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
        font-size: 30px;
    }
    
    .login-logo {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .login-logo:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.5);
    }
    
    .login-form {
        padding: 40px;
    }
    
    /* Mobile-responsive login form */
    @media (max-width: 768px) {
        .login-form {
            padding: 20px;
        }
    }
    
    @media (max-width: 576px) {
        .login-form {
            padding: 15px;
        }
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        min-height: 48px; /* Touch-friendly height */
    }
    
    /* Mobile-specific form controls */
    @media (max-width: 768px) {
        .form-control {
            padding: 14px 16px;
            font-size: 16px; /* Prevents zoom on iOS */
            border-radius: 12px;
            min-height: 50px;
        }
        
        .form-label {
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .btn-blood {
            padding: 14px 20px;
            font-size: 16px;
            min-height: 52px;
            border-radius: 12px;
        }
    }
    
    .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        transform: translateY(-2px);
    }
    
    .btn-blood {
        background: linear-gradient(45deg, #dc3545, #b52d3c);
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-blood:hover {
        background: linear-gradient(45deg, #b52d3c, #dc3545);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
    }
    
    .demo-card {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border: 2px solid #dc3545;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .demo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
        border-color: #b52d3c;
    }
    
    .blood-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 30px;
        padding: 0 10px;
    }
    
    .stat-item {
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        padding: 15px 10px;
        border-radius: 10px;
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    
    .stat-number {
        font-size: 24px;
        font-weight: bold;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .stat-label {
        font-size: 12px;
        opacity: 0.8;
    }
    
    .awareness-message {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 20px 15px;
        margin-top: 25px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }
    
    .awareness-message:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }
    
    .text-white-75 {
        color: rgba(255, 255, 255, 0.85) !important;
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    @media (max-width: 768px) {
        .login-wrapper {
            margin: 10px;
        }
        
        .blood-bank-info, .login-form {
            padding: 30px 20px;
        }
        
        .row {
            flex-direction: column-reverse;
        }
    }

    /* Enhanced Mobile Responsiveness */
    @media (max-width: 992px) {
        .blood-bank-info {
            padding: 25px 20px;
            min-height: auto;
        }
        
        .login-form {
            padding: 25px 20px;
        }
        
        .blood-stats {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        
        .stat-item {
            padding: 15px 10px;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
        
        .login-logo {
            width: 50px;
            height: 50px;
        }
        
        .awareness-message {
            padding: 15px 12px;
            margin-top: 20px;
            border-radius: 10px;
        }
        
        .text-white-75 {
            font-size: 0.85rem !important;
        }

        }
    }
    
    @media (max-width: 768px) {
        .blood-container {
            padding: 5px;
            align-items: flex-start;
            padding-top: 20px;
        }
        
        .login-wrapper {
            margin: 5px;
            border-radius: 12px;
        }
        
        .blood-bank-info {
            background: linear-gradient(135deg, #dc3545, #b52d3c);
            padding: 20px 15px;
            text-align: center;
        }
        
        .blood-bank-info h2 {
            font-size: 1.5rem;
        }
        
        .blood-bank-info h4 {
            font-size: 1.1rem;
        }
        
        .blood-bank-info h5 {
            font-size: 1rem;
            margin-bottom: 15px !important;
        }
        
        .blood-bank-info p.lead {
            font-size: 0.9rem;
            margin-bottom: 20px !important;
        }
        
        .blood-stats {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin: 15px 0;
        }
        
        .stat-item {
            padding: 10px 5px;
            border-radius: 8px;
        }
        
        .stat-number {
            font-size: 1.2rem;
            margin-bottom: 2px;
        }
        
        .stat-label {
            font-size: 0.7rem;
        }
        
        
        .login-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px !important;
        }
        
        .text-start h2 {
            font-size: 1.3rem;
            line-height: 1.2;
        }
        
        .text-start h4 {
            font-size: 0.9rem;
            line-height: 1.2;
        }
    }
    
    @media (max-width: 576px) {
        .blood-container {
            padding: 0;
            padding-top: 10px;
        }
        
        .login-wrapper {
            margin: 0;
            border-radius: 0;
            min-height: 100vh;
        }
        
        .blood-bank-info {
            padding: 15px 10px;
            border-radius: 0;
        }
        
        .login-form {
            padding: 15px 10px;
        }
        
        .d-flex.align-items-center.justify-content-center {
            flex-direction: column;
            text-align: center;
        }
        
        .login-logo {
            margin-right: 0 !important;
            margin-bottom: 10px;
        }
        
        .text-start {
            text-align: center !important;
        }
        
        .blood-stats {
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
            margin: 10px 0;
        }
        
        .stat-item {
            padding: 8px 3px;
        }
        
        .stat-number {
            font-size: 1rem;
        }
        
        .stat-label {
            font-size: 0.6rem;
        }
        
        .awareness-message {
            padding: 12px 10px;
            margin-top: 15px;
            border-radius: 8px;
        }
        
        .text-white-75 {
            font-size: 0.8rem !important;
            line-height: 1.3;
        }
        
        .fa-quote-left {
            font-size: 0.8rem;
        }

        .form-control {
            padding: 15px 12px;
            font-size: 16px;
            border-radius: 8px;
            min-height: 52px;
        }
        
        .btn-blood {
            padding: 15px 20px;
            font-size: 16px;
            min-height: 54px;
            border-radius: 8px;
        }
        
        .alert {
            margin: 10px 5px;
            padding: 12px 10px;
            border-radius: 8px;
            font-size: 13px;
        }
        
        /* Optimize touch targets */
        .form-label {
            font-size: 13px;
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        /* Hide some decorative elements on very small screens */
        .blood-vein,
        .blood-drop-flow,
        .blood-pulse {
            display: none !important;
        }
        
        /* Simplify animations for better performance */
        * {
            animation-duration: 0.3s !important;
        }
    }
    
    /* High DPI displays optimization */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .login-logo {
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }
    }
    
    /* Landscape mobile orientation */
    @media (max-width: 768px) and (orientation: landscape) {
        .blood-container {
            padding: 10px 5px;
        }
        
        .login-wrapper {
            margin: 5px;
        }
        
        .blood-bank-info {
            padding: 15px;
        }
        
        .blood-stats {
            margin: 10px 0;
        }
    }
    
    /* Dark mode support for mobile */
    @media (prefers-color-scheme: dark) and (max-width: 768px) {
        .login-wrapper {
            background: rgba(30, 30, 30, 0.95);
        }
        
        .login-form {
            color: #ffffff;
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .form-label {
            color: rgba(255, 255, 255, 0.9);
        }
    }

    /* Loading overlay for form submission */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(220, 53, 69, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        backdrop-filter: blur(3px);
    }
    
    .loading-content {
        text-align: center;
        color: white;
    }
    
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #ffffff;
        animation: spin 1s ease-in-out infinite;
        margin: 0 auto 15px;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Mobile-specific loading adjustments */
    @media (max-width: 768px) {
        .loading-spinner {
            width: 40px;
            height: 40px;
        }
        
        .loading-content h5 {
            font-size: 1rem;
        }
        
        .loading-content p {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Blood Flow Animation Background -->
<div class="blood-flow-container">
    <!-- Flowing Veins -->
    <div class="blood-vein vein-1"></div>
    <div class="blood-vein vein-2"></div>
    <div class="blood-vein vein-3"></div>
    <div class="blood-vein vein-4"></div>
    
    <!-- Falling Blood Drops -->
    <div class="blood-drop-flow"></div>
    <div class="blood-drop-flow"></div>
    <div class="blood-drop-flow"></div>
    <div class="blood-drop-flow"></div>
    <div class="blood-drop-flow"></div>
    
    <!-- Pulsing Rings -->
    <div class="blood-pulse"></div>
    <div class="blood-pulse"></div>
    <div class="blood-pulse"></div>
</div>

<div class="blood-container">
    <div class="login-wrapper">
        <div class="row g-0">
            <!-- Blood Bank Information Side -->
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="blood-bank-info h-100 d-flex flex-column justify-content-center">
                    <div class="text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" class="login-logo me-3">
                            <div class="text-start">
                                <h2 class="fw-bold mb-0">YUVA</h2>
                                <h4 class="mb-0">BLOOD BANK</h4>
                            </div>
                        </div>
                        <h5 class="mb-4">Donor Management System</h5>
                        <p class="lead mb-4">
                            "Every drop counts, every donor matters. 
                            Join our mission to save lives through blood donation."
                        </p>
                    </div>
                    
                    <div class="blood-stats">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Lives Saved</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">250+</div>
                            <div class="stat-label">Active Donors</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Blood Types</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Login Form Side -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="login-form">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-md fa-3x text-danger mb-3"></i>
                        <h3 class="text-danger fw-bold">Staff Login</h3>
                        <p class="text-muted">Access the Blood Donor Management System</p>
                    </div>

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-danger"></i>Staff Email
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Enter your staff email"
                                   required 
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-danger"></i>Password
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Enter your password"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-blood btn-lg text-white">
                                <i class="fas fa-sign-in-alt me-2"></i>Access System
                            </button>
                        </div>
                    </form>

                    <!-- Security Notice -->
                    <div class="mt-4">
                        <div class="text-center">
                            <div class="alert alert-info border-0" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                <small class="fw-semibold text-primary">
                                    Secure Access Portal for Authorized Staff Only
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blood Donation Awareness -->
                    <div class="awareness-message">
                        <div class="text-center">
                            <i class="fas fa-quote-left text-white-50 mb-2"></i>
                            <p class="mb-2 fst-italic text-white-75">
                                "Be a hero in someone's story. Your blood donation can give someone a second chance at life."
                            </p>
                            <small class="text-white-50">
                                <i class="fas fa-heart me-1"></i>
                                Together, we save lives every day
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <h5 class="fw-bold">Signing In...</h5>
        <p class="mb-0">Please wait while we authenticate your credentials</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Mobile viewport optimization
    document.addEventListener('DOMContentLoaded', function() {
        // Add viewport meta tag for mobile optimization
        const viewport = document.createElement('meta');
        viewport.name = 'viewport';
        viewport.content = 'width=device-width, initial-scale=1.0, user-scalable=no';
        
        // Check if viewport meta doesn't exist
        if (!document.querySelector('meta[name="viewport"]')) {
            document.getElementsByTagName('head')[0].appendChild(viewport);
        }
        
        // Enhanced form validation feedback for mobile
        const form = document.querySelector('form');
        const inputs = document.querySelectorAll('.form-control');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
            });
            
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.style.borderColor = '#e9ecef';
                    this.style.boxShadow = 'none';
                } else {
                    this.style.borderColor = '#28a745';
                    this.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.25)';
                }
            });
        });
        
        // Touch-friendly notifications for mobile
        function showMobileNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} position-fixed`;
            notification.style.cssText = `
                top: 10px;
                left: 10px;
                right: 10px;
                z-index: 9999;
                opacity: 0;
                transition: all 0.3s ease;
                border-radius: 10px;
                padding: 15px;
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            notification.innerHTML = `
                <i class="fas fa-info-circle me-2"></i>${message}
                <button type="button" class="btn-close float-end" onclick="this.parentElement.remove()"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Fade in
            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateY(0)';
            }, 100);
            
            // Auto remove after 4 seconds
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }
            }, 4000);
        }
        
        // Enhanced form submission for mobile
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Show loading overlay
            loadingOverlay.style.display = 'flex';
            
            // Update button state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
            submitBtn.disabled = true;
            
            // Add haptic feedback for mobile devices
            if (navigator.vibrate) {
                navigator.vibrate(50); // Brief vibration
            }
            
            // Re-enable after 10 seconds if form doesn't submit properly (fallback)
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Access System';
                submitBtn.disabled = false;
                loadingOverlay.style.display = 'none';
            }, 10000);
        });
    });
    
    // Mobile-optimized floating animation
    function createFloatingElement() {
        // Reduce frequency on mobile devices
        if (window.innerWidth <= 768) {
            if (Math.random() > 0.5) return; // 50% chance on mobile
        }
        
        const element = document.createElement('div');
        element.innerHTML = '❤️';
        element.style.cssText = `
            position: fixed;
            font-size: ${window.innerWidth <= 768 ? '16px' : '20px'};
            opacity: 0.3;
            pointer-events: none;
            z-index: 1;
            animation: float-up 6s linear infinite;
        `;
        
        element.style.left = Math.random() * window.innerWidth + 'px';
        element.style.bottom = '-50px';
        
        document.body.appendChild(element);
        
        setTimeout(() => {
            if (document.body.contains(element)) {
                document.body.removeChild(element);
            }
        }, 6000);
    }
    
    // Enhanced Blood Flow Animation Effects (Mobile Optimized)
    function createBloodDroplet() {
        // Skip on very small screens for performance
        if (window.innerWidth <= 576) return;
        
        const droplet = document.createElement('div');
        droplet.style.cssText = `
            position: fixed;
            width: ${window.innerWidth <= 768 ? '4px' : '6px'};
            height: ${window.innerWidth <= 768 ? '8px' : '10px'};
            background: linear-gradient(45deg, #8b0000, #dc3545);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            pointer-events: none;
            z-index: 1;
            opacity: 0;
            animation: bloodDrop 8s linear infinite;
        `;
        
        droplet.style.left = Math.random() * window.innerWidth + 'px';
        droplet.style.top = '-20px';
        
        document.body.appendChild(droplet);
        
        setTimeout(() => {
            if (document.body.contains(droplet)) {
                document.body.removeChild(droplet);
            }
        }, 8000);
    }
    
    function createBloodParticle() {
        // Skip on mobile for performance
        if (window.innerWidth <= 768) return;
        
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            width: 3px;
            height: 3px;
            background: #8b0000;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            opacity: 0.6;
            animation: bloodParticle 6s ease-out infinite;
        `;
        
        particle.style.left = Math.random() * window.innerWidth + 'px';
        particle.style.top = Math.random() * window.innerHeight + 'px';
        
        document.body.appendChild(particle);
        
        setTimeout(() => {
            if (document.body.contains(particle)) {
                document.body.removeChild(particle);
            }
        }, 6000);
    }
    
    // Adjust animation frequency based on screen size
    const floatingInterval = window.innerWidth <= 768 ? 6000 : 3000;
    const dropletInterval = window.innerWidth <= 768 ? 4000 : 2000;
    const particleInterval = window.innerWidth <= 768 ? 8000 : 4000;
    
    // Create effects with device-appropriate frequency
    setInterval(createFloatingElement, floatingInterval);
    setInterval(createBloodDroplet, dropletInterval);
    setInterval(createBloodParticle, particleInterval);
    
    // Add CSS for mobile-optimized animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes float-up {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        @keyframes bloodDrop {
            0% {
                transform: translateY(0) rotate(-45deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(calc(100vh + 20px)) rotate(-45deg);
                opacity: 0;
            }
        }
        
        @keyframes bloodParticle {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            20% {
                transform: scale(1) rotate(90deg);
                opacity: 0.6;
            }
            80% {
                transform: scale(1.2) rotate(270deg);
                opacity: 0.4;
            }
            100% {
                transform: scale(0) rotate(360deg);
                opacity: 0;
            }
        }
        
        /* Mobile-specific animation adjustments */
        @media (max-width: 768px) {
            @keyframes float-up {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 0.2;
                }
                50% {
                    opacity: 0.4;
                }
                100% {
                    transform: translateY(-80vh) rotate(180deg);
                    opacity: 0;
                }
            }
        }
        
        /* Disable some animations on very small screens */
        @media (max-width: 576px) {
            @keyframes bloodDrop,
            @keyframes bloodParticle {
                0%, 100% { display: none; }
            }
        }
    `;
    document.head.appendChild(style);
</script>
</script>
@endsection