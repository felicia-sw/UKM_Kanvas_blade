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
}