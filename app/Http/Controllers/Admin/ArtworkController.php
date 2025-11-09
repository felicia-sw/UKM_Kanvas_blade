<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Display a listing of artworks in admin panel
     */
    public function index(Request $request)
    {
        // Query Artworks with their category
        $query = Artwork::with('category')->latest();
        
        // Filter by category_id if requested
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category); 
        }

        // Fetch paginated artworks (10 per page for admin)
        $artworks = $query->paginate(10);
        
        // Return the ADMIN view
        return view('admin.artworks.index', compact('artworks'));
    }
    
    /**
     * Show the form for creating a new artwork
     */
    public function create()
    {
        // Fetch all categories for the dropdown menu
        $categories = ArtworkCategory::all();
        
        return view('admin.artworks.create', compact('categories'));
    }
    
    /**
     * Store a newly created artwork in storage
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        $imagePath = $request->file('image_file')->store('artworks', 'public');
        
        // Create the artwork record
        Artwork::create([
            'title' => $request->title,
            'artist_name' => $request->artist_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_path' => $imagePath,
            'created_date' => now(),
        ]);

        // Redirect with success message
        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork created successfully!');
    }

    /**
     * Show the form for editing the specified artwork
     */
    public function edit(Artwork $artwork)
    {
        // Fetch list of categories for the dropdown menu
        $categories = ArtworkCategory::all();

        // Return the edit view, passing the artwork data and categories
        return view('admin.artworks.edit', compact('artwork', 'categories'));
    }

    /**
     * Update the specified artwork in storage
     */
    public function update(Request $request, Artwork $artwork)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'artist_name', 'category_id', 'description');

        // Handle image replacement if a new image is uploaded
        if ($request->hasFile('image_file')) { // (1) Checks if a new file exists
            
            // Delete old image if it exists
            if ($artwork->image_path) { // (2) Checks the database for the old path
                $oldPath = str_replace('storage/', '', $artwork->image_path); 
                Storage::disk('public')->delete($oldPath); // (3) DELETES the physical file
            }

            // Store the new image
            $imagePath = $request->file('image_file')->store('artworks', 'public');
            $data['image_path'] = 'storage/' . $imagePath; // (4) Updates the database with the new path
        }

        // Update the artwork record
        $artwork->update($data);

        // Redirect with success message
        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork updated successfully!');
    }

    /**
     * Remove the specified artwork from storage
     */
    public function destroy(Artwork $artwork)
    {
        // Delete the image file from storage
        if ($artwork->image_path) {
            Storage::disk('public')->delete($artwork->image_path);
        }

        // Delete the artwork record
        $artwork->delete();

        // Redirect with success message
        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork deleted successfully!');
    }
}