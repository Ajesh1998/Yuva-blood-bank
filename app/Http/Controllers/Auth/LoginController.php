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
     * Show the login form
     */
    public function showLoginForm()
    {
        // Redirect to dashboard if already logged in
        if (Session::has('user')) {
            return redirect()->route('dashboard')->with('info', 'You are already logged in.');
        }

        return view('auth.login');
    }

    /**
     /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Check against static data
        foreach (self::STATIC_USERS as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                // Store user in session
                Session::put('user', [
                    'email' => $user['email'],
                    'name' => $user['name']
                ]);

                return redirect()->route('dashboard')->with('success', 'Login successful!');
            }
        }

        // Login failed
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Show dashboard (protected page)
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access the dashboard.');
        }

        $user = Session::get('user');
        $registeredDonors = $this->getRegisteredDonors();
        
        return view('dashboard', compact('user', 'registeredDonors'));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Only remove user session data, keep registered users in file storage
        Session::forget('user');

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show user profile page
     */
    public function profile()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Session::get('user');
        return view('profile', compact('user'));
    }

    /**
     * Show reports page
     */
    public function reports()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Session::get('user');
        return view('reports', compact('user'));
    }

    /**
     * Show settings page
     */
    public function settings()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Session::get('user');
        return view('settings', compact('user'));
    }

    /**
     * Show donor registration form
     */
    public function showRegisterForm()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Session::get('user');
        return view('register-donor', compact('user'));
    }

    /**
     * Handle donor registration
     */
    public function registerDonor(Request $request)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'blood_group' => 'required|string',
            'phone_number' => 'required|string|min:10|max:15',
        ]);

        // Get existing registered donors from file storage
        $registeredDonors = $this->getRegisteredDonors();

        // Add new donor data
        $newDonor = [
            'id' => count($registeredDonors) + 1,
            'name' => $request->input('name'),
            'blood_group' => $request->input('blood_group'),
            'phone_number' => $request->input('phone_number'),
            'registered_at' => now()->format('Y-m-d H:i:s'),
            'registered_by' => Session::get('user.name')
        ];

        $registeredDonors[] = $newDonor;

        // Save to file storage
        $this->saveRegisteredDonors($registeredDonors);

        return redirect()->route('register.donor')->with('success', 'Blood donor registered successfully!');
    }

    /**
     * Show donors list
     */
    public function donorsList()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Session::get('user');
        $registeredDonors = $this->getRegisteredDonors();

        return view('donors-list', compact('user', 'registeredDonors'));
    }

    /**
     * Delete a donor from the list
     */
    public function deleteDonor($id)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $registeredDonors = $this->getRegisteredDonors();

        // Find and remove donor by ID
        $donorFound = false;
        foreach ($registeredDonors as $index => $donor) {
            if ($donor['id'] == $id) {
                unset($registeredDonors[$index]);
                $donorFound = true;
                break;
            }
        }

        if ($donorFound) {
            // Re-index array
            $registeredDonors = array_values($registeredDonors);
            $this->saveRegisteredDonors($registeredDonors);
            
            return redirect()->route('donors.list')->with('success', 'Blood donor deleted successfully!');
        }

        return redirect()->route('donors.list')->with('error', 'Blood donor not found!');
    }

    /**
     * Export donors list
     */
    public function exportDonors()
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $registeredDonors = $this->getRegisteredDonors();

        // Generate CSV content
        $csv = "ID,Name,Blood Group,Phone Number,Registered At,Registered By\n";
        foreach ($registeredDonors as $donor) {
            $csv .= "{$donor['id']},{$donor['name']},{$donor['blood_group']},{$donor['phone_number']},{$donor['registered_at']},{$donor['registered_by']}\n";
        }

        $filename = 'blood_donors_' . date('Y-m-d_H-i-s') . '.csv';

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}