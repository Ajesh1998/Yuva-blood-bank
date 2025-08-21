@extends('layouts.app')

@section('title', 'Dashboard - Yuva Blood Bank')
@section('page-title', 'Yuva Blood Bank Dashboard')

@section('styles')
<style>
    .hero-dashboard {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 50%, #ffc107 100%);
        color: white;
        padding: 3rem 2rem;
        margin: -20px -20px 30px -20px;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 30px 30px;
    }
    
    .hero-dashboard::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="hearts" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><text x="10" y="15" text-anchor="middle" font-size="12" fill="rgba(255,255,255,0.1)">♥</text></pattern></defs><rect width="100" height="100" fill="url(%23hearts)"/></svg>');
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: var(--card-color, #dc3545);
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .stats-card.danger { --card-color: #dc3545; }
    .stats-card.success { --card-color: #28a745; }
    .stats-card.info { --card-color: #17a2b8; }
    .stats-card.warning { --card-color: #ffc107; }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--card-color);
        margin: 0;
    }
    
    .stats-label {
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    
    .stats-icon {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 3rem;
        color: var(--card-color);
        opacity: 0.2;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 25px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.1), rgba(253, 126, 20, 0.1));
        border-radius: 50%;
        transform: translate(30px, -30px);
    }
    
    .user-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        border: 4px solid rgba(255, 255, 255, 0.8);
    }
    
    .quick-action-btn {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #495057;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .quick-action-btn:hover {
        border-color: #dc3545;
        background: #dc3545;
        color: white;
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }
    
    .blood-group-tile {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #dee2e6;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .blood-group-tile:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #dc3545;
    }
    
    .blood-group-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .activity-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: none;
        margin-bottom: 20px;
    }
    
    .progress-custom {
        height: 8px;
        border-radius: 10px;
        background: #f1f3f4;
    }
    
    .progress-bar-custom {
        border-radius: 10px;
        background: linear-gradient(90deg, #dc3545, #fd7e14);
    }
    
    .floating-action {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #dc3545, #fd7e14);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
        text-decoration: none;
    }
    
    .floating-action:hover {
        transform: scale(1.1);
        color: white;
        box-shadow: 0 12px 35px rgba(220, 53, 69, 0.5);
    }
    
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .chart-placeholder {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="hero-dashboard">
    <div class="hero-content">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">
                    Welcome To Yuva Blood Bank
                </h1>
                <p class="lead mb-4">Be someone's superhero. Donate blood today</p>
                <div class="d-flex flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span>{{ now()->format('l, F j, Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span id="current-time">{{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" 
                     style="height: 100px; width: auto; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.3);">
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card danger">
            <div class="stats-label">Total Donors</div>
            <div class="stats-number">{{ count($registeredDonors) }}</div>
            <div class="small text-muted mt-2">
                <i class="fas fa-arrow-up text-success me-1"></i>
                Active registrations
            </div>
            <i class="fas fa-heart stats-icon"></i>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card success">
            <div class="stats-label">Blood Groups</div>
            <div class="stats-number">{{ count(array_unique(array_column($registeredDonors, 'blood_group'))) }}</div>
            <div class="small text-muted mt-2">
                <i class="fas fa-check text-success me-1"></i>
                Available types
            </div>
            <i class="fas fa-tint stats-icon"></i>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card info">
            <div class="stats-label">System Status</div>
            <div class="stats-number" style="font-size: 1.5rem;">Online</div>
            <div class="small text-muted mt-2">
                <i class="fas fa-circle text-success me-1"></i>
                All systems operational
            </div>
            <i class="fas fa-server stats-icon"></i>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card warning">
            <div class="stats-label">Active Sessions</div>
            <div class="stats-number">1</div>
            <div class="small text-muted mt-2">
                <i class="fas fa-users text-info me-1"></i>
                Current user
            </div>
            <i class="fas fa-users stats-icon"></i>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row mb-5">
    <!-- Welcome & User Info -->
    <div class="col-lg-8 mb-4">
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <div class="user-avatar mx-auto">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>
                <div class="col-md-9">
                    <h4 class="fw-bold text-dark mb-3">{{ $user['name'] }}</h4>
                    <p class="text-muted mb-3">
                        Welcome to your blood bank management dashboard. From here you can register new donors, 
                        manage existing records, and monitor system activity.
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope text-danger me-3"></i>
                                <span class="text-muted">{{ $user['email'] }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-success me-3"></i>
                                <span class="text-muted">{{ now()->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-shield-alt text-warning me-3"></i>
                                <span class="text-muted">Administrator</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-code text-info me-3"></i>
                                <span class="text-muted">Laravel {{ app()->version() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="col-lg-4 mb-4">
        <div class="activity-card">
            <h5 class="fw-bold text-dark mb-4">
                <i class="fas fa-bolt text-warning me-2"></i>Quick Actions
            </h5>
            <div class="d-grid gap-2">
                <a href="{{ route('register.donor') }}" class="quick-action-btn">
                    <i class="fas fa-heart me-3"></i>
                    <div>
                        <strong>Register Donor</strong>
                        <div class="small text-muted">Add new blood donor</div>
                    </div>
                </a>
                
                <a href="{{ route('donors.list') }}" class="quick-action-btn">
                    <i class="fas fa-list me-3"></i>
                    <div>
                        <strong>View Donors</strong>
                        <div class="small text-muted">Browse donor database</div>
                    </div>
                </a>
                
                <a href="{{ route('profile') }}" class="quick-action-btn">
                    <i class="fas fa-user-cog me-3"></i>
                    <div>
                        <strong>My Profile</strong>
                        <div class="small text-muted">Manage account settings</div>
                    </div>
                </a>
                
                <a href="{{ route('settings') }}" class="quick-action-btn">
                    <i class="fas fa-cog me-3"></i>
                    <div>
                        <strong>System Settings</strong>
                        <div class="small text-muted">Configure application</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Blood Groups Overview -->
<div class="row mb-5">
    <div class="col-12">
        <div class="activity-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fas fa-tint text-danger me-2"></i>Blood Groups Distribution
                </h5>
                <span class="badge bg-danger">{{ count($registeredDonors) }} Total Donors</span>
            </div>
            
            <div class="row">
                @php
                    $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                    $donorGroups = collect($registeredDonors)->groupBy('blood_group');
                @endphp
                
                @foreach($bloodGroups as $group)
                    @php $count = $donorGroups->get($group, collect())->count(); @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="blood-group-tile">
                            <div class="blood-group-icon">
                                @if(str_contains($group, 'A'))
                                    🅰️
                                @elseif(str_contains($group, 'B'))
                                    🅱️
                                @elseif(str_contains($group, 'AB'))
                                    🆎
                                @else
                                    ⭕
                                @endif
                            </div>
                            <h4 class="fw-bold text-dark">{{ $group }}</h4>
                            <p class="text-muted mb-0">{{ $count }} Donors</p>
                            @if($count > 0)
                                <div class="progress-custom mt-2">
                                    <div class="progress-bar-custom" style="width: {{ ($count / count($registeredDonors)) * 100 }}%"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- System Information & Recent Activity -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="activity-card">
            <h5 class="fw-bold text-dark mb-4">
                <i class="fas fa-info-circle text-primary me-2"></i>System Information
            </h5>
            <div class="row">
                <div class="col-6 mb-3">
                    <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #dc354520, #fd7e1420);">
                        <i class="fas fa-shield-alt fa-2x text-danger mb-2"></i>
                        <h6 class="small fw-bold">Secure System</h6>
                        <small class="text-muted">Protected Access</small>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #28a74520, #20c99720);">
                        <i class="fas fa-database fa-2x text-success mb-2"></i>
                        <h6 class="small fw-bold">Data Storage</h6>
                        <small class="text-muted">JSON File System</small>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #17a2b820, #0dcaf020);">
                        <i class="fas fa-mobile-alt fa-2x text-info mb-2"></i>
                        <h6 class="small fw-bold">Responsive</h6>
                        <small class="text-muted">Mobile Friendly</small>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="text-center p-3 rounded" style="background: linear-gradient(135deg, #ffc10720, #fd7e1420);">
                        <i class="fas fa-rocket fa-2x text-warning mb-2"></i>
                        <h6 class="small fw-bold">Performance</h6>
                        <small class="text-muted">Fast & Reliable</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="activity-card">
            <h5 class="fw-bold text-dark mb-4">
                <i class="fas fa-chart-line text-success me-2"></i>Activity Overview
            </h5>
            <div class="chart-placeholder">
                <i class="fas fa-chart-bar fa-3x mb-3"></i>
                <h6>Analytics Dashboard</h6>
                <p class="small text-muted mb-3">Real-time donor statistics and trends would be displayed here</p>
                <div class="d-flex justify-content-center gap-3">
                    <div class="text-center">
                        <div class="h5 text-danger fw-bold">{{ count($registeredDonors) }}</div>
                        <small>Total Donors</small>
                    </div>
                    <div class="text-center">
                        <div class="h5 text-success fw-bold">{{ now()->format('d') }}</div>
                        <small>Days This Month</small>
                    </div>
                    <div class="text-center">
                        <div class="h5 text-info fw-bold">100%</div>
                        <small>System Uptime</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<a href="{{ route('register.donor') }}" class="floating-action" title="Quick Register Donor">
    <i class="fas fa-plus"></i>
    @if(count($registeredDonors) === 0)
        <div class="notification-badge">!</div>
    @endif
</a>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
    
    // Animate cards on load
    const cards = document.querySelectorAll('.stats-card, .welcome-card, .activity-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });
    
    // Animate blood group tiles
    const bloodTiles = document.querySelectorAll('.blood-group-tile');
    bloodTiles.forEach((tile, index) => {
        tile.style.opacity = '0';
        tile.style.transform = 'scale(0.8)';
        tile.style.transition = 'all 0.5s ease';
        
        setTimeout(() => {
            tile.style.opacity = '1';
            tile.style.transform = 'scale(1)';
        }, 1000 + (index * 100));
    });
    
    // Add hover effects to quick action buttons
    const actionBtns = document.querySelectorAll('.quick-action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px) scale(1.02)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0) scale(1)';
        });
    });
    
    // Floating action button pulse effect
    const floatingBtn = document.querySelector('.floating-action');
    if (floatingBtn) {
        setInterval(() => {
            floatingBtn.style.transform = 'scale(1.1)';
            setTimeout(() => {
                floatingBtn.style.transform = 'scale(1)';
            }, 200);
        }, 3000);
    }
    
    // Add click animation to stats cards
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
            setTimeout(() => {
                this.style.transform = 'translateY(-10px) scale(1)';
            }, 200);
        });
    });
    
    // Blood group tiles click animation
    bloodTiles.forEach(tile => {
        tile.addEventListener('click', function() {
            // Create ripple effect
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(220, 53, 69, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%) scale(0);
            `;
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            
            this.style.position = 'relative';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Welcome message with typing effect
    const welcomeText = document.querySelector('.hero-dashboard h1');
    if (welcomeText) {
        const originalText = welcomeText.innerHTML;
        welcomeText.innerHTML = '';
        let i = 0;
        
        function typeWriter() {
            if (i < originalText.length) {
                welcomeText.innerHTML += originalText.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            }
        }
        
        setTimeout(typeWriter, 500);
    }
    
    // Add smooth scroll behavior for quick actions
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Add a subtle loading animation
            const icon = this.querySelector('i');
            const originalClass = icon.className;
            icon.className = 'fas fa-spinner fa-spin me-3';
            
            setTimeout(() => {
                icon.className = originalClass;
            }, 1000);
        });
    });
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: translate(-50%, -50%) scale(4);
            opacity: 0;
        }
    }
    
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
    
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }
`;
document.head.appendChild(style);
</script>
@endsection