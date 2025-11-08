<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event; // Need to use the Event Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // For file operations

class DocumentationController extends Controller
{
    // The index method receives the Event object due to nested routing
    public function index(Event $event)
    {
        // Fetch documentation specific to the current event, ordered by date
        $documentations = $event->documentations()->orderBy('created_at', 'desc')->paginate(10);
        
        // Pass both the parent event and the documentations to the view
        return view('admin.documentation.index', compact('event', 'documentations'));
    }

    public function create(Event $event)
    {
        // Return the upload form
        return view('admin.documentation.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:51200', // Allow 50MB for media
            'type' => 'required|in:photo,video',
            'caption' => 'nullable|string',
        ]);

        // 2. Handle file upload (saves to storage/app/public/documentation)
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        // 3. Create Documentation record
        Documentation::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'file_path' => 'storage/' . $filePath, // Store the public path
            'file_type' => $request->type,
            'caption' => $request->caption,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation added successfully!');
    }

    // Since edit/update/destroy only affect the Documentation model, we only inject the Documentation model
    // Laravel automatically infers the Documentation model from the route parameter
    
    public function edit(Event $event, Documentation $documentation)
    {
        return view('admin.documentation.edit', compact('event', 'documentation'));
    }
    
    public function update(Request $request, Event $event, Documentation $documentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mov,avi|max:51200', // 50MB
            'type' => 'required|in:photo,video',
            'caption' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'type', 'caption']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle file update
        if ($request->hasFile('media_file')) {
            // Delete old file
            if ($documentation->file_path) {
                $oldPath = str_replace('storage/', '', $documentation->file_path);
                Storage::disk('public')->delete($oldPath);
            }
            
            // Store new file
            $filePath = $request->file('media_file')->store('documentation', 'public');
            $data['file_path'] = 'storage/' . $filePath;
        }

        $documentation->update($data);

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation updated successfully!');
    }

    public function destroy(Event $event, Documentation $documentation)
    {
        // Delete the physical file from storage
        if ($documentation->file_path) {
            $path = str_replace('storage/', '', $documentation->file_path);
            Storage::disk('public')->delete($path);
        }

        // Delete the database record
        $documentation->delete();

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation deleted successfully.');
    }

    // show method is not needed due to the except(['show']) on the resource route
}