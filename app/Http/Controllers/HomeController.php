<?php

namespace App\Http\Controllers;

use App\Models\LiveMatch;
use App\Models\Prediction;
use App\Models\WebsiteAds;
use App\Utilities\VideoStream;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	return view('welcome');
    }
}
