<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Fixure;
class FixureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Fixure::orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
            ->editColumn('time', function($row){
                        $date = date_create($row->date_time);
                          $date_format = date_format($date,"d-F, h:i A");
                        return '<p>'.$date_format.'</p>';
                    })

            ->addColumn('team_one', function ($row) {
                    if($row->image_one_type == 'url'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . $row->image_one_value . '"><span class="ml-2">'
                        . $row->team_one_name .
                        '</span></div>';
                    }
                    if($row->image_one_type == 'image'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset($row->image_one_value) . '"><span class="ml-2">'
                        . $row->team_one_name .
                        '</span></div>';
                    }
                    return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset('public/default/default-team.png') . '"><span class="ml-2">'
                        . $row->team_one_name .
                        '</span></div>'; 
                })
                ->addColumn('team_two', function ($row) {
                    if($row->image_two_type == 'url'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . $row->image_two_value . '"><span class="ml-2">'
                        . $row->team_two_name .
                        '</span></div>';
                    }
                    if($row->image_two_type == 'image'){
                        return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset($row->image_two_value) . '"><span class="ml-2">'
                        . $row->team_two_name .
                        '</span></div>';
                    }
                    return '<div style=" white-space: nowrap; ">
                        <img class="img-sm img-thumbnail" src="' . asset('public/default/default-team.png') . '"><span class="ml-2">'
                        . $row->team_two_name .
                        '</span></div>';
                })
                ->addColumn('action', function($row){

                    

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('fixures.edit', $row->id) . '" class="dropdown-item">
                                        ' . _lang('Edit') . '
                                    </a>';
                    $action .= '<form action="' . route('fixures.destroy', $row->id) . '" method="post" class="ajax-delete">'
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
                ->setRowId(function ($row) {
                    return "row_" . $row->id;
                })
                ->rawColumns(['action', 'time', 'team_one', 'team_two']) 
                ->make(true);
        }

        return view('backend.fixures.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $types = DB::table('sports_types')->orderBy('id','ASC')->get();
        return view('backend.fixures.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
		$time_stamp = strtotime($request->date_time);
        $data = array();
        $data['sports_type_id'] = $request->sports_type_id;
        $data['series_name'] = $request->series_name;
        $data['team_one_name'] = $request->team_one_name;
        $data['team_two_name'] = $request->team_two_name;
        $data['image_one_type'] = $request->image_one_type;
        $data['image_two_type'] = $request->image_two_type;
        $data['date_time'] = $request->date_time;
		$data['timestamp'] = $time_stamp;
        if($request->image_one_type == 'image')
        {
            $image_one = $request->file('image_one_value');
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
            $image_one->move(public_path('uploads/fixures'), $image_one_name);
            $data['image_one_value']='public/uploads/fixures/'.$image_one_name;
        }
        else
        {
            $data['image_one_value'] = $request->image_one_value;
        }

        if($request->image_two_type == 'image')
        {
            $image_one = $request->file('image_two_value');
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
            $image_one->move(public_path('uploads/fixures'), $image_one_name);
            $data['image_two_value']='public/uploads/fixures/'.$image_one_name;
        }
        else
        {
            $data['image_two_value'] = $request->image_two_value;
        }

        DB::table('fixures')->insert($data);
		\Cache::forget("fixures");
		
        if(!$request->ajax()) {
            return redirect('fixures')->with('success', _lang('Fixure Inserted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Fixure Inserted')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $types = DB::table('sports_types')->orderBy('id','ASC')->get();
        $edit = DB::table('fixures')->where('id',$id)->first();
        return view('backend.fixures.edit', compact('types', 'edit'));
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
		$time_stamp = strtotime($request->date_time);
        $data = array();
        $data['sports_type_id'] = $request->sports_type_id;
        $data['series_name'] = $request->series_name;
        $data['team_one_name'] = $request->team_one_name;
        $data['team_two_name'] = $request->team_two_name;
        $data['image_one_type'] = $request->image_one_type;
        $data['image_two_type'] = $request->image_two_type;
        $data['date_time'] = $request->date_time;
		$data['timestamp'] = $time_stamp;
        $image_one = $request->file('image_one_value');
        $image_two = $request->file('image_two_value');
        if($image_one && $image_two)
        {
             if($request->image_one_type == 'image')
            {
                
                $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
                //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
                $image_one->move(public_path('uploads/fixures'), $image_one_name);
                $data['image_one_value']='public/uploads/fixures/'.$image_one_name;
            }
            else
            {
                $data['image_one_value'] = $request->image_one_value;
            }

            if($request->image_two_type == 'image')
            {
                
                $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
                //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
                $image_two->move(public_path('uploads/fixures'), $image_two_name);
                $data['image_two_value']='public/uploads/fixures/'.$image_two_name;
            }
            else
            {
                $data['image_two_value'] = $request->image_two_value;
            }
        }
        elseif($image_one)
        {
            if($request->image_one_type == 'image')
            {
                
                $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
                //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
                $image_one->move(public_path('uploads/fixures'), $image_one_name);
                $data['image_one_value']='public/uploads/fixures/'.$image_one_name;
            }
            else
            {
                $data['image_one_value'] = $request->image_one_value;
            }
        }
        elseif($image_two)
        {
            if($request->image_two_type == 'image')
            {
                
                $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
                //Image::make($image_one)->resize(270,270)->save('public/uploads/client/'.$image_one_name);
                $image_two->move(public_path('uploads/fixures'), $image_two_name);
                $data['image_two_value']='public/uploads/fixures/'.$image_two_name;
            }
            else
            {
                $data['image_two_value'] = $request->image_two_value;
            }
        }

        if($request->image_one_type == 'url')
        {
            $data['image_one_value'] = $request->image_one_value;
        }

        if($request->image_two_type == 'url')
        {
            $data['image_two_value'] = $request->image_two_value;
        }
       

        DB::table('fixures')->where('id',$id)->update($data);
		
		\Cache::forget("fixures");
        if(!$request->ajax()) {
            return redirect('fixures')->with('success', _lang('Fixure Updated'));
        } else {
            return response()->json(['result' => 'success', 'redirect' => url('/fixures'), 'message' => _lang('Fixure Updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        DB::table('fixures')->where('id',$id)->delete();
		\Cache::forget("fixures");
        if (!$request->ajax()) {
            return redirect('fixures')->with('success', _lang('Fixure Deleted'));
        } else {
            return response()->json(['result' => 'success', 'redirect' => url('/fixures'), 'message' => _lang('Fixure Deleted')]);
        }
    }
}
