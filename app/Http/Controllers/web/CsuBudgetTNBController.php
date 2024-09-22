<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuBudgetTNBModel;
use Exception;
use App\Models\CsuAeroSpendModel;
use App\Models\CsuPaymentDetailModel;
use App\Models\SiteDataCollection;
use Illuminate\Support\Facades\Session;


class CsuBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $data = CsuBudgetTNBModel::find($id)
            ->withCount('CsuSpends')
            ->with(['CsuSpends'])
            ->first();
        if ($data) {
            return view('csu-budget-tnb.index', ['data' => $data]);
        }  
        return redirect()->back();
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
            $check = CsuBudgetTNBModel::where('pe_name', $data->nama_pe)->first();
            if ($check) {
                return redirect()->route('csu-budget-tnb.index', $check->id);
            }
        }
        return view('csu-budget-tnb.form', ['name' => $data->nama_pe]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */





    public function store(Request $request)
    {
        try {
            // Check if it's a new record and there is no existing record with the same 'pe_name'
            if ($request->id == '' && !CsuBudgetTNBModel::where('pe_name', $request->pe_name)->exists()) {
                // Create a new budget record
                $storeBudget = CsuBudgetTNBModel::create($request->all());

                // If the budget record is successfully created, create a corresponding AeroSpendModel record
                if ($storeBudget) {
                 $rec=   CsuAeroSpendModel::create(['id_csu_budget' => $storeBudget->id]);
                }
            } else {
                // If it's an existing record, find and update it
                $rec = CsuBudgetTNBModel::find($request->id);
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
        return redirect()->route('csu-budget-tnb.index', $rec->id);

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

        $data = CsuBudgetTNBModel::find($id);
        return $data ? view('csu-budget-tnb.form', ['item' => $data, 'disabled' => true]) : abrot(404);
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
        $data = CsuBudgetTNBModel::find($id);
        return $data ? view('csu-budget-tnb.form', ['item' => $data]) : abrot(404);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CsuBudgetTNBModel::find($id)->delete();
            $data = CsuAeroSpendModel::where('id_csu_budget', $id);
            $getData = $data->first();
            if ($getData) {
                $paymentData = CsuPaymentDetailModel::where('csu_id', $getData->id);
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
