<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VcbAeroSpendModel;
use App\Models\VcbPaymentDetailModel;

use Exception;
use App\Traits\SpendDetailsTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class VcbAeroSpendController extends Controller
{
    use SpendDetailsTrait;


    public function index($id)
    {
        try {
            $data = VcbAeroSpendModel::where('id_vcb_budget', $id)
                ->with('VcbBudget')
                ->firstOrFail();

            $data->profit = $this->calculateProfit($data->VcbBudget->total, $data->total, $data->VcbBudget->fix_profit);
        } catch (\Throwable $th) {
            Log::error($th);
            $data = (object)['profit' => '#error!'];
        }

        return view('vcb-aero-spend.index', compact('data'))->render();
    }




    public function create($id, $pe_name)
    {
        return view('vcb-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
    }



    public function store(Request $request)
    {
        try {
            $spendModel = VcbAeroSpendModel::create($request->all());

            if ($spendModel) {
                Session::flash('success', 'Form submitted successfully');
            } else {
                Session::flash('failed', 'Failed to create form');
            }

            return redirect()->route('vcb-budget-tnb.index');
        } catch (\Throwable $th) {
            \Log::error($th);
            Session::flash('failed', 'Request failed');

            return redirect()->back();
        }
    }



    public function show($id)
    {
       return $this->getSpendDetailsView($id, false);
    }



    public function edit($id)
    {

       
        return $this->getSpendDetailsView($id, true);
    }




    public function update(Request $request, $id)
    {



        try {
            $spendModel = VcbAeroSpendModel::findOrFail($id);
            $spendModel->update($request->all());

            Session::flash('success', 'Form updated');
        } catch (\Throwable $th) {
            \Log::error($th);
            Session::flash('failed', 'Request failed');
        }

        return redirect()->route('vcb-budget-tnb.index');
    }




    public function destroy($id)
    {
        try {
            VcbAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('vcb-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('vcb-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }




    private function getSpendDetailsView($id, $action)
    {
        $data = VcbAeroSpendModel::where('id', $id)
            ->with(['VcbBudget', 'SpendDetail'])
            ->first();

        if (!$data) {
            abort(404);
        }

        // Calculate profit
        $data->profit = $this->calculateProfit($data->VcbBudget->total, $data->total, $data->VcbBudget->fix_profit);


        // Group spend details by payment name
        $spendDetails = $this->groupSpendDetails($data->SpendDetail);

        return view('vcb-aero-spend.edit', [
            'data' => $data,
            'spendDetails' => $spendDetails,
            'action' => $action,
        ]);
    }


}
