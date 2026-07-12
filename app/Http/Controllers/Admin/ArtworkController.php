<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtworkRequest;
use App\Http\Requests\UpdateArtworkRequest;
use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // De-duplicate categories by name so duplicate rows in the DB don't clutter the dropdown
        $categories = ArtworkCategory::orderedUniqueByName();

        return view('admin.artworks.index', compact('artworks', 'categories'));
    }

    public function create()
    {

        // De-duplicate categories by name so duplicate rows in the DB don't clutter the dropdown
        $categories = ArtworkCategory::orderedUniqueByName();

        return view('admin.artworks.create', compact('categories'));
    }

    public function store(StoreArtworkRequest $request)
    {

        // Pass the UploadedFile directly - CloudinaryUpload trait will handle it
        Artwork::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'artist_name' => $request->artist_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_path' => $request->file('image_file'), // Pass the file object
            'created_date' => now(),
        ]);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork created successfully!');
    }

    public function edit(Artwork $artwork)
    {

        // De-duplicate categories by name so duplicate rows in the DB don't clutter the dropdown
        $categories = ArtworkCategory::orderedUniqueByName();

        return view('admin.artworks.edit', compact('artwork', 'categories'));
    }

    public function update(UpdateArtworkRequest $request, Artwork $artwork)
    {
        $data = $request->only('title', 'artist_name', 'category_id', 'description');

        // Handle image upload if a new file is provided
        if ($request->hasFile('image_file')) {
            $data['image_path'] = $request->file('image_file');
        } else {
            // If no new image is uploaded, retain the existing image_path and image_public_id
            // This ensures they are not inadvertently set to null during an update
            $data['image_path'] = $artwork->image_path;
            $data['image_public_id'] = $artwork->image_public_id;
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
