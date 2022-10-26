<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();

        // if(!$agent->isMobile()){
        //     return abort(404);
        //     exit();
        // }

        if ($request->api_key == '') {
            return response()->json(['status' => 'false', 'message' => 'Please provide Api Key!']);
            exit();
        } else {
            if ($request->api_key == ENV('API_KEY')) {
                return $next($request);
            } else {
                return response()->json(['status' => 'false', 'message' => 'Invalid Api Key!']);
                exit();
            }
        }
    }
}
