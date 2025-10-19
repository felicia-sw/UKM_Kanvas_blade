<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display all events
    public function index()
    {
        $events = Event::active()
                       ->orderBy('start_date', 'desc')
                       ->paginate(12);
        
        return view('events', compact('events'));
    }
    
    // Display single event with documentation
    public function show($id)
    {
        $event = Event::with('documentation')->findOrFail($id);
        
        return view('events.show', compact('event'));
    }
}