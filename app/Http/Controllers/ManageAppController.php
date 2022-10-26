<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppModel;
use App\Models\AppContent;

class ManageAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($app_unique_id = '')
    {
        $app = null;
        if($app_unique_id){
            $app = AppModel::where('app_unique_id', $app_unique_id)->first();
            if($app){
                session(['selected_app_id' => $app->id]);
            }
        }

        return view('backend.apps.manage_app', compact('app_unique_id', 'app'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_app_settings(Request $request, $app_id = '', $platform = '')
    {
        foreach($request->except('_token') as $key => $value){
            if($key != '' && $value != ''){
                $data = array();
                $data['platform'] = $platform;
                $data['value'] = is_array($value) ? serialize($value) : $value; 
                $data['updated_at'] = now();
                if ($request->hasFile($key)) {
                    $image = $request->file($key);
                    $name = $key . '.' .$image->getClientOriginalExtension();
                    $path = public_path('uploads/images/');
                    $image->move($path, $name);
                    $data['value'] = 'public/uploads/images/' . $name; 
                }
                if(AppContent::where('name', $key)->where('app_id', $app_id)->exists()){                
                    AppContent::where('name', $key)->where('app_id', $app_id)->update($data);         
                }else{
                    $data['app_id'] = $app_id; 
                    $data['name'] = $key; 
                    $data['created_at'] = now();
                    AppContent::insert($data); 
                }
            }
        }
        
        \Cache::forget("settings_" . $app_id);
        
        if(! $request->ajax()){
            return back()->with('success', _lang('Saved sucessfully.'));
        }else{
            return response()->json(['result' => 'success', 'message' => _lang('Saved sucessfully.')]);
        }
    }
}
