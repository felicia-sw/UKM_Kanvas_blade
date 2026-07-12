<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
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

    public function store(StoreEventRequest $request)
    {

        $data = $request->except(['_token']);
        $data['poster_image'] = $request->file('poster_image');
        $data['is_active'] = $request->has('is_active');

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {

        $data = $request->except(['_token', '_method', 'poster_image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('poster_image')) {
            $data['poster_image'] = $request->file('poster_image');
        }

        // 4. update database record
        $event->update($data);

        // 5. redirect with success
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
    }

    public function destroy(Event $event)
    {
        // 2. delete the database record
        $event->delete();

        // 3. redirecct
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    }

    public function registrations(Event $event)
    {
        $event->load(['registrations.user.profile']);

        return view('admin.event.registrations', compact('event'));
    }
}
