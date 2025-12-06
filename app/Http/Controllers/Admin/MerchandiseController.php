<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchandiseItems = Merchandise::with('category')->latest()->paginate(10);
        return view('admin.merchandise.index', compact('merchandiseItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MerchandiseCategory::all();
        return view('admin.merchandise.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:merchandise_categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('public/merchandise');
        $storagePath = Storage::url($path);

        Merchandise::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image_path' => $storagePath,
        ]);

        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchandise $merchandise)
    {
        $categories = MerchandiseCategory::all();
        return view('admin.merchandise.edit', compact('merchandise', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:merchandise_categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $storagePath = $merchandise->image_path;

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete(str_replace('/storage', 'public', $merchandise->image_path));

            // Store new image
            $path = $request->file('image')->store('public/merchandise');
            $storagePath = Storage::url($path);
        }

        $merchandise->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image_path' => $storagePath,
        ]);

        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merchandise $merchandise)
    {
        Storage::delete(str_replace('/storage', 'public', $merchandise->image_path));
        $merchandise->delete();
        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise item deleted successfully.');
    }
}
