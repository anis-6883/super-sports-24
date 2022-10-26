<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\AppModel;
use App\Models\LiveMatch;
use App\Models\LiveMatchApp;
use DataTables;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = Notification::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return DataTables::of($notifications)
                ->addColumn('checkbox', function($notification){
                    return '<div class="form-check d-flex justify-content-center align-items-center">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="notify_checkbox" data-id="' . $notification->id . '">
                                <span class="form-check-sign b h4"></span>
                                </label>
                            </div>';
                })
                ->addColumn('action', function($notification){

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('notifications.edit', $notification->id) . '" class="dropdown-item">
                                        ' . _lang('Resend') . '
                                    </a>';
                    $action .= '<form action="' . route('notifications.destroy', $notification->id) . '" method="post" class="ajax-delete">'
                                . csrf_field() 
                                . method_field('DELETE') 
                                . '<button type="button" class="btn-remove dropdown-item">
                                        ' . _lang('Delete') . '
                                    </button>
                                </form>';
                    $action .= '</div>
                            </div>';
                    return $action;
                })
                ->setRowId(function ($notification) {
                    return "row_" . $notification->id;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }

        return view('backend.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('backend.notifications.create');
    }

    public function store(Request $request)
    {

    	$validator = \Validator::make($request->all(), [

            'apps' => 'required',
            'title' => 'required|string|max:191',
            'body' => 'required',
            'image_type' => 'required|string|max:20',
            'image_url' => 'nullable|required_if:image_type,url|url',
            'image' => 'required_if:image_type,image|image',
            'notification_type' => 'required|string|max:20',
            'action_url' => 'nullable|required_if:notification_type,==,url|url|max:191',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $image = '';

        $notification = new Notification();

        $notification->apps = json_encode($request->apps);
        $notification->title = $request->title;
        $notification->message = $request->body;
        $notification->image_type = $request->image_type;
        $notification->image_url = $request->image_url;
        $notification->notification_type = $request->notification_type;
        $notification->action_url = $request->action_url;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/notifications/') . $ImageName);
            $notification->image = 'public/uploads/images/notifications/' . $ImageName;
        }

        $notification->save();

        if($request->image_type == 'url'){
            $image = $request->image_url;
        }elseif ($request->image_type == 'image') {
            $image = asset($notification->image);
        }

        $ios_img = array(
            "id1" => $image,
        );
		
		$headings = array("en" => $notification->title);
        $content = array("en" => $notification->message);

        for ($i=0; $i < count($request->apps); $i++) { 
            
            $app = AppModel::where('id', $request->apps[$i])->first();

            if($app){
                if($app->notification_type == 'onesignal'){
                    $fields = array(
                        'app_id' => $app->onesignal_app_id,
                        'headings' => $headings,
                        'included_segments' => array('All'),
                        'data' => array('image' => $image,
                            'notification_type' =>  $notification->notification_type,
                            'action_url' => $notification->action_url,
                        ),
                        'big_picture' => $image,
                        'large_icon' => asset($app->app_logo),
                        'content_available' => true,
                        'contents' => $content,
                        'ios_attachments' => $ios_img,
                    );

                    $fields = json_encode($fields);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 
                        'Authorization: Basic ' . $app->onesignal_api_key));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

                    $response = curl_exec($ch);
                    curl_close($ch);
                    
                }else{
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $dataArr = array(
                        'title' => $notification->title,
                        'body' => $notification->message,
						'style' => "picture",
                        'image' => $image,
                        'notification_type' =>  $notification->notification_type,
                        'action_url' => $notification->action_url,
                    );
					$notificationData = array(
                        'title' => $notification->title,
                        'body' => $notification->message,
						'image' => $image,
						'style' => "picture",
                    );
                    
                    $android = array(
                        'notification' => array('image' => $image),
                    );

                    $arrayToSend = array('to' => "/topics/" . $app->firebase_topics, 'data' => $dataArr, 'priority' => 'high', 'notification' => $notificationData , 'android' => $android);
                    $fields = json_encode($arrayToSend);
                    $headers = array(
                        'Authorization: key=' . $app->firebase_server_key,
                        'Content-Type: application/json'
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                    $result = curl_exec($ch);
                    curl_close($ch);
                }
            }
        }

        if (!$request->ajax()) {
            return redirect('notifications')->with('success', _lang('Notification sent!'));
        } else {
            return response()->json(['result' => 'success', 'redirect' => url('/notifications'), 'message' => _lang('Notification sent!')]);
        }
    }

    public function sent_notification(Request $request)
    {
        $live_match = LiveMatch::find($request->live_match_id);
        $apps = LiveMatchApp::where('match_id', $request->live_match_id)->pluck('app_id');

        $notification = new Notification();
        $title = "Enjoy LIVE🔥 " . $live_match->team_one_name . " vs " . $live_match->team_two_name . ", " . $live_match->match_title;
        $notification->apps = json_encode($apps);
        $notification->title = $title;
        $notification->message = "We Are Streaming Live 📺 Enjoy Live Now";
        $notification->image_type = "none";
        $notification->notification_type = "in_app";
        $notification->save();

        $image = '';
        $headings = array("en" => $notification->title);
        $content = array("en" => $notification->message);
        $ios_img = array(
            "id1" => $image,
        );

        for ($i=0; $i < count($apps); $i++) { 
            
            $app = AppModel::where('id', $apps[$i])->first();

            if($app){
                if($app->notification_type == 'onesignal'){
                    $fields = array(
                        'app_id' => $app->onesignal_app_id,
                        'headings' => $headings,
                        'included_segments' => array('All'),
                        'data' => array('image' => $image,
                            'notification_type' =>  $notification->notification_type,
                            'action_url' => $notification->action_url,
                        ),
                        'big_picture' => $image,
                        'large_icon' => asset($app->app_logo),
                        'content_available' => true,
                        'contents' => $content,
                        'ios_attachments' => $ios_img,
                    );

                    $fields = json_encode($fields);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 
                        'Authorization: Basic ' . $app->onesignal_api_key));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

                    $response = curl_exec($ch);
                    curl_close($ch);
                    
                }else{
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $dataArr = array(
                        'title' => $notification->title,
                        'body' => $notification->message,
						'style' => "picture",
                        'image' => $image,
                        'notification_type' =>  $notification->notification_type,
                        'action_url' => $notification->action_url,
                    );
					$notificationData = array(
                        'title' => $notification->title,
                        'body' => $notification->message,
						'image' => $image,
						'style' => "picture",
                    );
                    
                    $android = array(
                        'notification' => array('image' => $image),
                    );

                    $arrayToSend = array('to' => "/topics/" . $app->firebase_topics, 'data' => $dataArr, 'priority' => 'high', 'notification' => $notificationData , 'android' => $android);
                    $fields = json_encode($arrayToSend);
                    $headers = array(
                        'Authorization: key=' . $app->firebase_server_key,
                        'Content-Type: application/json'
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                    $result = curl_exec($ch);
                    curl_close($ch);
                }
            }
        }
        return response()->json(['status' => true, 'message' => 'Notification sent!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $notification = Notification::find($id);

        return view('backend.notifications.edit', compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteall(Request $request)
    {
        $notification = Notification::truncate();

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }

    public function deleteSelectedNotifications(Request $request)
    {
        Notification::whereIn('id', $request->notification_ids)->delete();
        
        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }
}
