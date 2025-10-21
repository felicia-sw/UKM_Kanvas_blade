<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        $query = Documentation::with('event')->orderBy('created_at', 'desc');

        // Optional: Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        $documentations = $query->paginate(12);
        $events = Event::orderBy('title')->get(); // For filtering dropdown

        return view('admin.documentation.index', compact('documentations', 'events'));
    }

     // Add methods for create, store, edit, update, destroy later
}