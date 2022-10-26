<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use DataTables;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $app_unique_id = '')
    {
        $app_unique_id = $request->id;
        $payments = [];
        if($app_unique_id != ''){
            $payments = Payment::with('user', 'subscription')->whereHas('app', function($query) use($app_unique_id) {
                                            $query->where('app_unique_id', $app_unique_id);
                                        })
                                        ->orderBy('id', 'DESC');
        }

        if ($request->ajax()) {
            return DataTables::of($payments)
                ->editColumn('platform', function ($payment) {
                    return strtoupper($payment->platform);
                })
                ->addColumn('action', function($payment){

                    $action = '<div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ' . _lang('Action') . '
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    $action .= '<a href="' . route('payments.show', $payment->id) . '" class="dropdown-item ajax-modal" data-title="' . _lang('Details') . '">
                                        <i class="fas fa-eye"></i>
                                        ' . _lang('Details') . '
                                    </a>';
                    $action .= '</div>
                            </div>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.payments.index', compact('payments', 'app_unique_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$request->ajax()) {
            return view('backend.payments.modal.show', compact('payment'));
        } else {
            return view('backend.payments.modal.show', compact('payment'));
        }
    }

}

