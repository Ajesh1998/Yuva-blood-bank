<?php

use Illuminate\Support\Facades\Route;

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

// Catch-all route for React SPA - redirect all web routes to React frontend
Route::get('/{any}', function () {
    return redirect()->away('http://localhost:3001');
})->where('any', '.*');
