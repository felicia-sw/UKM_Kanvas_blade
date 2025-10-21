<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Event;
use App\Models\User; // Assuming you have a User model for registrations

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch some basic stats (replace with actual logic/queries)
        $totalArtworks = Artwork::count();
        $upcomingEvents = Event::where('start_date', '>=', now())->count();
        $userRegistrations = User::count(); // Example: Count all users
        $monthlyGrowth = 27; // Dummy data

        // Fetch recent activity (dummy data for now)
        $recentActivity = [
            ['type' => 'Artwork Upload', 'details' => 'New artwork uploaded: "Digital Dreams"', 'user' => 'Artist John', 'time' => '7 hours ago'],
            ['type' => 'Event Registered', 'details' => 'Event registered: Cyberpunk Art Expo 2025', 'user' => 'User Sarah', 'time' => '3 hours ago'],
            ['type' => 'Documentation Added', 'details' => 'Documentation added: Vaporwave Night Gallery', 'user' => 'Admin Team', 'time' => '1 day ago'],
            ['type' => 'User Registration', 'details' => 'New user registration: alex_artworks', 'user' => 'System', 'time' => '1 day ago'],
            ['type' => 'Artwork Updated', 'details' => 'Artwork updated: "Neon Sunset"', 'user' => 'Artist Maria', 'time' => '7 days ago'],
        ];


        return view('admin.dashboard', compact(
            'totalArtworks',
            'upcomingEvents',
            'userRegistrations',
            'monthlyGrowth',
            'recentActivity'
        ));
    }
}