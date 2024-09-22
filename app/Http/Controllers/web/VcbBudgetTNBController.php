<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\SiteDataCollection;
use Illuminate\Http\Request;
use App\Models\VcbBudgetTNBModel;
use Exception;
use App\Models\VcbAeroSpendModel;
use App\Models\VcbPaymentDetailModel;
use Illuminate\Support\Facades\Session;


class VcbBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            //code...

            $data = VcbBudgetTNBModel::find($id)
                ->withCount('VcbSpends')
                ->with(['VcbSpends'])
                ->first();
            if ($data) {
                return view('vcb-budget-tnb.index', ['data' => $data]);
            } 
        } catch (\Throwable $th) {
            return redirect()->back();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

        $data = SiteDataCollection::find($id);
        if ($data) { 
            $check = VcbBudgetTNBModel::where('pe_name', $data->nama_pe)->first();
            if ($check) {
                return redirect()->route('vcb-budget-tnb.index', $check->id);
            }
        }
        return view('vcb-budget-tnb.form', ['name' => $data->nama_pe]);
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */






    public function store(Request $request)
    {
        //
        try {
            // Check if it's a new record and there is no existing record with the same 'pe_name'
            if ($request->id == '' && !VcbBudgetTNBModel::where('pe_name', $request->pe_name)->exists()) {
                // Create a new budget record
                $storeBudget = VcbBudgetTNBModel::create($request->all());

                // If the budget record is successfully created, create a corresponding AeroSpendModel record
                if ($storeBudget) {
                 $rec  =   VcbAeroSpendModel::create(['id_vcb_budget' => $storeBudget->id]);
                }
            } else {
                // If it's an existing record, find and update it
                $rec = VcbBudgetTNBModel::find($request->id);
                if ($rec) {
                    $rec->update($request->all());
                } else {
                    // If the record is not found, return with a failure message
                    Session::flash('failed', 'Request Failed');
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            // Handle any exceptions and return with a failure message
            Session::flash('failed', 'Request Failed');
            return redirect()->back();
        }

        // If everything is successful, return with a success message
        Session::flash('success', 'Request Success');
        return redirect()->route('vcb-budget-tnb.index', $rec->id);
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
        $data = VcbBudgetTNBModel::find($id);
        return $data ? view('vcb-budget-tnb.form', ['item' => $data ,'disabled'=>true]) : abrot(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = VcbBudgetTNBModel::find($id);
        return $data ? view('vcb-budget-tnb.form', ['item' => $data]) : abrot(404);
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
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        try {
            VcbBudgetTNBModel::find($id)->delete();
            $data = VcbAeroSpendModel::where('id_vcb_budget', $id);
            $getData = $data->first();
            if ($getData) {
                $paymentData = VcbPaymentDetailModel::where('vcb_id', $getData->id);
                if ($paymentData->get()) {
                    $paymentData->delete();
                }

                $data->delete();
            }

        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
            return redirect()->back();
        }

        Session::flash('success', 'Request Success');

        return redirect()->route('site-data-collection.index');
    }
}
