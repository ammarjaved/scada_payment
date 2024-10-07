<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuBudgetTNBModel;
use Exception;
use App\Models\RmuAeroSpendModel;
use App\Models\RmuPaymentDetailModel;
use App\Models\SiteDataCollection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RmuBudgetTNBController extends Controller
{

    public function listBudgets()
    {
        //we only get budgets for projects that belong to user
        $project = Auth::user()->project;
        $datas = SiteDataCollection::where('project', $project)->get();
        
        $rmus = RmuBudgetTNBModel::with('RmuSpends')->where('total', '>', 0)->get();
    
        foreach ($datas as $data) {
            $matchingRmu = $rmus->firstWhere('pe_name', $data->nama_pe);
    
            if ($matchingRmu) {
                $data->budget = $matchingRmu->total;
    
                if ($matchingRmu->RmuSpends) {
                    $data->aero_spend = $matchingRmu->RmuSpends->total;
                    $data->profit_percent = (($matchingRmu->total - $matchingRmu->RmuSpends->total) / $matchingRmu->total) * 100;
                    $data->profit_total = $matchingRmu->total - $matchingRmu->RmuSpends->total;
                } else {
                    $data->aero_spend = null;
                    $data->profit_percent = null;
                    $data->profit_total = null;
                }
            } else {
                $data->budget = 'Not Available'; // or any default value you prefer
                $data->aero_spend = 'Not Available';
                $data->profit_percent = 'Not Available';
                $data->profit_total = 'Not Available';
            }
        }
    
        return view('rmu-budget-tnb.list-budgets', compact('datas', 'rmus'));
    }
        

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            //code...

            $data = RmuBudgetTNBModel::with(['RmuSpends'])
                ->withCount('RmuSpends')
                ->find($id);
               // ->first();

               $data->profit_percent= (($data->total-$data->RmuSpends->total)/$data->total)*100;  
               $data->profit_total= ($data->total)-($data->RmuSpends->total);  
               $data->spending_total= $data->RmuSpends->total;  

               

            if ($data) {
                return view('rmu-budget-tnb.index', ['data' => $data]);
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
            $check = RmuBudgetTNBModel::where('pe_name', $data->nama_pe)->first();
            if ($check) {
                return redirect()->route('rmu-budget-tnb.index', $check->id);
            }
        }
        return view('rmu-budget-tnb.form', ['name' => $data->nama_pe,'switch' => $data->jenis_perkakasuis,'date'=>date($data->created_at)]);
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
            $vendor=\Auth::user()->project;
            $request['vendor_name']=$vendor;
            if ($request->id == '' && !RmuBudgetTNBModel::where('pe_name', $request->pe_name)->first()) {
               // return $request->all();
                $storeBudget = RmuBudgetTNBModel::create($request->all());

                if ($storeBudget) {
                   $rec= RmuAeroSpendModel::create(['id_rmu_budget' => $storeBudget->id,'project'=>$vendor]);
                }
            } else {
                $rec = RmuBudgetTNBModel::find($request->id);
                if ($rec) {
                    $rec->update($request->all());
                }
                Session::flash('failed', 'Request Failed');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
            return redirect()->back();
        }

        Session::flash('success', 'Request Success');
        return redirect()->route('rmu-budget-tnb.index', $rec->id);
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
        $data = RmuBudgetTNBModel::find($id);
        return $data ? view('rmu-budget-tnb.form', ['item' => $data, 'disabled' => true]) : abrot(404);
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
        $data = RmuBudgetTNBModel::find($id);
        return $data ? view('rmu-budget-tnb.form', ['item' => $data]) : abrot(404);
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
        //

        try {
            RmuBudgetTNBModel::find($id)->delete();
            $data = RmuAeroSpendModel::where('id_rmu_budget', $id);
            $getData = $data->first();

            if ($getData) {
                $paymentData = RmuPaymentDetailModel::where('rmu_id', $getData->id);

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