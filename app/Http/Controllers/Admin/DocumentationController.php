<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
      public function index(Event $event)
    {
        $documentations = $event->documentations()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index', compact('event', 'documentations'));
    }

    
    public function indexAll()
    {
        $search = request('search');
        $eventFilter = request('event');
        
        $documentations = Documentation::with('event')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($eventFilter, function ($query, $eventFilter) {
                return $query->where('event_id', $eventFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $events = Event::all();
        
        return view('admin.documentation.index-all', compact('documentations', 'events'));
    }

    
    public function create(Event $event)
    {
          return view('admin.documentation.create', compact('event'));
    }

    public function createAll()
    {
         $events = Event::orderBy('start_date', 'desc')->get();
        return view('admin.documentation.create-all', compact('events'));
    }
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
        ]);
        
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'file_path' => $filePath, 
        ]);

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation added successfully!');
    }
    
    public function storeAll(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id', 
            'title' => 'required|string|max:255',
            'media_file' => 'required|file|mimes:jpeg,png,jpg|max:10240', // 10MB max for photo
        ]);
        
        $event = Event::findOrFail($request->event_id);
        
      
        $file = $request->file('media_file');
        $filePath = $file->store('documentation', 'public');
        
        Documentation::create([
            'event_id' => $request->event_id, 
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.events.documentation.index', $request->event_id)
                         ->with('success', 'Documentation added successfully!');
    }
    
      public function edit(Event $event, Documentation $documentation)
    {  $events = Event::all();
        
        return view('admin.documentation.edit', compact('event', 'documentation', 'events'));
    }
       public function update(Request $request, Event $event, Documentation $documentation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_file' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('media_file')) {
            if ($documentation->file_path) {
                Storage::disk('public')->delete($documentation->file_path);
            }
            
            $filePath = $request->file('media_file')->store('documentation', 'public');
            $data['file_path'] = $filePath;
        }

        $documentation->update($data);

        return redirect()->route('admin.events.documentation.index', $event->id)
                        ->with('success', 'Documentation updated successfully!');
    }

      public function destroy(Event $event, Documentation $documentation)
    {
        if ($documentation->file_path) {
            Storage::disk('public')->delete($documentation->file_path);
        }

        $documentation->delete();

        return redirect()->route('admin.events.documentation.index', $event->id)
                         ->with('success', 'Documentation deleted successfully.');
    }
}