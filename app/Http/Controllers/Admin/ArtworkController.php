<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 💡 CRUCIAL for file deletion/update in the update method

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
            'created_date' => now(),
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

    public function edit(Artwork $artwork)
    {
        // fetch list of categories for the dropdown menu
        $categories = ArtworkCategory::all();

        // return the edit view, passing the artwork data and categories
        return view('admin.artworks.edit', compact('artwork', 'categories'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $data = $request->only('title', 'artist_name', 'category_id', 'description');

        if ($request->hasFile('image_file')) {
            if ($artwork->image_path) {
                if ($artwork->image_path) {
                    $oldPath = str_replace('storage/', '', $artwork->image_path);
                    Storage::disk('public')->delete($oldPath);
                }

                // store the new image
                $imagePath = $request->file('image_file')->store('artworks', 'public');
            $data['image_path'] = 'storage/' . $imagePath;
            }

            // 3. Update Database Record
        $artwork->update($data);

        // 4. Redirect with Success
        return redirect()->route('admin.artworks.index')->with('success', 'Artwork updated successfully!');
        }
    }
}