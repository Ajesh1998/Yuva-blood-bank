@extends('layouts.app')

@section('title', 'Yuva Blood Bank - Donors Registry')

@section('page-title', 'Yuva Blood Bank - Donors Registry')

@section('styles')
<style>
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #dc3545 0%, #8b0000 100%);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='3'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: float 30s infinite linear;
    }

    .hero-logo {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .hero-logo:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.5);
    }

    @keyframes float {
        0% { transform: translateX(-50px) translateY(-50px); }
        100% { transform: translateX(-50px) translateY(-50px) translateX(60px) translateY(60px); }
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #dc3545, #ff6b6b);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 24px;
    }

    .search-controls {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        border: 1px solid rgba(220, 53, 69, 0.1);
    }

    .search-input {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .search-input:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        background: white;
        transform: translateY(-1px);
    }

    .filter-select {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 16px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
        background: white;
    }

    .donors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }

    .donor-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .donor-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    .donor-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .donor-avatar {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 20px;
        margin-right: 16px;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .donor-info h4 {
        margin: 0 0 4px 0;
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
    }

    .donor-info .meta {
        font-size: 14px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blood-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }

    .donor-details {
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .detail-item:hover {
        background: #e9ecef;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(220, 53, 69, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc3545;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-value {
        font-size: 14px;
        font-weight: 500;
        color: #2d3748;
    }

    .donor-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .action-btn {
        padding: 10px 16px;
        border-radius: 10px;
        border: none;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-view {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .btn-view:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: #64748b;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .view-toggle {
        display: flex;
        background: white;
        border-radius: 12px;
        padding: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .view-btn {
        padding: 8px 16px;
        border: none;
        background: transparent;
        border-radius: 8px;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .view-btn.active {
        background: #dc3545;
        color: white;
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
    }

    .result-info {
        background: rgba(220, 53, 69, 0.1);
        color: #8b0000;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .clear-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .clear-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Blood Group Tiles */
    .blood-tiles-section {
        margin-bottom: 30px;
    }

    .blood-tiles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .blood-tile {
        background: white;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 2px solid rgba(220, 53, 69, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .blood-tile::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #dc3545, #ff6b6b);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .blood-tile:hover::before,
    .blood-tile.active::before {
        transform: scaleX(1);
    }

    .blood-tile:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(220, 53, 69, 0.2);
        border-color: #dc3545;
    }

    .blood-tile.active {
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(220, 53, 69, 0.3);
        animation: pulseActive 2s infinite;
    }

    @keyframes pulseActive {
        0%, 100% { 
            box-shadow: 0 8px 30px rgba(220, 53, 69, 0.3);
        }
        50% { 
            box-shadow: 0 12px 40px rgba(220, 53, 69, 0.5);
        }
    }

    .blood-tile.clicked {
        animation: clickPulse 0.3s ease-out;
    }

    @keyframes clickPulse {
        0% { transform: translateY(-4px) scale(1); }
        50% { transform: translateY(-6px) scale(1.05); }
        100% { transform: translateY(-2px) scale(1); }
    }

    .blood-tile.active .blood-type {
        color: white;
    }

    .blood-tile.active .donor-count {
        color: rgba(255, 255, 255, 0.9);
    }

    .blood-type {
        font-size: 24px;
        font-weight: 700;
        color: #dc3545;
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }

    .donor-count {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .blood-icon {
        font-size: 20px;
        margin-bottom: 8px;
        opacity: 0.8;
    }

    .tiles-header {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-left: 4px solid #dc3545;
    }

    .clear-filter-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        float: right;
    }

    .clear-filter-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: white;
    }

    .filter-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(40, 167, 69, 0.3);
        z-index: 9999;
        transform: translateX(400px);
        transition: transform 0.3s ease;
    }

    .filter-notification.show {
        transform: translateX(0);
    }

    .filter-notification .close-btn {
        background: none;
        border: none;
        color: white;
        margin-left: 10px;
        cursor: pointer;
        opacity: 0.8;
    }

    .filter-notification .close-btn:hover {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .donors-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-section {
            padding: 24px;
        }
        
        .search-controls {
            padding: 20px;
        }
        
        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('yuva.jpg') }}" alt="Yuva Blood Bank" class="hero-logo me-3">
                    <div>
                        <h1 class="fw-bold mb-0">Yuva Blood Bank</h1>
                        <h4 class="mb-0 opacity-90">Donors Registry</h4>
                    </div>
                </div>
                <p class="mb-0 opacity-90">Manage and connect with our life-saving blood donor community</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('register.donor') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Register New Donor
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1);">
                <i class="fas fa-heart text-danger"></i>
            </div>
            <h3 class="mb-1">{{ count($registeredDonors) }}</h3>
            <p class="text-muted mb-0">Total Donors</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(40, 167, 69, 0.1);">
                <i class="fas fa-users text-success"></i>
            </div>
            <h3 class="mb-1">{{ count(array_unique(array_column($registeredDonors, 'blood_group'))) }}</h3>
            <p class="text-muted mb-0">Blood Types</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(23, 162, 184, 0.1);">
                <i class="fas fa-calendar text-info"></i>
            </div>
            <h3 class="mb-1">{{ count(array_filter($registeredDonors, function($donor) { return \Carbon\Carbon::parse($donor['registered_at'])->isToday(); })) }}</h3>
            <p class="text-muted mb-0">Today's Registrations</p>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(255, 193, 7, 0.1);">
                <i class="fas fa-clock text-warning"></i>
            </div>
            <h3 class="mb-1">{{ count(array_filter($registeredDonors, function($donor) { return \Carbon\Carbon::parse($donor['registered_at'])->isCurrentWeek(); })) }}</h3>
            <p class="text-muted mb-0">This Week</p>
        </div>
    </div>

    @if(count($registeredDonors) > 0)
        <!-- Blood Group Tiles Section -->
        <div class="blood-tiles-section">
            <div class="tiles-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-danger">
                            <i class="fas fa-tint me-2"></i>Filter by Blood Group
                        </h5>
                        <p class="text-muted mb-0">Click on any blood group tile to filter donors</p>
                    </div>
                    <button type="button" class="clear-filter-btn" id="clearBloodFilter" style="display: none;">
                        <i class="fas fa-times me-2"></i>Clear Filter
                    </button>
                </div>
            </div>
            
            <div class="blood-tiles-grid" id="bloodTilesGrid">
                <!-- Blood group tiles will be populated by JavaScript -->
            </div>
        </div>

        <!-- Search and Filter Controls -->
        <div class="search-controls">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-danger mb-2">
                        <i class="fas fa-search me-2"></i>Search Donors
                    </label>
                    <input type="text" 
                           class="form-control search-input" 
                           id="searchInput" 
                           placeholder="Search by name, phone, or registration staff...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-danger mb-2">
                        <i class="fas fa-filter me-2"></i>Filter by Blood Group
                    </label>
                    <select class="form-select filter-select" id="bloodGroupFilter">
                        <option value="">🩸 All Blood Groups</option>
                        <option value="A+">🔴 A+ Positive</option>
                        <option value="A-">🔴 A- Negative</option>
                        <option value="B+">🔵 B+ Positive</option>
                        <option value="B-">🔵 B- Negative</option>
                        <option value="AB+">🟣 AB+ Positive</option>
                        <option value="AB-">🟣 AB- Negative</option>
                        <option value="O+">🟢 O+ Positive</option>
                        <option value="O-">🟢 O- Negative</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn clear-btn w-100" id="clearFilters">
                        <i class="fas fa-times me-2"></i>Clear
                    </button>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="result-info">
                <i class="fas fa-info-circle"></i>
                <span id="resultInfo">Showing all {{ count($registeredDonors) }} donors</span>
            </div>
            
            <div class="d-flex gap-2 align-items-center">
                @if(count($registeredDonors) > 0)
                    <a href="{{ route('donors.list.export') }}" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Export CSV
                    </a>
                @endif
                
                <div class="view-toggle">
                    <button class="view-btn active" id="gridView">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" id="tableView">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Donors Grid -->
        <div class="donors-grid" id="donorsGrid">
            <!-- Grid items will be populated by JavaScript -->
        </div>
        
        <!-- Donors Table (Hidden by default) -->
        <div class="d-none" id="donorsTable">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Donor</th>
                                <th>Blood Group</th>
                                <th>Contact</th>
                                <th>Registered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="donorsTableBody">
                            <!-- Table rows will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-heart-broken"></i>
            </div>
            <h3 class="mb-3">No Donors Registered Yet</h3>
            <p class="text-muted mb-4">Start building your blood donor community by registering the first donor.</p>
            <a href="{{ route('register.donor') }}" class="btn btn-danger btn-lg">
                <i class="fas fa-plus me-2"></i>Register First Donor
            </a>
        </div>
    @endif
</div>

<!-- Filter Notification -->
<div class="filter-notification" id="filterNotification">
    <i class="fas fa-filter me-2"></i>
    <span id="notificationText">Filter applied</span>
    <button class="close-btn" onclick="hideNotification()">
        <i class="fas fa-times"></i>
    </button>
</div>

<!-- Donor Details Modal -->
<div class="modal fade" id="donorModal" tabindex="-1" aria-labelledby="donorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="donorModalLabel">
                    <i class="fas fa-user-md me-2"></i>Donor Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="donor-avatar mb-3" id="modalDonorAvatar" style="width: 100px; height: 100px; font-size: 36px; margin: 0 auto;">
                            <!-- Avatar initials -->
                        </div>
                        <div class="blood-badge" id="modalBloodBadge">
                            <!-- Blood group -->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="donor-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Full Name</div>
                                    <div class="detail-value" id="modalDonorName"></div>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Contact Number</div>
                                    <div class="detail-value">
                                        <a href="#" id="modalDonorPhone" class="text-decoration-none"></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Registration Date</div>
                                    <div class="detail-value" id="modalDonorDate"></div>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Registered By</div>
                                    <div class="detail-value" id="modalDonorStaff"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="modalCallButton" class="btn btn-success">
                    <i class="fas fa-phone me-2"></i>Call Donor
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Store donors data and current view
    const allDonors = @json($registeredDonors);
    let filteredDonors = [...allDonors];
    let currentView = 'grid';
    let selectedBloodGroup = '';
    
    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
        renderBloodTiles();
        renderDonors();
        setupFilters();
        setupViewToggle();
        setupBloodTiles();
    });
    
    // Render donors in current view mode
    function renderDonors() {
        if (currentView === 'grid') {
            renderGridView();
        } else {
            renderTableView();
        }
        updateResultInfo();
    }
    
    // Render grid view
    function renderGridView() {
        const container = document.getElementById('donorsGrid');
        container.innerHTML = '';
        
        if (filteredDonors.length === 0) {
            container.innerHTML = `
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4 class="mb-3">No donors found</h4>
                        <p class="text-muted mb-4">No donors match your current search criteria.</p>
                        <button type="button" class="btn btn-danger" onclick="clearAllFilters()">
                            <i class="fas fa-refresh me-2"></i>Clear Filters & Show All
                        </button>
                    </div>
                </div>
            `;
            return;
        }
        
        filteredDonors.forEach((donor, index) => {
            const donorCard = createDonorCard(donor);
            container.appendChild(donorCard);
        });
        
        // Add fade-in animation
        container.querySelectorAll('.donor-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fade-in');
        });
    }
    
    // Create donor card element
    function createDonorCard(donor) {
        const card = document.createElement('div');
        card.className = 'donor-card';
        
        const registrationDate = new Date(donor.registered_at);
        const formattedDate = registrationDate.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric', 
            year: 'numeric' 
        });
        const formattedTime = registrationDate.toLocaleTimeString('en-US', { 
            hour: 'numeric', 
            minute: '2-digit', 
            hour12: true 
        });
        
        card.innerHTML = `
            <div class="blood-badge">${donor.blood_group}</div>
            
            <div class="donor-header">
                <div class="donor-avatar">
                    ${donor.name.substring(0, 2).toUpperCase()}
                </div>
                <div class="donor-info">
                    <h4>${donor.name}</h4>
                    <div class="meta">
                        <i class="fas fa-user-tie"></i>
                        <span>by ${donor.registered_by}</span>
                    </div>
                </div>
            </div>
            
            <div class="donor-details">
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Contact Number</div>
                        <div class="detail-value">
                            <a href="tel:${donor.phone_number}" class="text-decoration-none">${donor.phone_number}</a>
                        </div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Registration Date</div>
                        <div class="detail-value">${formattedDate} at ${formattedTime}</div>
                    </div>
                </div>
            </div>
            
            <div class="donor-actions">
                <button class="action-btn btn-view" onclick="viewDonor(${JSON.stringify(donor).replace(/"/g, '&quot;')})">
                    <i class="fas fa-eye"></i>
                    View
                </button>
                <form method="POST" action="{{ route('donor.delete', '') }}/${donor.id}" 
                      class="d-inline" 
                      onsubmit="return confirmDelete('${donor.name}')">
                    @csrf
                    <button type="submit" class="action-btn btn-delete">
                        <i class="fas fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
        `;
        
        return card;
    }
    
    // Render table view
    function renderTableView() {
        const tbody = document.getElementById('donorsTableBody');
        tbody.innerHTML = '';
        
        if (filteredDonors.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h5 class="mb-3">No donors found</h5>
                            <p class="text-muted mb-4">No donors match your current search criteria.</p>
                            <button type="button" class="btn btn-danger" onclick="clearAllFilters()">
                                <i class="fas fa-refresh me-2"></i>Clear Filters & Show All
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }
        
        filteredDonors.forEach(donor => {
            const row = document.createElement('tr');
            
            const registrationDate = new Date(donor.registered_at);
            const formattedDate = registrationDate.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric' 
            });
            
            row.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="donor-avatar me-3" style="width: 40px; height: 40px; font-size: 14px;">
                            ${donor.name.substring(0, 2).toUpperCase()}
                        </div>
                        <div>
                            <strong>${donor.name}</strong>
                            <br>
                            <small class="text-muted">by ${donor.registered_by}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="blood-badge" style="position: static; font-size: 12px; padding: 6px 12px;">
                        ${donor.blood_group}
                    </span>
                </td>
                <td>
                    <a href="tel:${donor.phone_number}" class="text-decoration-none">
                        <i class="fas fa-phone text-muted me-2"></i>
                        ${donor.phone_number}
                    </a>
                </td>
                <td>
                    <small class="text-muted">${formattedDate}</small>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-outline-info" onclick="viewDonor(${JSON.stringify(donor).replace(/"/g, '&quot;')})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <form method="POST" action="{{ route('donor.delete', '') }}/${donor.id}" 
                              class="d-inline" 
                              onsubmit="return confirmDelete('${donor.name}')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            `;
            
            tbody.appendChild(row);
        });
    }
    
    // Render blood group tiles
    function renderBloodTiles() {
        const container = document.getElementById('bloodTilesGrid');
        const bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        const bloodIcons = {
            'A+': '🔴', 'A-': '🔴', 
            'B+': '🔵', 'B-': '🔵',
            'AB+': '🟣', 'AB-': '🟣',
            'O+': '🟢', 'O-': '🟢'
        };
        
        container.innerHTML = '';
        
        bloodGroups.forEach(bloodGroup => {
            const count = allDonors.filter(donor => donor.blood_group === bloodGroup).length;
            
            const tile = document.createElement('div');
            tile.className = 'blood-tile';
            tile.setAttribute('data-blood-group', bloodGroup);
            
            tile.innerHTML = `
                <div class="blood-icon">${bloodIcons[bloodGroup]}</div>
                <div class="blood-type">${bloodGroup}</div>
                <div class="donor-count">${count} donor${count !== 1 ? 's' : ''}</div>
            `;
            
            tile.addEventListener('click', () => filterByBloodGroup(bloodGroup));
            container.appendChild(tile);
        });
    }
    
    // Setup blood tiles functionality
    function setupBloodTiles() {
        const clearFilterBtn = document.getElementById('clearBloodFilter');
        
        clearFilterBtn.addEventListener('click', function() {
            clearBloodGroupFilter();
        });
    }
    
    // Filter donors by blood group
    function filterByBloodGroup(bloodGroup) {
        selectedBloodGroup = bloodGroup;
        
        // Add click animation
        const clickedTile = document.querySelector(`[data-blood-group="${bloodGroup}"]`);
        clickedTile.classList.add('clicked');
        setTimeout(() => {
            clickedTile.classList.remove('clicked');
        }, 300);
        
        // Update tiles visual state
        document.querySelectorAll('.blood-tile').forEach(tile => {
            if (tile.getAttribute('data-blood-group') === bloodGroup) {
                tile.classList.add('active');
            } else {
                tile.classList.remove('active');
            }
        });
        
        // Update blood group filter dropdown
        document.getElementById('bloodGroupFilter').value = bloodGroup;
        
        // Show clear filter button
        document.getElementById('clearBloodFilter').style.display = 'inline-block';
        
        // Apply filters
        applyFilters();
        
        // Show notification
        showNotification(`Showing ${bloodGroup} donors only`);
    }
    
    // Show filter notification
    function showNotification(message) {
        const notification = document.getElementById('filterNotification');
        const notificationText = document.getElementById('notificationText');
        
        notificationText.textContent = message;
        notification.classList.add('show');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            hideNotification();
        }, 3000);
    }
    
    // Hide notification
    function hideNotification() {
        const notification = document.getElementById('filterNotification');
        notification.classList.remove('show');
    }
    
    // Clear blood group filter
    function clearBloodGroupFilter() {
        selectedBloodGroup = '';
        
        // Remove active state from all tiles
        document.querySelectorAll('.blood-tile').forEach(tile => {
            tile.classList.remove('active');
        });
        
        // Clear blood group filter dropdown
        document.getElementById('bloodGroupFilter').value = '';
        
        // Hide clear filter button
        document.getElementById('clearBloodFilter').style.display = 'none';
        
        // Apply filters
        applyFilters();
        
        // Show notification
        showNotification('Filter cleared - showing all donors');
    }
    
    // Setup filtering functionality
    function setupFilters() {
        const searchInput = document.getElementById('searchInput');
        const bloodGroupFilter = document.getElementById('bloodGroupFilter');
        const clearFiltersBtn = document.getElementById('clearFilters');
        
        // Search with debounce
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 300);
        });
        
        // Blood group filter (also handle tile selection)
        bloodGroupFilter.addEventListener('change', function() {
            const selectedGroup = this.value;
            if (selectedGroup) {
                filterByBloodGroup(selectedGroup);
            } else {
                clearBloodGroupFilter();
            }
        });
        
        // Clear filters
        clearFiltersBtn.addEventListener('click', clearAllFilters);
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                searchInput.focus();
            }
            if (e.key === 'Escape') {
                clearAllFilters();
                searchInput.blur();
            }
        });
    }
    
    // Apply current filters
    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const dropdownBloodGroup = document.getElementById('bloodGroupFilter').value;
        
        // Use tile selection if available, otherwise use dropdown
        const effectiveBloodGroup = selectedBloodGroup || dropdownBloodGroup;
        
        filteredDonors = allDonors.filter(donor => {
            const matchesSearch = !searchTerm || 
                donor.name.toLowerCase().includes(searchTerm) ||
                donor.phone_number.includes(searchTerm) ||
                donor.registered_by.toLowerCase().includes(searchTerm);
            
            const matchesBloodGroup = !effectiveBloodGroup || 
                donor.blood_group === effectiveBloodGroup;
            
            return matchesSearch && matchesBloodGroup;
        });
        
        renderDonors();
    }
    
    // Clear all filters
    function clearAllFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('bloodGroupFilter').value = '';
        clearBloodGroupFilter();
        filteredDonors = [...allDonors];
        renderDonors();
    }
    
    // Setup view toggle
    function setupViewToggle() {
        const gridViewBtn = document.getElementById('gridView');
        const tableViewBtn = document.getElementById('tableView');
        const donorsGrid = document.getElementById('donorsGrid');
        const donorsTable = document.getElementById('donorsTable');
        
        gridViewBtn.addEventListener('click', function() {
            currentView = 'grid';
            gridViewBtn.classList.add('active');
            tableViewBtn.classList.remove('active');
            donorsGrid.classList.remove('d-none');
            donorsTable.classList.add('d-none');
            renderDonors();
        });
        
        tableViewBtn.addEventListener('click', function() {
            currentView = 'table';
            tableViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            donorsTable.classList.remove('d-none');
            donorsGrid.classList.add('d-none');
            renderDonors();
        });
    }
    
    // Update result information
    function updateResultInfo() {
        const resultInfo = document.getElementById('resultInfo');
        const total = allDonors.length;
        const showing = filteredDonors.length;
        
        if (showing === total) {
            resultInfo.innerHTML = `<i class="fas fa-info-circle"></i> Showing all ${total} donors`;
        } else {
            resultInfo.innerHTML = `<i class="fas fa-filter"></i> Showing ${showing} of ${total} donors`;
        }
    }
    
    // View donor details in modal
    function viewDonor(donor) {
        // Populate modal avatar
        document.getElementById('modalDonorAvatar').textContent = donor.name.substring(0, 2).toUpperCase();
        
        // Populate modal blood badge
        document.getElementById('modalBloodBadge').textContent = donor.blood_group;
        
        // Populate modal details
        document.getElementById('modalDonorName').textContent = donor.name;
        document.getElementById('modalDonorPhone').textContent = donor.phone_number;
        document.getElementById('modalDonorPhone').href = 'tel:' + donor.phone_number;
        document.getElementById('modalDonorDate').textContent = new Date(donor.registered_at).toLocaleString();
        document.getElementById('modalDonorStaff').textContent = donor.registered_by;
        
        // Set call button
        document.getElementById('modalCallButton').href = 'tel:' + donor.phone_number;
        
        // Show modal
        new bootstrap.Modal(document.getElementById('donorModal')).show();
    }
    
    // Confirm delete action
    function confirmDelete(donorName) {
        return confirm(`Are you sure you want to delete blood donor "${donorName}"?\n\nThis action cannot be undone.`);
    }
</script>
@endsection
