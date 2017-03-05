<?php

namespace App\Http\Controllers;

use App\Area;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::get()->toTree();        
        return view('home', compact('areas'));
    }
}
