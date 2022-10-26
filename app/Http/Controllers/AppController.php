<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppModel;
use App\Models\AppContent;
use App\Models\LiveMatch;
use DataTables;
use Validator;

class AppController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $apps = AppModel::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return DataTables::of($apps)
                    ->addColumn('app_logo', function ($app) {
                        if($app->app_logo_type == 'url'){
                            return '<div style=" white-space: nowrap; ">
                            <img class="img-sm img-thumbnail" src="' . $app->app_logo_url . '">
                            </div>';
                        }
                        else{
                            return '<div style=" white-space: nowrap; ">
                            <img class="img-sm img-thumbnail" src="' . asset($app->app_logo) . '">
                            </div>';
                        }
                    })
                    ->addColumn('_app', function($app){

                        return 'ID: <a href="javascript:void(0);">' . $app->app_unique_id . '</a><br>Name: ' . $app->app_name;
                    })
                    ->addColumn('status', function ($app) {
                        return $app->status == 1 ? status(_lang('Active'), 'success') : status(_lang('In-Active'), 'danger');
                    })
                    ->addColumn('action', function($app){

                        $action = '<div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            ' . _lang('Action') . '
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        $action .= '<a href="' . route('apps.edit', $app->id) . '" class="dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        ' . _lang('Edit') . '
                                    </a>';
						$action .= '<a href="' . route('apps.show', $app->id) . '" class="dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        ' . _lang('Cache Clean') . '
                                    </a>';
                        $action .= '<form action="' . route('apps.destroy', $app->id) . '" method="post" class="ajax-delete">'
                                . csrf_field() 
                                . method_field('DELETE') 
                                . '<button type="button" class="btn-remove dropdown-item">
                                        <i class="fas fa-trash-alt"></i>
                                        ' . _lang('Delete') . '
                                    </button>
                                </form>';
                        $action .= '</div>
                                </div>';
                        return $action;
                    })
                    ->rawColumns(['action', 'app_logo', '_app', 'status'])
                    ->make(true);
        }

        return view('backend.apps.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('backend.apps.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'app_unique_id' => 'required|string|max:191',
            'app_name' => 'required|string|max:191',
            'app_logo_type' => 'required|string|max:20',
            'app_logo_url' => 'nullable|required_if:app_logo_type,url|url',
            'app_logo' => 'nullable|required_if:app_logo_type,image|image',
            'notification_type' => 'required|string|max:20',
            'onesignal_app_id' => 'nullable|required_if:notification_type,==,onesignal|string|max:191',
            'onesignal_api_key' => 'nullable|required_if:notification_type,==,onesignal|string|max:191',
            'firebase_server_key' => 'nullable|required_if:notification_type,==,fcm|string|max:191',
            'firebase_topics' => 'nullable|required_if:notification_type,==,fcm|string|max:191',
            'support_mail' => 'nullable|string|max:191',
            'from_mail' => 'nullable|string|max:191',
            'from_name' => 'nullable|string|max:191',
            'smtp_host' => 'nullable|string|max:191',
            'smtp_port' => 'nullable|string|max:191',
            'smtp_username' => 'nullable|string|max:191',
            'smtp_password' => 'nullable|string|max:191',
            'smtp_encryption' => 'nullable|string|max:191',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }

        $app = new AppModel();
        
        $app->app_unique_id  = $request->app_unique_id ;
        $app->app_name = $request->app_name;
        $app->app_logo_type = $request->app_logo_type;
        $app->app_logo_url = $request->app_logo_url;
        $app->notification_type = $request->notification_type;
        $app->onesignal_app_id = $request->onesignal_app_id;
        $app->onesignal_api_key = $request->onesignal_api_key;
        $app->firebase_server_key = $request->firebase_server_key;
        $app->firebase_topics = $request->firebase_topics;
        $app->support_mail = $request->support_mail;
        $app->from_mail = $request->from_mail;
        $app->from_name = $request->from_name;
        $app->smtp_host = $request->smtp_host;
        $app->smtp_port = $request->smtp_port;
        $app->smtp_username = $request->smtp_username;
        $app->smtp_password = $request->smtp_password;
        $app->smtp_encryption = $request->smtp_encryption;
        $app->status = $request->status;
        
        if($request->hasFile('app_logo')){
            $file = $request->file('app_logo');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/images/'), $file_name);
            $app->app_logo = 'public/uploads/images/' . $file_name;
        }
        
        $app->save();
		
		\Cache::forget("app_" . $app->app_unique_id);

        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been added sucessfully'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('apps'), 'message' => _lang('Information has been added sucessfully')]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, $id)
    {
        $app = AppModel::find($id);
		
		\Cache::forget("apps_" . $app->app_unique_id);
		\Cache::forget("highlights_" . $app->app_unique_id);
		\Cache::forget("fixures");

        $apps = LiveMatch::select('apps.*')
                        ->join('live_match_apps', 'live_match_apps.match_id', 'apps.id')
                        ->join('apps', 'apps.id', 'live_match_apps.app_id')
                        ->where('apps.app_unique_id', $app->app_unique_id)
                        ->orderBy('id', 'DESC')
                        ->get();

        foreach ($apps as $key => $value) {
            \Cache::forget('streamingSources_' . $value->id);
        }

        if(! $request->ajax()){
            return redirect('apps')->with('success', _lang('Information has been added sucessfully'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('apps'), 'message' => _lang('Information has been added sucessfully')]);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $app = AppModel::find($id);
        return view('backend.apps.edit', compact('app'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'app_name' => 'required|string|max:191',
            'app_logo_type' => 'required|string|max:20',
            'app_logo_url' => 'nullable|required_if:app_logo_type,url|url',
            'app_logo' => 'nullable|image',
            'notification_type' => 'required|string|max:20',
            'onesignal_app_id' => 'nullable|required_if:notification_type,==,onesignal|string|max:191',
            'onesignal_api_key' => 'nullable|required_if:notification_type,==,onesignal|string|max:191',
            'firebase_server_key' => 'nullable|required_if:notification_type,==,fcm|string|max:191',
            'firebase_topics' => 'nullable|required_if:notification_type,==,fcm|string|max:191',
            'support_mail' => 'nullable|string|max:191',
            'from_mail' => 'nullable|string|max:191',
            'from_name' => 'nullable|string|max:191',
            'smtp_host' => 'nullable|string|max:191',
            'smtp_port' => 'nullable|string|max:191',
            'smtp_username' => 'nullable|string|max:191',
            'smtp_password' => 'nullable|string|max:191',
            'smtp_encryption' => 'nullable|string|max:191',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }

        $app = AppModel::find($id);
        
        $app->app_name = $request->app_name;
        $app->app_logo_type = $request->app_logo_type;
        $app->app_logo_url = $request->app_logo_url;
        $app->notification_type = $request->notification_type;
        $app->onesignal_app_id = $request->onesignal_app_id;
        $app->onesignal_api_key = $request->onesignal_api_key;
        $app->firebase_server_key = $request->firebase_server_key;
        $app->firebase_topics = $request->firebase_topics;
        $app->support_mail = $request->support_mail;
        $app->from_mail = $request->from_mail;
        $app->from_name = $request->from_name;
        $app->smtp_host = $request->smtp_host;
        $app->smtp_port = $request->smtp_port;
        $app->smtp_username = $request->smtp_username;
        $app->smtp_password = $request->smtp_password;
        $app->smtp_encryption = $request->smtp_encryption;
        $app->status = $request->status;

        if($request->hasFile('app_logo')){
            $file = $request->file('app_logo');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/images/'), $file_name);
            $app->app_logo = 'public/uploads/images/' . $file_name;
        }

        $app->save();
		
		\Cache::forget("app_" . $app->app_unique_id);

        if(! $request->ajax()){
            return redirect('apps')->with('success', _lang('Information has been updated sucessfully'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('apps'), 'message' => _lang('Information has been updated sucessfully')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
		
        $app = AppModel::find($id);
		
		\Cache::forget("app_" . $app->app_unique_id);
		
        $app->delete();

        AppContent::where('app_id', $id)->delete();

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }
}
