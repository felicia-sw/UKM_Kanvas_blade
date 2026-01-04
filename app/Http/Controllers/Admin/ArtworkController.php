<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category');


        $query = Artwork::with('category')
            ->when($search, function ($q, $search) {
                return $q->where('title', 'like', "%{$search}%")
                    ->orWhere('artist_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($categoryFilter, function ($q, $categoryFilter) {
                return $q->where('category_id', $categoryFilter);
            })
            ->latest();


        $artworks = $query->paginate(10);


        $categories = ArtworkCategory::all();


        return view('admin.artworks.index', compact('artworks', 'categories'));
    }


    public function create()
    {

        $categories = ArtworkCategory::all();

        return view('admin.artworks.create', compact('categories'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = $request->file('image_file')->store('artworks', 'public');


        Artwork::create([
            'user_id' => auth()->id(), // Add the authenticated user's ID
            'title' => $request->title,
            'artist_name' => $request->artist_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_path' => $request->file('image_path'),
            'created_date' => now(),
        ]);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork created successfully!');
    }


    public function edit(Artwork $artwork)
    {

        $categories = ArtworkCategory::all();


        return view('admin.artworks.edit', compact('artwork', 'categories'));
    }


    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'category_id' => 'required|exists:artwork_categories,id',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'artist_name', 'category_id', 'description');


        if ($request->hasFile('image_file')) {


            if ($artwork->image_path) {
                $oldPath = str_replace('storage/', '', $artwork->image_path);
                Storage::disk('public')->delete($oldPath);
            }

            $imagePath = $request->file('image_file')->store('artworks', 'public');
            $data['image_path'] = 'storage/' . $imagePath;
        }

        $artwork->update($data);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork updated successfully!');
    }

    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork deleted successfully!');
    }
}
