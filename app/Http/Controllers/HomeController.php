<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Division;
use App\Models\Event;
use App\Models\Webanner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $banners = Banner::with('image', 'translations')->get();
        $webanner = Webanner::with('image', 'translations')->first();
        $abouts = About::with('image', 'translations')->get();
        $divisions = Division::with('image', 'translations')->get();
        $events = Event::with('image', 'translations')->get();
        return view('front.home',compact('banners','abouts', 'divisions','events','webanner'));
    }
}
