<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highlight;
use App\Models\HighlightApp;
use App\Models\HighlightStreamingSource;
use App\Models\AppModel;
use DataTables;
use DB;

class HighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $highlights = Highlight::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return DataTables::of($highlights)
                ->addColumn('team_one', function ($highlight) {
                    if($highlight->team_one_image_type == 'url'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . $highlight->team_one_url . '"><span class="ml-2">'
                        . $highlight->team_one_name .
                        '</span></div>';
                    }
                    if($highlight->team_one_image_type == 'image'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset($highlight->team_one_image) . '"><span class="ml-2">'
                        . $highlight->team_one_name .
                        '</span></div>';
                    }
                    return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset('public/default/default-team.png') . '"><span class="ml-2">'
                        . $highlight->team_one_name .
                        '</span></div>';
                })
                ->addColumn('team_two', function ($highlight) {
                    if($highlight->team_two_image_type == 'url'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . $highlight->team_two_url . '"><span class="ml-2">'
                        . $highlight->team_two_name .
                        '</span></div>';
                    }
                    if($highlight->team_two_image_type == 'image'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset($highlight->team_two_image) . '"><span class="ml-2">'
                        . $highlight->team_two_name .
                        '</span></div>';
                    }
                    return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset('public/default/default-team.png') . '"><span class="ml-2">'
                        . $highlight->team_two_name .
                        '</span></div>';
                })
                ->addColumn('apps', function ($highlight) {
                    $apps_name = '';

                    foreach (\App\Models\HighlightApp::where('highlight_id', $highlight->id)->join('apps', 'apps.id', 'app_id')->get() as $app){
                        $apps_name .= $app->app_name . ', ';
                    }

                     return $apps_name;
                })
                ->addColumn('action', function($highlight){

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('highlights.edit', $highlight->id) . '" class="dropdown-item">
                                        <i class="fas fa-edit"></i>
                                        ' . _lang('Edit') . '
                                    </a>';
                    
                    $action .= '<form action="' . route('highlights.destroy', $highlight->id) . '" method="post" class="ajax-delete">'
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
                ->setRowId(function ($highlight) {
                    return "row_" . $highlight->id;
                })
                ->rawColumns(['action', 'status', 'team_one', 'team_two'])
                ->make(true);
        }

        return view('backend.highlights.index', compact('highlights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.highlights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [

            'apps' => 'required',
            'match_title' => 'required|string|max:191',
            'sports_type_id' => 'required',
            'team_one_name' => 'required|string|max:191',
            'team_one_image_type' => 'required|string|max:20',
            'team_one_url' => 'nullable|required_if:team_one_image_type,url|url',
            'team_one_image' => 'required_if:team_one_image_type,image|image',
            'team_two_name' => 'required|string|max:191',
            'team_two_image_type' => 'required|string|max:20',
            'team_two_url' => 'nullable|required_if:team_two_image_type,url|url',
            'team_two_image' => 'required_if:team_two_image_type,image|image',
            'cover_image_type' => 'required|string|max:20',
            'cover_url' => 'nullable|required_if:cover_image_type,url|url',
            'cover_image' => 'required_if:cover_image_type,image|image',
            'status' => 'required',

            'stream_title' => 'required',
            'stream_title.*' => 'required',
            'stream_type' => 'required',
            'stream_type.*' => 'required',
            'stream_url' => 'required',
            'stream_url.*' => 'required',
            'resulation' => 'required',
            'resulation.*' => 'required',
            'name' => 'nullable|required_if:stream_type,restricted',
            'name.*' => 'nullable|required_if:stream_type,restricted',
            'name.*.*' => 'nullable|required_if:stream_type,restricted',
            'value' => 'nullable|required_if:stream_type,restricted',
            'value.*' => 'nullable|required_if:stream_type,restricted',
            'value.*.*' => 'nullable|required_if:stream_type,restricted',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        DB::beginTransaction();

        $highlight = new Highlight();

        $highlight->sports_type_id = $request->sports_type_id;
        $highlight->match_title = $request->match_title;
        $highlight->team_one_name = $request->team_one_name;
        $highlight->team_one_image_type = $request->team_one_image_type;
        $highlight->team_one_url = $request->team_one_url;
        $highlight->team_two_name = $request->team_two_name;
        $highlight->team_two_image_type = $request->team_two_image_type;
        $highlight->team_two_url = $request->team_two_url;
        $highlight->cover_image_type = $request->cover_image_type;
        $highlight->cover_url = $request->cover_url;
        $highlight->status = $request->status;
        
        if ($request->hasFile('team_one_image')) {
            $image = $request->file('team_one_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->team_one_image = 'public/uploads/images/highlights/' . $ImageName;
        }

        if ($request->hasFile('team_two_image')) {
            $image = $request->file('team_two_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->team_two_image = 'public/uploads/images/highlights/' . $ImageName;
        }
        
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->cover_image = 'public/uploads/images/highlights/' . $ImageName;
        }

        $highlight->save();

        for ($i=0; $i < count($request->apps); $i++) { 
            
            $app = new HighlightApp();

            $app->app_id = $request->apps[$i];
            $app->highlight_id = $highlight->id;

            $app->save();
            
            $appData = AppModel::where('id', $app->app_id)->first();
            \Cache::forget("highlights_" . $appData->app_unique_id);
        }
        
    

        for ($i=0; $i < count($request->stream_title); $i++) { 
            if($request->stream_title[$i] != '' && $request->stream_type[$i] != '' && $request->stream_url[$i] != ''){

                $headers = '';

                if ($request->stream_type[$i] == 'restricted') {
                    $h = array();
                    if(isset($request->name[$i]) && isset($request->value[$i])){
                        for ($i2=0; $i2 < count($request->name[$i]); $i2++) { 
                            if($request->name[$i][$i2] != null && $request->value[$i][$i2] != null){
                                $h[$request->name[$i][$i2]] = $request->value[$i][$i2];
                            }
                        }
                    }
                    $headers = json_encode($h);
                }

                $streaming_source = new HighlightStreamingSource();

                $streaming_source->highlight_id = $highlight->id;
                $streaming_source->stream_title = $request->stream_title[$i];
                $streaming_source->resulation = $request->resulation[$i];
                $streaming_source->stream_type = $request->stream_type[$i];
                $streaming_source->stream_url = $request->stream_url[$i];
                $streaming_source->stream_key = $request->stream_type[$i] == 'root_stream' ? $request->stream_key[$i] : '';
                $streaming_source->headers = $request->stream_type[$i] == 'restricted' ? $headers : '';
                $streaming_source->block_country = $request->block_country[$i];
                $streaming_source->is_block_them = $request->is_block_them[$i] ?? 0;

                $streaming_source->save();
            }
        }

        DB::commit();
        
        \Cache::forget("highlight_$highlight->id");
        \Cache::forget("highlightStreamingSources_$highlight->id");

        if (!$request->ajax()) {
            return redirect('highlights')->with('success', _lang('Information has been added.'));
        } else {
            return response()->json(['result' => 'success', 'redirect' => url('highlights'), 'message' => _lang('Information has been added sucessfully.')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $highlight = Highlight::find($id);

        return view('backend.highlights.edit', compact('highlight'));
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
        //dd($request->all());
        $validator = \Validator::make($request->all(), [

            'apps' => 'required',
            'match_title' => 'required|string|max:191',
            'sports_type_id' => 'required',
            'team_one_name' => 'required|string|max:191',
            'team_one_image_type' => 'required|string|max:20',
            'team_one_url' => 'nullable|required_if:team_one_image_type,url|url',
            'team_one_image' => 'required_if:team_one_image_type,image|image',
            'team_two_name' => 'required|string|max:191',
            'team_two_image_type' => 'required|string|max:20',
            'team_two_url' => 'nullable|required_if:team_two_image_type,url|url',
            'team_two_image' => 'required_if:team_two_image_type,image|image',
            'cover_image_type' => 'required|string|max:20',
            'cover_url' => 'nullable|required_if:cover_image_type,url|url',
            'cover_image' => 'nullable|image',
            'status' => 'required',

            'stream_title' => 'required',
            'stream_title.*' => 'nullable|required_if:is_deleted,no',
            'stream_type' => 'required',
            'stream_type.*' => 'nullable|required_if:is_deleted,no',
            'stream_url' => 'required',
            'stream_url.*' => 'nullable|required_if:is_deleted,no',
            'resulation' => 'required',
            'resulation.*' => 'nullable|required_if:is_deleted,no',
            'name' => 'nullable|required_if:stream_type,restricted',
            'name.*' => 'nullable|required_if:stream_type,restricted',
            'name.*.*' => 'nullable|required_if:stream_type,restricted',
            'value' => 'nullable|required_if:stream_type,restricted',
            'value.*' => 'nullable|required_if:stream_type,restricted',
            'value.*.*' => 'nullable|required_if:stream_type,restricted',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        DB::beginTransaction();

        $highlight = Highlight::find($id);

        $highlight->sports_type_id = $request->sports_type_id;
        $highlight->match_title = $request->match_title;
        $highlight->team_one_name = $request->team_one_name;
        $highlight->team_one_image_type = $request->team_one_image_type;
        $highlight->team_one_url = $request->team_one_url;
        $highlight->team_two_name = $request->team_two_name;
        $highlight->team_two_image_type = $request->team_two_image_type;
        $highlight->team_two_url = $request->team_two_url;
        $highlight->cover_image_type = $request->cover_image_type;
        $highlight->cover_url = $request->cover_url;
        $highlight->status = $request->status;
        
        if ($request->hasFile('team_one_image')) {
            $image = $request->file('team_one_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->team_one_image = 'public/uploads/images/highlights/' . $ImageName;
        }

        if ($request->hasFile('team_two_image')) {
            $image = $request->file('team_two_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->team_two_image = 'public/uploads/images/highlights/' . $ImageName;
        }
        
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->save(base_path('public/uploads/images/highlights/') . $ImageName);
            $highlight->cover_image = 'public/uploads/images/highlights/' . $ImageName;
        }

        $highlight->save();

        HighlightApp::where('highlight_id', $highlight->id)->delete();
        for ($i=0; $i < count($request->apps); $i++) { 
            
            $app = new HighlightApp();

            $app->app_id = $request->apps[$i];
            $app->highlight_id = $highlight->id;

            $app->save();
            
            $appData = AppModel::where('id', $app->app_id)->first();
            \Cache::forget("highlights_" . $appData->app_unique_id);
            //\Cache::forget("highlights_");
        }
        

        HighlightStreamingSource::where('highlight_id', $highlight->id)->delete();
        for ($i=0; $i < count($request->stream_title); $i++) { 
            if($request->stream_title[$i] != '' && $request->stream_type[$i] != '' && $request->stream_url[$i] != '' && $request->is_deleted[$i] != 'yes'){

                $headers = '';

                if ($request->stream_type[$i] == 'restricted') {
                    $h = array();
                    if(isset($request->name[$i]) && isset($request->value[$i])){
                        for ($i2=0; $i2 < count($request->name[$i]); $i2++) { 
                            if($request->name[$i][$i2] != null && $request->value[$i][$i2] != null){
                                $h[$request->name[$i][$i2]] = $request->value[$i][$i2];
                            }
                        }
                    }
                    $headers = json_encode($h);
                }

                $streaming_source = new HighlightStreamingSource();

                $streaming_source->highlight_id = $highlight->id;
                $streaming_source->stream_title = $request->stream_title[$i];
                $streaming_source->resulation = $request->resulation[$i];
                $streaming_source->stream_type = $request->stream_type[$i];
                $streaming_source->stream_url = $request->stream_url[$i];
                $streaming_source->stream_key = $request->stream_type[$i] == 'root_stream' ? $request->stream_key[$i] : '';
                $streaming_source->headers = $request->stream_type[$i] == 'restricted' ? $headers : '';
                $streaming_source->block_country = $request->block_country[$i];
                $streaming_source->is_block_them = $request->is_block_them[$i] ?? 0;

                $streaming_source->save();
            }
        }

        // return ($headers);

        DB::commit();
        
        
        \Cache::forget("highlight_$highlight->id");
        \Cache::forget("highlightStreamingSources_$highlight->id");

        if (!$request->ajax()) {
            return redirect('highlights')->with('success', _lang('Information has been updated.'));
        } else {
            return response()->json(['result' => 'success', 'redirect' => url('highlights'), 'message' => _lang('Information has been updated sucessfully.')]);
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
        $highlight = Highlight::find($id);
        $highlight->delete();
        
        $apps = HighlightApp::where('highlight_id', $highlight->id)->get();
        foreach($apps as $app){
            $appData = AppModel::where('id', $app->id)->first();
            if(!$appData){
                continue;
            }
            \Cache::forget("highlights_" . $appData->app_unique_id);
        }

        \Cache::forget("highlight_$id");
        \Cache::forget("highlightStreamingSources_$id");

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }
}

