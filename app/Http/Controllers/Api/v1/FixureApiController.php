<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixure;
class FixureApiController extends Controller
{
    public function all_fixures(Request $request)
	{
	   $status = true;
	   $fixures = Fixure::orderBy('date_time', 'ASC')->get();
	   return response()->json(['status'=>$status, 'fixures'=>$fixures]);
	}
}
