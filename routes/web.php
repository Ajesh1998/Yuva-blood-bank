<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Index/Home Route
Route::get('/', [LoginController::class, 'index'])->name('index');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout route (available for authenticated users)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (Require authentication)
Route::middleware(['static.auth'])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::get('/reports', [LoginController::class, 'reports'])->name('reports');
    Route::get('/settings', [LoginController::class, 'settings'])->name('settings');
    
    // Blood Donor Registration and Listing
    Route::get('/register-donor', [LoginController::class, 'showRegisterForm'])->name('register.donor');
    Route::post('/register-donor', [LoginController::class, 'registerDonor'])->name('register.donor.post');
    Route::get('/donors-list', [LoginController::class, 'donorsList'])->name('donors.list');
    Route::get('/donors-list/export', [LoginController::class, 'exportDonors'])->name('donors.list.export');
    Route::post('/donors-list/delete/{id}', [LoginController::class, 'deleteDonor'])->name('donor.delete');
});
