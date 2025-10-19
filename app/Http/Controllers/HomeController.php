<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Artwork;

class HomeController extends Controller
{
    public function index()
    {
        // Get upcoming events (limit 3)
        $upcomingEvents = Event::active()
                               ->upcoming()
                               ->limit(3)
                               ->get();
        
        // Get featured artworks (you can add is_featured field later)
        $featuredArtworks = Artwork::with('category')
                                   ->orderBy('created_date', 'desc')
                                   ->limit(6)
                                   ->get();
        
        return view('home', compact('upcomingEvents', 'featuredArtworks'));
    }
}