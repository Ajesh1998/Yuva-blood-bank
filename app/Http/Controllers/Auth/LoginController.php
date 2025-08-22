<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Static user credentials
     */
    private const STATIC_USERS = [
        [
            'email' => 'admin@example.com',
            'password' => 'password123',
            'name' => 'Administrator',
            'role' => 'Admin',
            'department' => 'IT Administration'
        ],
        [
            'email' => 'user@example.com', 
            'password' => 'userpass',
            'name' => 'Regular User',
            'role' => 'User',
            'department' => 'General'
        ],
        
        [
            'email' => 'yuva@gmail.com', 
            'password' => 'yuva@2017',
            'name' => 'Regular User',
            'role' => 'User',
            'department' => 'General'
        ]
    ];

    /**
     * File path for storing registered donors data
     */
    private const DONORS_DATA_FILE = 'registered_donors.json';

    /**
     * Get registered donors from file storage
     */
    private function getRegisteredDonors()
    {
        if (Storage::exists(self::DONORS_DATA_FILE)) {
            $data = Storage::get(self::DONORS_DATA_FILE);
            return json_decode($data, true) ?: [];
        }
        return [];
    }

    /**
     * Save registered donors to file storage
     */
    private function saveRegisteredDonors($donors)
    {
        Storage::put(self::DONORS_DATA_FILE, json_encode($donors, JSON_PRETTY_PRINT));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Only remove user session data, keep registered users in file storage
        Session::forget('user');

        return response()->json([
            'success' => true,
            'message' => 'You have been logged out successfully.'
        ]);
    }
}