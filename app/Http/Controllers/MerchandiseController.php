<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchandiseItems = Merchandise::latest()->get();
        return view('merchandise', compact('merchandiseItems'));
    }
}