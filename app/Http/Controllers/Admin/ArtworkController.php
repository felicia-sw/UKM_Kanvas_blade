<?php

namespace App\Http\Controllers;

use App\Models\Documentation; // Use Documentation model
use App\Models\Event; // Use Event model for filtering
use App\Models\ArtworkCategory; // No longer needed
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query featured documentation photos
        $query = Documentation::with('event')
                            ->where('is_featured', true) // Only show photos marked as featured
                            ->where('file_type', 'photo'); // Only show photos (enforced by Admin logic)

        // 2. Filter by Event if requested (using event_id passed via query string)
        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }

        // The variable $artworks now holds Documentation records
        $artworks = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Fetch all Events to act as 'categories' for the filter section
        $events = Event::all(); 
        
        // Passing 'artworks' (Documentation) and 'events' (for filtering) to the view
        return view('art_gallery', compact('artworks', 'events'));
    }
    
    // Updated show method to find Documentation by ID, maintaining the original $artwork variable name for the view
    public function show($id)
    {
        // Find documentation record instead of artwork
        $documentation = Documentation::with('event')->findOrFail($id);
        
        // Rename local variable to match the expected view variable
        $artwork = $documentation;

        return view('artworks.show', compact('artwork'));
    }
}