@extends('layouts.app')

@section('title', 'Profile - Yuva Blood Bank')
@section('page-title', 'User Profile')

@section('styles')
<style>
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #dc3545;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        transition: all 0.3s ease;
    }
    
    .profile-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(220, 53, 69, 0.4);
    }
    
    .profile-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #dc3545, #fd7e14, #ffc107);
    }
    
    .stats-badge {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
        border-radius: 12px;
        padding: 8px 15px;
        font-weight: 600;
        border: none;
    }
    
    .quick-stat-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 15px;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .quick-stat-card:hover {
        border-color: #dc3545;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(220, 53, 69, 0.1);
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <!-- Profile Picture Card -->
        <div class="card profile-card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <img src="{{ asset('yuva.jpg') }}" alt="Profile Picture" class="profile-avatar">
                </div>
                <h5 class="fw-bold">{{ $user['name'] }}</h5>
                <p class="text-muted mb-3">{{ $user['email'] }}</p>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="quick-stat-card">
                            <small class="fw-bold text-muted d-block mb-1">Status</small>
                            <span class="stats-badge">Active</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="quick-stat-card">
                            <small class="fw-bold text-muted d-block mb-1">Role</small>
                            <span class="badge bg-info">Administrator</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="card profile-card mt-3">
            <div class="card-header bg-transparent border-0">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="fas fa-chart-bar text-danger me-2"></i>Quick Stats
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center g-2">
                    <div class="col-4">
                        <div class="quick-stat-card">
                            <h6 class="text-danger mb-1">15</h6>
                            <small class="text-muted">Logins</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="quick-stat-card">
                            <h6 class="text-success mb-1">8</h6>
                            <small class="text-muted">Sessions</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="quick-stat-card">
                            <h6 class="text-info mb-1">3</h6>
                            <small class="text-muted">Actions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <!-- Profile Information -->
        <div class="card profile-card mb-4">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="fas fa-user text-danger me-2"></i>Profile Information
                </h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="{{ $user['name'] }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" id="email" value="{{ $user['email'] }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number</label>
                            <input type="text" class="form-control" id="phone" value="+91 98765 43210" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label fw-semibold">Department</label>
                            <input type="text" class="form-control" id="department" value="Blood Bank Management" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="joinDate" class="form-label fw-semibold">Join Date</label>
                            <input type="text" class="form-control" id="joinDate" value="{{ now()->subMonths(6)->format('M d, Y') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastLogin" class="form-label fw-semibold">Last Login</label>
                            <input type="text" class="form-control" id="lastLogin" value="{{ now()->format('M d, Y H:i:s') }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label fw-semibold">Bio</label>
                        <textarea class="form-control" id="bio" rows="3" readonly>Dedicated blood bank administrator working with Yuva Blood Bank Management System. Passionate about saving lives through efficient donor management and community service.</textarea>
                    </div>
                    
                    <div class="text-end">
                        <button type="button" class="btn btn-danger" onclick="enableEdit()">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </button>
                        <button type="button" class="btn btn-success d-none" id="saveBtn" onclick="saveProfile()">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                        <button type="button" class="btn btn-secondary d-none" id="cancelBtn" onclick="cancelEdit()">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Account Settings -->
        <div class="card profile-card">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="fas fa-cog text-danger me-2"></i>Account Settings
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-danger mb-3">Security Settings</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="twoFactor" checked>
                            <label class="form-check-label" for="twoFactor">
                                Two-Factor Authentication
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="loginAlerts" checked>
                            <label class="form-check-label" for="loginAlerts">
                                Login Email Alerts
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="sessionTimeout">
                            <label class="form-check-label" for="sessionTimeout">
                                Auto Session Timeout
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-danger mb-3">Notification Preferences</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="emailNotifs" checked>
                            <label class="form-check-label" for="emailNotifs">
                                Email Notifications
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="donorAlerts" checked>
                            <label class="form-check-label" for="donorAlerts">
                                Donor Registration Alerts
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="weeklyReports" checked>
                            <label class="form-check-label" for="weeklyReports">
                                Weekly Reports
                            </label>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-outline-warning">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-outline-danger">
                            <i class="fas fa-trash me-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let editMode = false;
    
    function enableEdit() {
        editMode = true;
        
        // Enable form fields
        document.querySelectorAll('#fullName, #phone, #department, #bio').forEach(field => {
            field.removeAttribute('readonly');
            field.classList.add('border-primary');
        });
        
        // Show/hide buttons
        document.querySelector('.btn-primary').classList.add('d-none');
        document.getElementById('saveBtn').classList.remove('d-none');
        document.getElementById('cancelBtn').classList.remove('d-none');
    }
    
    function saveProfile() {
        // Simulate save
        alert('Profile updated successfully!');
        cancelEdit();
    }
    
    function cancelEdit() {
        editMode = false;
        
        // Disable form fields
        document.querySelectorAll('#fullName, #phone, #department, #bio').forEach(field => {
            field.setAttribute('readonly', true);
            field.classList.remove('border-primary');
        });
        
        // Show/hide buttons
        document.querySelector('.btn-primary').classList.remove('d-none');
        document.getElementById('saveBtn').classList.add('d-none');
        document.getElementById('cancelBtn').classList.add('d-none');
    }
</script>
@endsection
