<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
        {
            
            $filter = request('filter', 'upcoming');

                    if ($filter === 'upcoming') {
                        $events = Event::active()
                            ->where('start_date', '>=', now())
                            ->orderBy('start_date', 'asc')
                            ->get();
                    } elseif ($filter === 'past') {
                        $events = Event::active()
                            ->where('start_date', '<', now())
                            ->orderBy('start_date', 'desc')
                            ->get();
                    } elseif ($filter === 'all') {
                        $events = Event::active()
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
        if (Auth::check()) {
            $userRegistration = $event->registrations()
                ->where('user_id', Auth::id())
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