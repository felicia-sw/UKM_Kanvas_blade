<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'all');
        $query = Merchandise::query();

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $merchandises = $query->get();
        $categories = Merchandise::select('category')->distinct()->pluck('category');
        return view('merchandise', compact('merchandises', 'categories', 'category'));
    }
}