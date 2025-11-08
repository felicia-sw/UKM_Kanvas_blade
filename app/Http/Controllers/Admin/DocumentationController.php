<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // For file operations

class DocumentationController extends Controller
{
    // The existing index method for nested routing (admin.events.documentation.index)
    public function index(Event $event)
    {
        // Fetch documentation specific to the current event, ordered by date
        $documentations = $event->documentations()->orderBy('created_at', 'desc')->paginate(10);
        
        // Pass both the parent event and the documentations to the view
        return view('admin.documentation.index', compact('event', 'documentations'));
    }

    /**
     * Display a listing of ALL documentation records across all events.
     * This is the method for the top-level sidebar link.
     */
    public function indexAll()
    {
        // Fetch all documentation, ordered by date. We eager-load the parent 'event'
        $documentations = Documentation::with('event')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.documentation.index-all', compact('documentations'));
    }

    /**
     * Show the form for creating a new documentation entry (Nested Route)
     */
    public function create(Event $event)
    {
        // Return the upload form (event ID is implicit)
        return view('admin.documentation.create', compact('event'));
    }

    /**
     * Show the form for creating a new documentation entry (Global Route)
     */
    public function createAll()
    {
        // Fetch all events to populate the dropdown selection
        $events = Event::orderBy('start_date', 'desc')->get();
        // Uses the dedicated global creation view
        return view('admin.documentation.create-all', compact('events'));
    }

    /**
     * Store a newly created resource in storage (NESTED ROUTE: admin.events.documentation.store).
     * This handles uploads from the Event-specific index page.
     */
    public function store(Request $request, Event $event)
    {
        // 1. Validation (Photos only: max 10MB)
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
            'caption' => 'nullable|string',
        ]);
        
        // 2. Handle file upload (saves to storage/app/public/documentation)
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        // 3. Create Documentation record
        Documentation::create([
            'event_id' => $event->id, // Uses the Event provided by Route Model Binding
            'title' => $request->title,
            'file_path' => 'storage/' . $filePath, // Store the public path
            'file_type' => 'photo', // HARDCODED for photos only
            'caption' => $request->caption,
            'is_featured' => $request->has('is_featured'),
        ]);

        // 4. Redirect
        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation added successfully!');
    }
    
    /**
     * 💡 FIX: Dedicated store method for the GLOBAL ROUTE (admin.documentation.store.all).
     * This method handles the event selection from the global form.
     */
    public function storeAll(Request $request)
    {
        // 1. Validation (Must validate event selection + Photo rules)
        $request->validate([
            'event_id' => 'required|exists:events,id', // Must validate event selection
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
            'caption' => 'nullable|string',
        ]);
        
        // 2. Handle file upload
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        // 3. Create Documentation record
        Documentation::create([
            'event_id' => $request->event_id, // Uses the selected event ID from the form
            'title' => $request->title,
            'file_path' => 'storage/' . $filePath, 
            'file_type' => 'photo', // HARDCODED
            'caption' => $request->caption,
            'is_featured' => $request->has('is_featured'),
        ]);

        // 4. Redirect: Go to the index page of the selected event's documentation
        return redirect()->route('admin.events.documentation.index', $request->event_id)
                         ->with('success', 'Documentation added successfully!');
    }

    // Since edit/update/destroy only affect the Documentation model, we only inject the Documentation model
    
    public function edit(Event $event, Documentation $documentation)
    {
        return view('admin.documentation.edit', compact('event', 'documentation'));
    }
    
    public function update(Request $request, Event $event, Documentation $documentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg|max:10240', // Photos only, max 10MB
            'caption' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'caption']);
        $data['is_featured'] = $request->has('is_featured');
        $data['file_type'] = 'photo'; // HARDCODED for photos only

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