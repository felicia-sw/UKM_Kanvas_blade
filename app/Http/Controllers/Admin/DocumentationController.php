<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    // The index method receives the Event object due to nested routing
    public function index(Event $event)
    {
        $documentations = $event->documentations()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index', compact('event', 'documentations'));
    }

    /**
     * Display a listing of ALL documentation records across all events (admin.documentation.index.all).
     */
    public function indexAll()
    {
        $documentations = Documentation::with('event')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index-all', compact('documentations'));
    }

    /**
     * NESTED CREATE: Show the form for creating a new documentation entry linked to a specific event.
     * Allowed for any event (removed date check).
     */
    public function create(Event $event)
    {
        // Removed: Check if event has ended. Now allows upload to any event.
        return view('admin.documentation.create', compact('event'));
    }

    /**
     * GLOBAL CREATE: Show the form for creating a new documentation entry where the event is selected via a dropdown.
     */
    public function createAll()
    {
        // FIX: Remove 'where' clause to show ALL events in the dropdown.
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('admin.documentation.create-all', compact('events'));
    }

    /**
     * NESTED STORE: Store a newly created resource in storage (admin.events.documentation.store).
     */
    public function store(Request $request, Event $event)
    {
        // Removed: Check if event has ended.
        
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
        ]);
        
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $event->id,
            'title' => $request->title,
            // FIX: Use 'file_path'
            'file_path' => 'storage/' . $filePath, 
        ]);

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation added successfully!');
    }
    
    /**
     * GLOBAL STORE: Store a newly created resource in storage (admin.documentation.store.all).
     */
    public function storeAll(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id', 
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
        ]);
        
        $event = Event::findOrFail($request->event_id);
        
        // Removed: Check if event has ended.
        
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $request->event_id, 
            'title' => $request->title,
            // FIX: Use 'file_path'
            'file_path' => 'storage/' . $filePath,
        ]);

        return redirect()->route('admin.events.documentation.index', $request->event_id)
                         ->with('success', 'Documentation added successfully!');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Documentation $documentation)
    {
        // FIX: Fetch all events for the dropdown (if the form allows changing the linked event)
        $events = Event::all();
        
        return view('admin.documentation.edit', compact('event', 'documentation', 'events'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event, Documentation $documentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('media_file')) {
            // FIX: Check and delete using 'file_path'
            if ($documentation->file_path) {
                $oldPath = str_replace('storage/', '', $documentation->file_path);
                Storage::disk('public')->delete($oldPath);
            }
            
            $filePath = $request->file('media_file')->store('documentation', 'public');
            // FIX: Use 'file_path'
            $data['file_path'] = 'storage/' . $filePath;
        }

        $documentation->update($data);

        return redirect()->route('admin.events.documentation.index', $event->id)
                        ->with('success', 'Documentation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Documentation $documentation)
    {
        // FIX: Check and delete using 'file_path'
        if ($documentation->file_path) {
            $path = str_replace('storage/', '', $documentation->file_path);
            Storage::disk('public')->delete($path);
        }

        $documentation->delete();

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation deleted successfully.');
    }
}