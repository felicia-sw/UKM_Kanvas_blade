<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
        {
            // Get filter from query (?filter=past or ?filter=upcoming)
            $filter = request('filter', 'upcoming');

            if ($filter === 'past') {
                $events = Event::active()
                    ->where('start_date', '<', now())
                    ->orderBy('start_date', 'desc')
                    ->get();
            } else {
                // Default: upcoming/now
                $events = Event::active()
                    ->where('start_date', '>=', now())
                    ->orderBy('start_date', 'asc')
                    ->get();
            }

            return view('events', compact('events', 'filter'));
        }
    
    public function show($id)
    {
        $event = Event::with('documentation')->findOrFail($id);
        
        return view('events.show', compact('event'));
    }
    
    public function showDocumentation($id)
    {
        $event = Event::with('documentations')->findOrFail($id);
        
        return view('event_documentation', compact('event'));
    }
}