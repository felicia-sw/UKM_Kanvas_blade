<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Event;
use App\Models\Documentation;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch statistics
        $totalArtworks = Artwork::count();
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('start_date', '>=', now())->count();
        $totalDocumentation = Documentation::count();
        $userRegistrations = User::count();
        
        // Calculate monthly growth (artworks added this month vs last month)
        $currentMonthArtworks = Artwork::whereMonth('created_date', now()->month)
            ->whereYear('created_date', now()->year)
            ->count();
        $lastMonthArtworks = Artwork::whereMonth('created_date', now()->subMonth()->month)
            ->whereYear('created_date', now()->subMonth()->year)
            ->count();
        
        if ($lastMonthArtworks > 0) {
            $monthlyGrowth = round((($currentMonthArtworks - $lastMonthArtworks) / $lastMonthArtworks) * 100);
        } else {
            $monthlyGrowth = $currentMonthArtworks > 0 ? 100 : 0;
        }

        // Search for events
        $eventSearch = request('event_search');
        $recentEvents = Event::query()
            ->when($eventSearch, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->latest('created_at')
            ->take(5)
            ->get();

        // Search for artworks
        $artworkSearch = request('artwork_search');
        $recentArtworks = Artwork::query()
            ->with('category')
            ->when($artworkSearch, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('artist_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest('created_date')
            ->take(5)
            ->get();

        // Build recent activity from actual data
        $recentActivity = [];
        
        // Add recent artworks to activity
        foreach ($recentArtworks as $artwork) {
            $recentActivity[] = [
                'type' => 'Artwork',
                'icon' => 'bi-palette',
                'color' => 'primary',
                'details' => 'Artwork added: "' . $artwork->title . '"',
                'user' => $artwork->artist_name,
                'time' => $artwork->created_date ? $artwork->created_date->diffForHumans() : 'Recently'
            ];
        }
        
        // Add recent events to activity
        foreach ($recentEvents as $event) {
            $recentActivity[] = [
                'type' => 'Event',
                'icon' => 'bi-calendar-event',
                'color' => 'warning',
                'details' => 'Event created: "' . $event->title . '"',
                'user' => 'Admin',
                'time' => $event->created_at ? $event->created_at->diffForHumans() : 'Recently'
            ];
        }
        
        // Sort activity by most recent (we'll approximate using array order)
        // In a real app, you'd sort by actual timestamps
        $recentActivity = array_slice($recentActivity, 0, 8);

        return view('admin.dashboard', compact(
            'totalArtworks',
            'totalEvents',
            'upcomingEvents',
            'totalDocumentation',
            'userRegistrations',
            'monthlyGrowth',
            'recentActivity',
            'recentArtworks',
            'recentEvents'
        ));
    }
}