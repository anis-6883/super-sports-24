<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularSeries;
use DataTables;

class PopularSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $popular_series = PopularSeries::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return DataTables::of($popular_series)
                ->addColumn('status', function ($series) {
                    return $series->status == 1 ? status(_lang('Active'), 'success') : status(_lang('In-Active'), 'danger');
                })
                ->addColumn('action', function($series){

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('popular_series.edit', $series->id) . '" class="dropdown-item " data-title="' . _lang('Edit') . '">
                                        <i class="fas fa-edit"></i>
                                        ' . _lang('Edit') . '
                                    </a>';
                    $action .= '<form action="' . route('popular_series.destroy', $series->id) . '" method="post" class="ajax-delete">'
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
                ->setRowId(function ($series) {
                    return "row_" . $series->id;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

        return view('backend.popular_series.index', compact('popular_series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.popular_series.create');
        } else {
            return view('backend.popular_series.modal.create');
        }
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
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'action_url' => 'required|url',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $series = new PopularSeries();
		
		$series->apps = json_encode($request->apps);
        $series->title = $request->title;
        $series->description = $request->description;
        $series->action_url = $request->action_url;
        $series->status = $request->status;

        $series->save();

        if (!$request->ajax()) {
            return redirect('popular_series')->with('success', _lang('Information has been added.'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Information has been added sucessfully.')]);
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
        $series = PopularSeries::find($id);

        if (!$request->ajax()) {
            return view('backend.popular_series.edit', compact('series'));
        } else {
            return view('backend.popular_series.modal.edit', compact('series'));
        }
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
        $validator = \Validator::make($request->all(), [
			
			'apps' => 'required',
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'action_url' => 'required|url',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $series = PopularSeries::find($id);
		
		$series->apps = json_encode($request->apps);
        $series->title = $request->title;
        $series->description = $request->description;
        $series->action_url = $request->action_url;
        $series->status = $request->status;

        $series->save();

        if (!$request->ajax()) {
            return redirect('popular_series')->with('success', _lang('Information has updated added.'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Information has been updated sucessfully.')]);
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
        $series = PopularSeries::find($id);
        $series->delete();

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }
}
