<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BloodBankController extends Controller
{
    /**
     * Get application statistics
     */
    public function getStats(): JsonResponse
    {
        $donors = $this->getDonors();
        
        return response()->json([
            'stats' => [
                'livesSaved' => count($donors) * 2, // Approximate lives saved
                'activeDonors' => count($donors),
                'bloodTypes' => 8,
                'availability' => '24/7'
            ]
        ]);
    }

    /**
     * Get all donors
     */
    public function getDonors(): array
    {
        try {
            if (Storage::exists('registered_donors.json')) {
                $donorsJson = Storage::get('registered_donors.json');
                return json_decode($donorsJson, true) ?? [];
            }
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get donors list for API
     */
    public function getDonorsList(): JsonResponse
    {
        $donors = $this->getDonors();
        
        return response()->json([
            'donors' => $donors,
            'total' => count($donors)
        ]);
    }

    /**
     * Register a new donor
     */
    public function registerDonor(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'age' => 'required|integer|min:18|max:65',
            'address' => 'required|string|max:500',
            'medical_conditions' => 'nullable|string|max:1000',
            'last_donation' => 'nullable|date'
        ]);

        $donors = $this->getDonors();
        
        // Check if donor already exists
        foreach ($donors as $donor) {
            if ($donor['email'] === $request->email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Donor with this email already exists.'
                ], 409);
            }
        }

        $newDonor = [
            'id' => uniqid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'blood_type' => $request->blood_type,
            'age' => $request->age,
            'address' => $request->address,
            'medical_conditions' => $request->medical_conditions,
            'last_donation' => $request->last_donation,
            'registration_date' => now()->toDateString(),
            'status' => 'active'
        ];

        $donors[] = $newDonor;

        try {
            Storage::put('registered_donors.json', json_encode($donors, JSON_PRETTY_PRINT));
            
            return response()->json([
                'success' => true,
                'message' => 'Donor registered successfully!',
                'donor' => $newDonor
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register donor. Please try again.'
            ], 500);
        }
    }

    /**
     * Get donor by ID
     */
    public function getDonor(string $id): JsonResponse
    {
        $donors = $this->getDonors();
        
        foreach ($donors as $donor) {
            if ($donor['id'] === $id) {
                return response()->json([
                    'success' => true,
                    'donor' => $donor
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Donor not found.'
        ], 404);
    }

    /**
     * Update donor information
     */
    public function updateDonor(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'phone' => 'string|max:20',
            'blood_type' => 'in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'age' => 'integer|min:18|max:65',
            'address' => 'string|max:500',
            'medical_conditions' => 'nullable|string|max:1000',
            'last_donation' => 'nullable|date',
            'status' => 'in:active,inactive'
        ]);

        $donors = $this->getDonors();
        
        foreach ($donors as $index => $donor) {
            if ($donor['id'] === $id) {
                $donors[$index] = array_merge($donor, $request->only([
                    'name', 'email', 'phone', 'blood_type', 'age', 
                    'address', 'medical_conditions', 'last_donation', 'status'
                ]));

                try {
                    Storage::put('registered_donors.json', json_encode($donors, JSON_PRETTY_PRINT));
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Donor updated successfully!',
                        'donor' => $donors[$index]
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to update donor. Please try again.'
                    ], 500);
                }
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Donor not found.'
        ], 404);
    }

    /**
     * Search donors by blood type
     */
    public function searchDonorsByBloodType(string $bloodType): JsonResponse
    {
        $donors = $this->getDonors();
        
        $filteredDonors = array_filter($donors, function($donor) use ($bloodType) {
            return $donor['blood_type'] === $bloodType && 
                   ($donor['status'] ?? 'active') === 'active';
        });

        return response()->json([
            'blood_type' => $bloodType,
            'donors' => array_values($filteredDonors),
            'count' => count($filteredDonors)
        ]);
    }

    /**
     * Get application info
     */
    public function getAppInfo(): JsonResponse
    {
        return response()->json([
            'app_name' => 'Yuva Blood Bank',
            'version' => '1.0.0',
            'description' => 'Professional Blood Donor Management System',
            'tagline' => 'Saving Lives Together'
        ]);
    }
}
