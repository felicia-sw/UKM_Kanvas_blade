<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::active()
                       ->orderBy('start_date', 'asc')
                       ->get();
        
        return view('events', compact('events'));
    }
    
    public function show($id)
    {
        $event = Event::with('documentation')->findOrFail($id);
        
        return view('events.show', compact('event'));
    }
}