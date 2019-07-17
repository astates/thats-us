<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Location;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $return Locations::all();
    }
}
