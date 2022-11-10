<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landingpage.index');
    }
}
