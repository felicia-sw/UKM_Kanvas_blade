<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 💡 NEW: Import Storage for file operations

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');
        
        $upcomingEvents = Event::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->paginate(10, ['*'], 'upcoming_page');
            
        $pastEvents = Event::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->where('start_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->paginate(10, ['*'], 'past_page');

        return view('admin.event.index', compact('upcomingEvents', 'pastEvents'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster_image' => 'required|image|mimes:jpeg,png,jpg|max:20480', // Max 20MB
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'nullable|date_format:Y-m-d\TH:i|after:start_date',
            'registration_deadline' => 'nullable|date|before:start_date',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'has_multiple_days' => 'nullable|boolean',
            'day_1_price' => 'nullable|numeric|min:0',
            'day_2_price' => 'nullable|numeric|min:0',
            'both_days_price' => 'nullable|numeric|min:0',
        ]);

        
        $imagePath = $request->file('poster_image')->store('events/posters', 'public');

    
        $data = $request->except(['_token', 'poster_image']);
        $data['poster_image'] = $imagePath;
        $data['is_active'] = $request->has('is_active');

        Event::create($data);

        
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully');
    }

    public function edit(Event $event) 
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    { 
       
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'nullable|date_format:Y-m-d\TH:i|after:start_date',
            'registration_deadline' => 'nullable|date|before:start_date',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'has_multiple_days' => 'nullable|boolean',
            'day_1_price' => 'nullable|numeric|min:0',
            'day_2_price' => 'nullable|numeric|min:0',
            'both_days_price' => 'nullable|numeric|min:0',
        ]);

        
        $data = $request->except(['_token', '_method', 'poster_image']);
        $data['is_active'] = $request->has('is_active');

      
        if($request->hasFile('poster_image')) {
            if ($event->poster_image) {
                Storage::disk('public')->delete($event->poster_image);
            }

           
            $imagePath = $request->file('poster_image')->store('events/posters', 'public');
            $data['poster_image'] = $imagePath;
        }

        // 4. update database record
        $event->update($data);

        // 5. redirect with success
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
        
    }

    public function destroy(Event $event) 
    {
        // 1. deleteassociated image file 
        if ($event->poster_image) { // checks if a poster image exists to safely attampt deletion 
            Storage::disk('public')->delete($event->poster_image); // deletes the record from database; the deletion must happen before the database record is removed
        }

        // 2. delete the database record
        $event->delete(); 

        // 3. redirecct
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    }

    public function registrations(Event $event)
    {
        $event->load(['registrations.user']);
        return view('admin.event.registrations', compact('event'));
    }
}
