@extends('layouts.app')

@section('title', 'Register Blood Donor - Yuva Blood Bank')

@section('page-title', 'Register Blood Donor - Yuva Blood Bank')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
        position: relative;
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
    }
    
    .donor-form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        background: white;
        position: relative;
        overflow: hidden;
    }
    
    .donor-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #dc3545, #fd7e14, #ffc107, #28a745, #20c997, #0dcaf0, #6f42c1, #d63384);
    }
    
    .form-control, .form-select {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 12px 16px;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        transform: translateY(-2px);
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-register {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
    }
    
    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-register:hover::before {
        left: 100%;
    }
    
    .btn-secondary-custom {
        border: 2px solid #6c757d;
        background: transparent;
        color: #6c757d;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-secondary-custom:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-info-custom {
        border: 2px solid #0dcaf0;
        background: transparent;
        color: #0dcaf0;
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-info-custom:hover {
        background: #0dcaf0;
        color: white;
        transform: translateY(-2px);
    }
    
    .blood-group-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }
    
    .blood-type-tile {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #dee2e6;
        border-radius: 15px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .blood-type-tile:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #dc3545;
    }
    
    .blood-type-tile.selected {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border-color: #dc3545;
    }
    
    .blood-type-icon {
        font-size: 24px;
        margin-bottom: 8px;
        color: #dc3545;
    }
    
    .blood-type-tile.selected .blood-type-icon {
        color: white;
    }
    
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: none;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-10px);
    }
    
    .stats-number {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .required-asterisk {
        color: #dc3545;
        font-weight: bold;
        margin-left: 3px;
    }
</style>

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="fas fa-heart me-3 animate-pulse"></i>
                    Register Blood Donor
                </h1>
                <p class="lead mb-0">Join our mission to save lives. Every donor is a hero!</p>
            </div>
            <div class="col-md-4 text-end">
                <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" style="height: 80px; width: auto;">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="donor-form-card card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-danger rounded-circle p-3 mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-plus text-white" style="font-size: 32px;"></i>
                        </div>
                        <h4 class="text-dark fw-bold">Donor Registration</h4>
                        <p class="text-muted">Fill in the details below to register a new blood donor</p>
                    </div>
                    
                    <form action="{{ route('register.donor.post') }}" method="POST" id="donorForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2"></i>Full Name<span class="required-asterisk">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Enter donor's complete name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-tint me-2"></i>Blood Group<span class="required-asterisk">*</span>
                            </label>
                            <select class="form-select @error('blood_group') is-invalid @enderror d-none" 
                                    id="blood_group" 
                                    name="blood_group" 
                                    required>
                                <option value="">Select Blood Group</option>
                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+ (A Positive)</option>
                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A- (A Negative)</option>
                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+ (B Positive)</option>
                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B- (B Negative)</option>
                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+ (AB Positive)</option>
                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB- (AB Negative)</option>
                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+ (O Positive)</option>
                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O- (O Negative)</option>
                            </select>
                            
                            <div class="blood-group-grid">
                                <div class="blood-type-tile" data-blood-type="A+">
                                    <div class="blood-type-icon">🅰️</div>
                                    <div class="fw-bold">A+</div>
                                    <small>A Positive</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="A-">
                                    <div class="blood-type-icon">🅰️</div>
                                    <div class="fw-bold">A-</div>
                                    <small>A Negative</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="B+">
                                    <div class="blood-type-icon">🅱️</div>
                                    <div class="fw-bold">B+</div>
                                    <small>B Positive</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="B-">
                                    <div class="blood-type-icon">🅱️</div>
                                    <div class="fw-bold">B-</div>
                                    <small>B Negative</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="AB+">
                                    <div class="blood-type-icon">🆎</div>
                                    <div class="fw-bold">AB+</div>
                                    <small>AB Positive</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="AB-">
                                    <div class="blood-type-icon">🆎</div>
                                    <div class="fw-bold">AB-</div>
                                    <small>AB Negative</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="O+">
                                    <div class="blood-type-icon">⭕</div>
                                    <div class="fw-bold">O+</div>
                                    <small>O Positive</small>
                                </div>
                                <div class="blood-type-tile" data-blood-type="O-">
                                    <div class="blood-type-icon">⭕</div>
                                    <div class="fw-bold">O-</div>
                                    <small>O Negative</small>
                                </div>
                            </div>
                            
                            @error('blood_group')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="phone_number" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Contact Number<span class="required-asterisk">*</span>
                                </label>
                                <input type="tel" 
                                       class="form-control @error('phone_number') is-invalid @enderror" 
                                       id="phone_number" 
                                       name="phone_number" 
                                       value="{{ old('phone_number') }}" 
                                       placeholder="Enter 10-15 digit contact number"
                                       pattern="[0-9]{10,15}"
                                       required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Enter a valid contact number for emergency situations
                                </div>
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-3 pt-4 justify-content-center">
                            <button type="submit" class="btn btn-danger btn-register">
                                <i class="fas fa-heart me-2"></i>Register Donor
                            </button>
                            <button type="reset" class="btn btn-secondary-custom">
                                <i class="fas fa-redo me-2"></i>Reset Form
                            </button>
                            <a href="{{ route('donors.list') }}" class="btn btn-info-custom">
                                <i class="fas fa-list me-2"></i>View Donors List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-xl-6">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">3</div>
                        <h5 class="fw-bold text-dark">Lives Saved</h5>
                        <p class="text-muted mb-0">Per blood donation</p>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">56</div>
                        <h5 class="fw-bold text-dark">Days</h5>
                        <p class="text-muted mb-0">Between donations</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stats-card">
                        <div class="stats-number">470ml</div>
                        <h5 class="fw-bold text-dark">Blood Volume</h5>
                        <p class="text-muted mb-0">Per donation</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Blood group tile selection
        const bloodTiles = document.querySelectorAll('.blood-type-tile');
        const bloodGroupSelect = document.getElementById('blood_group');
        
        bloodTiles.forEach(tile => {
            tile.addEventListener('click', function() {
                // Remove selected class from all tiles
                bloodTiles.forEach(t => t.classList.remove('selected'));
                
                // Add selected class to clicked tile
                this.classList.add('selected');
                
                // Update the hidden select element
                const bloodType = this.dataset.bloodType;
                bloodGroupSelect.value = bloodType;
                
                // Add animation effect
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
                
                // Show success notification
                showNotification(`Selected blood group: ${bloodType}`, 'success');
            });
        });
        
        // Set initial selection if old value exists
        const oldBloodGroup = bloodGroupSelect.value;
        if (oldBloodGroup) {
            const targetTile = document.querySelector(`[data-blood-type="${oldBloodGroup}"]`);
            if (targetTile) {
                targetTile.classList.add('selected');
            }
        }
        
        // Phone number validation with formatting
        const phoneInput = document.getElementById('phone_number');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            
            // Limit to 15 digits
            if (value.length > 15) {
                value = value.substring(0, 15);
            }
            
            e.target.value = value;
            
            // Visual feedback
            if (value.length >= 10 && value.length <= 15) {
                e.target.classList.remove('is-invalid');
                e.target.classList.add('is-valid');
            } else if (value.length > 0) {
                e.target.classList.remove('is-valid');
                e.target.classList.add('is-invalid');
            } else {
                e.target.classList.remove('is-valid', 'is-invalid');
            }
        });
        
        // Name input validation
        const nameInput = document.getElementById('name');
        nameInput.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            
            if (value.length >= 2) {
                e.target.classList.remove('is-invalid');
                e.target.classList.add('is-valid');
            } else if (value.length > 0) {
                e.target.classList.remove('is-valid');
                e.target.classList.add('is-invalid');
            } else {
                e.target.classList.remove('is-valid', 'is-invalid');
            }
        });
        
        // Enhanced form validation
        const form = document.getElementById('donorForm');
        form.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const bloodGroup = document.getElementById('blood_group').value;
            const phoneNumber = document.getElementById('phone_number').value.trim();
            
            let isValid = true;
            let errorMessage = '';
            
            if (!name || name.length < 2) {
                isValid = false;
                errorMessage = 'Please enter a valid full name (at least 2 characters).';
                document.getElementById('name').focus();
            } else if (!bloodGroup) {
                isValid = false;
                errorMessage = 'Please select a blood group.';
                document.querySelector('.blood-type-tile').focus();
            } else if (!phoneNumber || phoneNumber.length < 10 || phoneNumber.length > 15) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number (10-15 digits).';
                document.getElementById('phone_number').focus();
            }
            
            if (!isValid) {
                e.preventDefault();
                showNotification(errorMessage, 'error');
                return false;
            }
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Registering...';
            submitBtn.disabled = true;
            
            // Re-enable button after 3 seconds (in case of slow response)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });
        
        // Reset form functionality
        const resetBtn = form.querySelector('button[type="reset"]');
        resetBtn.addEventListener('click', function() {
            setTimeout(() => {
                bloodTiles.forEach(tile => tile.classList.remove('selected'));
                document.querySelectorAll('.form-control, .form-select').forEach(input => {
                    input.classList.remove('is-valid', 'is-invalid');
                });
                showNotification('Form has been reset', 'info');
            }, 100);
        });
        
        // Auto-focus first input
        document.getElementById('name').focus();
    });
    
    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.custom-notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} custom-notification position-fixed`;
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        `;
        
        const icon = type === 'success' ? 'check-circle' : 
                    type === 'error' ? 'exclamation-triangle' : 
                    type === 'info' ? 'info-circle' : 'bell';
        
        notification.innerHTML = `
            <i class="fas fa-${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto-remove after 4 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => notification.remove(), 300);
            }
        }, 4000);
    }
    
    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        .form-control.is-valid, .form-select.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
@endsection
