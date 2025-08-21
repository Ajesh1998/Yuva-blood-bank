<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BloodBankController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes for Blood Bank
Route::prefix('bloodbank')->group(function () {
    Route::get('/app-info', [BloodBankController::class, 'getAppInfo']);
    Route::get('/stats', [BloodBankController::class, 'getStats']);
    Route::get('/donors', [BloodBankController::class, 'getDonorsList']);
    Route::get('/donors/{id}', [BloodBankController::class, 'getDonor']);
    Route::get('/donors/blood-type/{bloodType}', [BloodBankController::class, 'searchDonorsByBloodType']);
    Route::post('/donors', [BloodBankController::class, 'registerDonor']);
    Route::put('/donors/{id}', [BloodBankController::class, 'updateDonor']);
});
