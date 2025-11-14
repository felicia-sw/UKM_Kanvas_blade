<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
        {
            
            $filter = request('filter', 'upcoming');

            if ($filter === 'past') {
                $events = Event::active()
                    ->where('start_date', '<', now())
                    ->orderBy('start_date', 'desc')
                    ->get();
            } else {
                $events = Event::active()
                    ->where('start_date', '>=', now())
                    ->orderBy('start_date', 'asc')
                    ->get();
            }

            return view('events', compact('events', 'filter'));
        }
    
    public function show($id)
    {
        $event = Event::with('registrations')->findOrFail($id);
        
        // Check if current user already registered
        $userRegistration = null;
        if (auth()->check()) {
            $userRegistration = $event->registrations()
                ->where('user_id', auth()->id())
                ->first();
        }
        
        return view('events.show', compact('event', 'userRegistration'));
    }
    
    public function showDocumentation($id)
    {
        $event = Event::with('documentations')->findOrFail($id);
        
        return view('event_documentation', compact('event'));
    }
}