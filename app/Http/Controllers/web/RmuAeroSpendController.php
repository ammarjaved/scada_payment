<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuAeroSpendModel;
use App\Models\RmuPaymentDetailModel;

use Exception;
use App\Traits\SpendDetailsTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RmuAeroSpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SpendDetailsTrait;


    public function index($id)
    {
        try {
            $data = RmuAeroSpendModel::where('id_rmu_budget', $id)
                ->with('RmuBudget')
                ->firstOrFail();

            $data->profit = $data->RmuBudget->total-$data->total;  //$this->calculateProfit($data->RmuBudget->total, $data->total, $data->RmuBudget->fix_profit);
        } catch (\Throwable $th) {
            Log::error($th);
            $data = (object)['profit' => '#error!'];
        }

        $paymentData = collect(RmuPaymentDetailModel::where('rmu_id', $data->id)->get());
        $result = $paymentData->where('status', 'work done but not payed')
          ->pluck('pmt_name');


        foreach ($result as $value) {
            $property= $value.'_status';
            $data->$property='work done but not payed';
        }

        //return $data;

        return view('rmu-aero-spend.index', compact('data'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $pe_name)
    {
        //
        return view('rmu-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
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
            $spendModel = RmuAeroSpendModel::create($request->all());

            if ($spendModel) {
                Session::flash('success', 'Form submitted successfully');
            } else {
                Session::flash('failed', 'Failed to create form');
            }

            return redirect()->route('rmu-budget-tnb.index');
        } catch (\Throwable $th) {
            \Log::error($th);
            Session::flash('failed', 'Request failed');

            return redirect()->back();
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
        return $this->getSpendDetailsView($id, false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        return $this->getSpendDetailsView($id, true);
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



        try {
            $spendModel = CsuAeroSpendModel::findOrFail($id);
            $spendModel->update($request->all());

            Session::flash('success', 'Form updated');
        } catch (\Throwable $th) {
            \Log::error($th);
            Session::flash('failed', 'Request failed');
        }

        return redirect()->route('csu-budget-tnb.index');
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
            RmuAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }

    private function getSpendDetailsView($id, $action)
    {

        $data = RmuAeroSpendModel::where('id', $id)
            ->with(['RmuBudget', 'SpendDetail'])
            ->first();


        if (!$data) {
            abort(404);
        }

        // Calculate profit
        $data->profit = ($data->RmuBudget->total)-($data->total); //$this->calculateProfit($data->RmuBudget->total, $data->total, $data->RmuBudget->fix_profit);


        // Group spend details by payment name
        $spendDetails = $this->groupSpendDetails($data->SpendDetail);

       // return  $data;

        return view('rmu-aero-spend.edit', [
            'data' => $data,
            'spendDetails' => $spendDetails,
            'action' => $action,
        ]);
    }
}
