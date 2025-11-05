<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with('category')->orderBy('created_date', 'desc')->paginate(10); // Paginate for admin view
        $categories = ArtworkCategory::orderBy('name')->get();
        return view('admin.artworks.index', compact('artworks', 'categories'));
    }

    // Add methods for create, store, edit, update, destroy later


    public function create()
    {
        $categories = ArtworkCategory::all(); // fetch all categories to populate a dropdown list in the form
        return view('admin.artworks.create', compact('categories')); // return the create view, passing the categories data 
    }

    public function store(Request $request)
    {
        //  1. validation
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        // 2, Handle file upload (REQUIRED FOR IMAGE)
        $imagePath = $request->file('image_file')->store('artworks','public');
        Artwork::create([
            'title' => $request->title,
            'artist_name' => $request->artist_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_path' => 'storage/' . $imagePath,
            // 'created_date' => now(),
        ]);

        // 4. Redirect with success message
        return redirect()->route('admin.artworks.index')->with('success', 'Artwork created successfully.');
    }

    // delete --> destroy method
    public function destroy(Artwork $artwork){
        // delete artwork record
        $artwork->delete(); // using eloquent ORM to execute SQL DELETE command on the database

        // redirects the admin back to the list of artworks (admin.artworks.index) and flashes a temporary success message to the session
        return redirect()->route('admin.artworks.index')->with('sucess', 'Artwork deleted successfully.');
    }
}