<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    // Display art gallery
    public function index(Request $request)
    {
        $query = Artwork::with('category');
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        $artworks = $query->orderBy('created_date', 'desc')->paginate(12);
        $categories = ArtworkCategory::all();
        
        return view('art_gallery', compact('artworks', 'categories'));
    }
    
    // Display single artwork
    public function show($id)
    {
        $artwork = Artwork::with('category')->findOrFail($id);
        
        return view('artworks.show', compact('artwork'));
    }
}