<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchandiseItems = Merchandise::latest()->paginate(10);
        return view('admin.merchandise.index', compact('merchandiseItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.merchandise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('public/merchandise');
        $storagePath = Storage::url($path);

        Merchandise::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $storagePath,
        ]);

        return redirect()->route('admin.merchandise.index')->with('success', 'Merchandise item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchandise $merchandise)
    {
        return view('admin.merchandise.edit', compact('merchandise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
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
            'price' => $request->price,
            'description' => $request->description,
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