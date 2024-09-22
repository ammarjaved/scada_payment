<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuAeroSpendModel;
use Exception;
use App\Traits\SpendDetailsTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class CsuAeroSpendController extends Controller
{

    use SpendDetailsTrait;


    public function index($id)
    {
        try {
            $data = CsuAeroSpendModel::where('id_csu_budget', $id)
                ->with('CsuBudget')
                ->firstOrFail();

            $data->profit = $this->calculateProfit($data->CsuBudget->total, $data->total, $data->CsuBudget->fix_profit);
        } catch (\Throwable $th) {
            Log::error($th);
            $data = (object)['profit' => '#error!'];
        }

        return view('csu-aero-spend.index', compact('data'))->render();
    }








    public function create($id, $pe_name)
    {
        //
        return view('csu-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
    }








    public function store(Request $request)
    {
        try {
            $spendModel = CsuAeroSpendModel::create($request->all());

            if ($spendModel) {
                Session::flash('success', 'Form submitted successfully');
            } else {
                Session::flash('failed', 'Failed to create form');
            }

            return redirect()->route('csu-budget-tnb.index');
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
            $spendModel = CsuAeroSpendModel::findOrFail($id);
            $spendModel->update($request->all());

            Session::flash('success', 'Form updated');
        } catch (\Throwable $th) {
            \Log::error($th);
            Session::flash('failed', 'Request failed');
        }

        return redirect()->route('csu-budget-tnb.index');
    }








    public function destroy($id)
    {
        //

        try {
            CsuAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }



    private function getSpendDetailsView($id, $action)
    {
        $data = CsuAeroSpendModel::where('id', $id)
            ->with(['CsuBudget', 'SpendDetail'])
            ->first();

        if (!$data) {
            abort(404);
        }

        // Calculate profit
        $data->profit = $this->calculateProfit($data->CsuBudget->total, $data->total, $data->CsuBudget->fix_profit);


        // Group spend details by payment name
        $spendDetails = $this->groupSpendDetails($data->SpendDetail);

        return view('csu-aero-spend.edit', [
            'data' => $data,
            'spendDetails' => $spendDetails,
            'action' => $action,
        ]);
    }
}
