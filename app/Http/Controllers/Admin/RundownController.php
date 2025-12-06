<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Rundown;
use Illuminate\Http\Request;

class RundownController extends Controller
{
    /**
     * Display rundowns for a specific event
     */
    public function index(Event $event)
    {
        $rundowns = $event->rundowns()->orderBy('start_time', 'asc')->get();
        return view('admin.rundown.index', compact('event', 'rundowns'));
    }

    /**
     * Show the form for creating a new rundown item
     */
    public function create(Event $event)
    {
        return view('admin.rundown.create', compact('event'));
    }

    /**
     * Store a newly created rundown item
     */
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'activity' => 'required|string|max:255',
            'description' => 'nullable|string',
            'person_in_charge' => 'nullable|string|max:255',
        ]);

        $event->rundowns()->create($validated);

        return redirect()->route('admin.events.rundown.index', $event->id)
            ->with('success', 'Rundown item created successfully.');
    }

    /**
     * Show the form for editing the specified rundown
     */
    public function edit(Event $event, Rundown $rundown)
    {
        return view('admin.rundown.edit', compact('event', 'rundown'));
    }

    /**
     * Update the specified rundown
     */
    public function update(Request $request, Event $event, Rundown $rundown)
    {
        $validated = $request->validate([
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'activity' => 'required|string|max:255',
            'description' => 'nullable|string',
            'person_in_charge' => 'nullable|string|max:255',
        ]);

        $rundown->update($validated);

        return redirect()->route('admin.events.rundown.index', $event->id)
            ->with('success', 'Rundown item updated successfully.');
    }

    /**
     * Remove the specified rundown
     */
    public function destroy(Event $event, Rundown $rundown)
    {
        $rundown->delete();

        return redirect()->route('admin.events.rundown.index', $event->id)
            ->with('success', 'Rundown item deleted successfully.');
    }
}
