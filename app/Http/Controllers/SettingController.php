<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;
use Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general(Request $request)
    {
        return view('backend.administration.settings.general');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function app(Request $request)
    {
        return view('backend.administration.settings.app');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_settings(Request $request)
    {
        foreach($request->except('_token') as $key => $value){
            if($key != '' && $value != ''){
                $data = array();
                $data['value'] = is_array($value) ? json_encode($value) : $value; 
                $data['updated_at'] = now();
                if ($request->hasFile($key)) {
                    $image = $request->file($key);
                    $name = $key . '.' .$image->getClientOriginalExtension();
                    $path = public_path('uploads/images/');
                    $image->move($path, $name);
                    $data['value'] = $name; 
                    $data['updated_at'] = now();
                }
                if(Setting::where('name', $key)->exists()){                
                    Setting::where('name','=', $key)->update($data);         
                }else{
                    $data['name'] = $key; 
                    $data['created_at'] = now();
                    Setting::insert($data); 
                }
            }
        }
        if(! $request->ajax()){
            return back()->with('success', _lang('Saved sucessfully.'));
        }else{
            return response()->json(['result' => 'success', 'message' => _lang('Saved sucessfully.')]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cache_clear(Request $request)
    {
        try {
            foreach (json_decode(get_option('server')) ?? [] AS $server) {

                $client = new \GuzzleHttp\Client(['http_errors' => true]);
                $request2 = $client->get("{$server}server_cache_clear");
                $response = $request2->getBody();
            }
        }catch(\GuzzleHttp\Exception\RequestException $e){
            if(! $request->ajax()){
                return back()->with('error', _lang('Unknown error.'));
            }else{
                return response()->json(['result' => 'error', 'message' => _lang('Unknown error.')]);
            }
        }catch (Exception $e) {
            if(! $request->ajax()){
                return back()->with('error', _lang('Unknown error.'));
            }else{
                return response()->json(['result' => 'error', 'message' => _lang('Unknown error.')]);
            }
        }
        
       
        if(! $request->ajax()){
            return back()->with('success', _lang('Cache clear sucessfully.'));
        }else{
            return response()->json(['result' => 'success', 'message' => _lang('Cache clear sucessfully.')]);
        }
    }
}
