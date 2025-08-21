@extends('layouts.app')

@section('title', 'Settings - Laravel App')
@section('page-title', 'Application Settings')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-4">
        <!-- Settings Navigation -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Settings Categories</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#general" class="list-group-item list-group-item-action active" onclick="showSection('general')">
                        <i class="fas fa-cog me-2"></i>General
                    </a>
                    <a href="#security" class="list-group-item list-group-item-action" onclick="showSection('security')">
                        <i class="fas fa-shield-alt me-2"></i>Security
                    </a>
                    <a href="#notifications" class="list-group-item list-group-item-action" onclick="showSection('notifications')">
                        <i class="fas fa-bell me-2"></i>Notifications
                    </a>
                    <a href="#appearance" class="list-group-item list-group-item-action" onclick="showSection('appearance')">
                        <i class="fas fa-palette me-2"></i>Appearance
                    </a>
                    <a href="#system" class="list-group-item list-group-item-action" onclick="showSection('system')">
                        <i class="fas fa-server me-2"></i>System
                    </a>
                    <a href="#backup" class="list-group-item list-group-item-action" onclick="showSection('backup')">
                        <i class="fas fa-database me-2"></i>Backup
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-9">
        <!-- General Settings -->
        <div id="general-section" class="settings-section">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog me-2"></i>General Settings
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="appName" class="form-label">Application Name</label>
                                <input type="text" class="form-control" id="appName" value="Laravel Static Auth App">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="appUrl" class="form-label">Application URL</label>
                                <input type="url" class="form-control" id="appUrl" value="http://localhost:8000">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select class="form-select" id="timezone">
                                    <option value="UTC" selected>UTC</option>
                                    <option value="America/New_York">Eastern Time</option>
                                    <option value="America/Chicago">Central Time</option>
                                    <option value="America/Denver">Mountain Time</option>
                                    <option value="America/Los_Angeles">Pacific Time</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="language" class="form-label">Default Language</label>
                                <select class="form-select" id="language">
                                    <option value="en" selected>English</option>
                                    <option value="es">Spanish</option>
                                    <option value="fr">French</option>
                                    <option value="de">German</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="appDescription" class="form-label">Application Description</label>
                            <textarea class="form-control" id="appDescription" rows="3">A Laravel application with static authentication system for demonstration purposes.</textarea>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="maintenanceMode">
                            <label class="form-check-label" for="maintenanceMode">
                                Enable Maintenance Mode
                            </label>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="saveSettings('general')">
                            <i class="fas fa-save me-2"></i>Save General Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Security Settings -->
        <div id="security-section" class="settings-section d-none">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-shield-alt me-2"></i>Security Settings
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                                <input type="number" class="form-control" id="sessionTimeout" value="120" min="5" max="1440">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="maxLoginAttempts" class="form-label">Max Login Attempts</label>
                                <input type="number" class="form-control" id="maxLoginAttempts" value="5" min="1" max="10">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Authentication Options</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="requireStrongPassword" checked>
                                    <label class="form-check-label" for="requireStrongPassword">
                                        Require Strong Passwords
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="twoFactorAuth">
                                    <label class="form-check-label" for="twoFactorAuth">
                                        Two-Factor Authentication
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="loginNotifications" checked>
                                    <label class="form-check-label" for="loginNotifications">
                                        Login Notifications
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Access Control</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="ipWhitelist">
                                    <label class="form-check-label" for="ipWhitelist">
                                        IP Whitelist
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="auditLog" checked>
                                    <label class="form-check-label" for="auditLog">
                                        Audit Logging
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="automaticLogout" checked>
                                    <label class="form-check-label" for="automaticLogout">
                                        Automatic Logout on Inactivity
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="saveSettings('security')">
                            <i class="fas fa-save me-2"></i>Save Security Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Notifications Settings -->
        <div id="notifications-section" class="settings-section d-none">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bell me-2"></i>Notification Settings
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Email Notifications</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="emailLogin" checked>
                                    <label class="form-check-label" for="emailLogin">
                                        Login Alerts
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="emailSecurity" checked>
                                    <label class="form-check-label" for="emailSecurity">
                                        Security Alerts
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="emailReports">
                                    <label class="form-check-label" for="emailReports">
                                        Weekly Reports
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="emailUpdates">
                                    <label class="form-check-label" for="emailUpdates">
                                        System Updates
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>In-App Notifications</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="appAlerts" checked>
                                    <label class="form-check-label" for="appAlerts">
                                        System Alerts
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="appMessages" checked>
                                    <label class="form-check-label" for="appMessages">
                                        New Messages
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="appTasks">
                                    <label class="form-check-label" for="appTasks">
                                        Task Reminders
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="appMaintenance" checked>
                                    <label class="form-check-label" for="appMaintenance">
                                        Maintenance Notices
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="notificationEmail" class="form-label">Notification Email</label>
                            <input type="email" class="form-control" id="notificationEmail" value="{{ $user['email'] }}">
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="saveSettings('notifications')">
                            <i class="fas fa-save me-2"></i>Save Notification Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Appearance Settings -->
        <div id="appearance-section" class="settings-section d-none">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-palette me-2"></i>Appearance Settings
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="theme" class="form-label">Color Theme</label>
                                <select class="form-select" id="theme">
                                    <option value="default" selected>Default Blue</option>
                                    <option value="dark">Dark Mode</option>
                                    <option value="light">Light Mode</option>
                                    <option value="green">Green Theme</option>
                                    <option value="purple">Purple Theme</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sidebarStyle" class="form-label">Sidebar Style</label>
                                <select class="form-select" id="sidebarStyle">
                                    <option value="fixed" selected>Fixed</option>
                                    <option value="collapsible">Collapsible</option>
                                    <option value="overlay">Overlay</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fontSize" class="form-label">Font Size</label>
                                <select class="form-select" id="fontSize">
                                    <option value="small">Small</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="large">Large</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="logoUrl" class="form-label">Custom Logo URL</label>
                                <input type="url" class="form-control" id="logoUrl" placeholder="https://example.com/logo.png">
                            </div>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="animationsEnabled" checked>
                            <label class="form-check-label" for="animationsEnabled">
                                Enable Animations
                            </label>
                        </div>
                        
                        <button type="button" class="btn btn-primary" onclick="saveSettings('appearance')">
                            <i class="fas fa-save me-2"></i>Save Appearance Settings
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- System Settings -->
        <div id="system-section" class="settings-section d-none">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-server me-2"></i>System Settings
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>System Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Laravel Version:</strong></td>
                                    <td>{{ app()->version() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>PHP Version:</strong></td>
                                    <td>{{ PHP_VERSION }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Environment:</strong></td>
                                    <td>{{ app()->environment() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Debug Mode:</strong></td>
                                    <td>{{ config('app.debug') ? 'Enabled' : 'Disabled' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>System Actions</h6>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-info" onclick="clearCache()">
                                    <i class="fas fa-broom me-2"></i>Clear Cache
                                </button>
                                <button type="button" class="btn btn-outline-warning" onclick="optimizeApp()">
                                    <i class="fas fa-rocket me-2"></i>Optimize Application
                                </button>
                                <button type="button" class="btn btn-outline-success" onclick="runMaintenance()">
                                    <i class="fas fa-tools me-2"></i>Run Maintenance
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="generateErrorReport()">
                                    <i class="fas fa-bug me-2"></i>Generate Error Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Backup Settings -->
        <div id="backup-section" class="settings-section d-none">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-database me-2"></i>Backup Settings
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="backupFrequency" class="form-label">Backup Frequency</label>
                                <select class="form-select" id="backupFrequency">
                                    <option value="daily">Daily</option>
                                    <option value="weekly" selected>Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="manual">Manual Only</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="backupRetention" class="form-label">Retention Period</label>
                                <select class="form-select" id="backupRetention">
                                    <option value="7">7 days</option>
                                    <option value="30" selected>30 days</option>
                                    <option value="90">90 days</option>
                                    <option value="365">1 year</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="includeFiles" checked>
                            <label class="form-check-label" for="includeFiles">
                                Include Application Files
                            </label>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="compressBackup" checked>
                            <label class="form-check-label" for="compressBackup">
                                Compress Backup Files
                            </label>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary" onclick="saveSettings('backup')">
                                <i class="fas fa-save me-2"></i>Save Backup Settings
                            </button>
                            <button type="button" class="btn btn-success" onclick="createBackup()">
                                <i class="fas fa-download me-2"></i>Create Backup Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(section => {
            section.classList.add('d-none');
        });
        
        // Show selected section
        document.getElementById(sectionName + '-section').classList.remove('d-none');
        
        // Update navigation
        document.querySelectorAll('.list-group-item').forEach(item => {
            item.classList.remove('active');
        });
        
        event.target.closest('.list-group-item').classList.add('active');
    }
    
    function saveSettings(category) {
        alert('Saving ' + category + ' settings...');
    }
    
    function clearCache() {
        alert('Clearing application cache...');
    }
    
    function optimizeApp() {
        alert('Optimizing application...');
    }
    
    function runMaintenance() {
        alert('Running maintenance tasks...');
    }
    
    function generateErrorReport() {
        alert('Generating error report...');
    }
    
    function createBackup() {
        alert('Creating backup...');
    }
</script>
@endsection
