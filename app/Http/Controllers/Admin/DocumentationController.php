<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // For file operations

class DocumentationController extends Controller
{
    // The index method receives the Event object due to nested routing
    public function index(Event $event)
    {
        $documentations = $event->documentations()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index', compact('event', 'documentations'));
    }

    /**
     * KEPT: Display a listing of ALL documentation records across all events (admin.documentation.index.all).
     */
    public function indexAll()
    {
        $documentations = Documentation::with('event')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index-all', compact('documentations'));
    }

    public function create(Event $event)
    {
        // Check if event has ended
        if ($event->end_date && now()->lt($event->end_date)) {
            return redirect()->route('admin.events.index')
                ->with('error', 'Cannot upload documentation for an event that has not ended yet. Event ends on: ' . $event->end_date->format('d M Y'));
        }
        
        return view('admin.documentation.create', compact('event'));
    }

    /**
     * KEPT: Show the form for creating a new documentation entry (Global Route: admin.documentation.create.all)
     */
    public function createAll()
    {
        // Only show events that have ended
        $events = Event::where('end_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->get();
        return view('admin.documentation.create-all', compact('events'));
    }

    /**
     * NESTED STORE: Store a newly created resource in storage (admin.events.documentation.store).
     */
    public function store(Request $request, Event $event)
    {
        // Check if event has ended
        if ($event->end_date && now()->lt($event->end_date)) {
            return redirect()->route('admin.events.index')
                ->with('error', 'Cannot upload documentation for an event that has not ended yet.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
        ]);
        
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'image_path' => $filePath,
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
        
        // Check if event has ended
        if ($event->end_date && now()->lt($event->end_date)) {
            return redirect()->route('admin.documentation.index')
                ->with('error', 'Cannot upload documentation for an event that has not ended yet.');
        }
        
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $request->event_id, 
            'title' => $request->title,
            'image_path' => $filePath,
        ]);

        return redirect()->route('admin.events.documentation.index', $request->event_id)
                         ->with('success', 'Documentation added successfully!');
    }
    
    public function edit(Event $event, Documentation $documentation)
    {
        return view('admin.documentation.edit', compact('event', 'documentation'));
    }
    
    public function update(Request $request, Event $event, Documentation $documentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('media_file')) {
            if ($documentation->image_path) {
                Storage::disk('public')->delete($documentation->image_path);
            }
            
            $filePath = $request->file('media_file')->store('documentation', 'public');
            $data['image_path'] = $filePath;
        }

        $documentation->update($data);

        return redirect()->route('admin.events.documentation.index', $event->id)
                        ->with('success', 'Documentation updated successfully!');
    }

    public function destroy(Event $event, Documentation $documentation)
    {
        if ($documentation->image_path) {
            Storage::disk('public')->delete($documentation->image_path);
        }

        $documentation->delete();

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation deleted successfully.');
    }
}