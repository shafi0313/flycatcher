<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home()
    {
        return view('front.home');
    }
    public function about()
    {
        return view('front.about');
    }
    public function services()
    {
        return view('front.services');
    }
    public function pricing()
    {
        return view('front.pricing');
    }
    public function help()
    {
        return view('front.help');
    }
}
