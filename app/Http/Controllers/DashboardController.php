<?php

namespace App\Http\Controllers;

use App\Models\DataEntry;
use App\Models\Municipality;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get statistics based on user role
        $totalEntries = $this->getTotalEntriesForUser($user);
        $totalAmount = $this->getTotalAmountForUser($user);
        $recentEntries = $this->getRecentEntriesForUser($user);
        $municipalities = Municipality::active()->get(['id', 'name', 'name_nepali', 'type']);
        
        return Inertia::render('dashboard', [
            'totalEntries' => $totalEntries,
            'totalAmount' => number_format($totalAmount, 2),
            'recentEntries' => $recentEntries,
            'municipalities' => $municipalities,
            'userType' => $user->user_type,
            'userMunicipality' => $user->municipality,
        ]);
    }

    /**
     * Get total entries for user based on role.
     */
    protected function getTotalEntriesForUser($user)
    {
        if ($user->isSuperAdmin()) {
            return DataEntry::count();
        } elseif ($user->isPalikaUser() && $user->municipality_id) {
            return DataEntry::where('municipality_id', $user->municipality_id)->count();
        }
        
        return DataEntry::where('user_id', $user->id)->count();
    }

    /**
     * Get total amount for user based on role.
     */
    protected function getTotalAmountForUser($user)
    {
        if ($user->isSuperAdmin()) {
            return DataEntry::sum('amount');
        } elseif ($user->isPalikaUser() && $user->municipality_id) {
            return DataEntry::where('municipality_id', $user->municipality_id)->sum('amount');
        }
        
        return DataEntry::where('user_id', $user->id)->sum('amount');
    }

    /**
     * Get recent entries for user based on role.
     */
    protected function getRecentEntriesForUser($user)
    {
        $query = DataEntry::with(['municipality:id,name,name_nepali', 'user:id,name'])
            ->orderBy('created_at', 'desc')
            ->limit(5);
            
        if ($user->isSuperAdmin()) {
            return $query->get();
        } elseif ($user->isPalikaUser() && $user->municipality_id) {
            return $query->where('municipality_id', $user->municipality_id)->get();
        }
        
        return $query->where('user_id', $user->id)->get();
    }
}