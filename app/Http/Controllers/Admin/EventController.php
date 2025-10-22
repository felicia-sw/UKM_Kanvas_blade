<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('start_date', '>=', now())->orderBy('start_date', 'asc')->paginate(10, ['*'], 'upcoming_page');
        $pastEvents = Event::where('start_date', '<', now())->orderBy('start_date', 'desc')->paginate(10, ['*'], 'past_page');

        return view('admin.event.index', compact('upcomingEvents', 'pastEvents'));
    }

     // Add methods for create, store, edit, update, destroy later
}