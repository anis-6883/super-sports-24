<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsType;
use DataTables;

class SportsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sports_types = SportsType::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return DataTables::of($sports_types)
                ->addColumn('status', function ($sports_type) {
                    return $sports_type->status == 1 ? status(_lang('Active'), 'success') : status(_lang('In-Active'), 'danger');
                })
                ->addColumn('action', function($sports_type){

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('sports_types.edit', $sports_type->id) . '" class="dropdown-item ajax-modal" data-title="' . _lang('Edit') . '">
                                        <i class="fas fa-edit"></i>
                                        ' . _lang('Edit') . '
                                    </a>';
                    $action .= '<form action="' . route('sports_types.destroy', $sports_type->id) . '" method="post" class="ajax-delete">'
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
                ->setRowId(function ($sports_type) {
                    return "row_" . $sports_type->id;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

        return view('backend.sports_types.index', compact('sports_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.sports_types.create');
        } else {
            return view('backend.sports_types.modal.create');
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

            'sports_name' => 'required|string|max:100',
            'sports_skq' => 'required|string|max:100',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $sports_type = new SportsType();

        $sports_type->sports_name = $request->sports_name;
        $sports_type->sports_skq = $request->sports_skq;
        $sports_type->status = $request->status;

        $sports_type->save();

        if (!$request->ajax()) {
            return redirect('sports_types')->with('success', _lang('Information has been added.'));
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
        $sports_type = SportsType::find($id);

        if (!$request->ajax()) {
            return view('backend.sports_types.edit', compact('sports_type'));
        } else {
            return view('backend.sports_types.modal.edit', compact('sports_type'));
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

            'sports_name' => 'required|string|max:100',
            'sports_skq' => 'required|string|max:100',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $sports_type = SportsType::find($id);

        $sports_type->sports_name = $request->sports_name;
        $sports_type->sports_skq = $request->sports_skq;
        $sports_type->status = $request->status;

        $sports_type->save();

        if (!$request->ajax()) {
            return redirect('sports_types')->with('success', _lang('Information has updated added.'));
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
        $sports_type = SportsType::find($id);
        $sports_type->delete();

        if (!$request->ajax()) {
            return back()->with('success', _lang('Information has been deleted'));
        } else {
            return response()->json(['result' => 'success', 'message' => _lang('Information has been deleted sucessfully')]);
        }
    }
}
