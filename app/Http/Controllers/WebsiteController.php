<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function server_cache_clear()
    {
        return cache_clear();
    }
}
