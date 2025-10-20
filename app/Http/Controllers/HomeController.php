<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Artwork;

class HomeController extends Controller
{
    public function index()
    {
        // get upcoming events (maks 3)
        $upcomingEvents = Event::active()
                               ->upcoming()
                               ->limit(3)
                               ->get();
        
        // get featured artworks for home gallery (maks 4 spy bisa square)
        $featuredArtworks = Artwork::with('category')
                                   ->orderBy('created_date', 'desc')
                                   ->limit(4)
                                   ->get();
        
        return view('home', compact('upcomingEvents', 'featuredArtworks'));
    }
}