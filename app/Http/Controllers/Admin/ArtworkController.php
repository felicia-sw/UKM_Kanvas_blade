<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        // Query Artworks with their category
        $query = Artwork::with('category')->latest();
        
        // Filter by category_id if requested
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category); 
        }

        // Fetch paginated artworks
        $artworks = $query->paginate(12);
        
        // Fetch all categories for the filter buttons
        $categories = ArtworkCategory::all(); 
        
        // Pass original variables to the view
        return view('art_gallery', compact('artworks', 'categories'));
    }
    
    public function show($id)
    {
        // Find Artwork by ID
        $artwork = Artwork::with('category')->findOrFail($id);
        
        return view('artworks.show', compact('artwork'));
    }
}