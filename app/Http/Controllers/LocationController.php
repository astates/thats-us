<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        return view('locations')->with('location', $location);
    }
}
