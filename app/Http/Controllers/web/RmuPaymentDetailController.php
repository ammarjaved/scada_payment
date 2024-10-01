<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuPaymentDetailModel;
use App\Models\RmuAeroSpendModel;
use App\Repositories\PaymentDetail;
use App\Models\RmuBudgetTNBModel;


class RmuPaymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     protected $PaymentDetailTnb;

     public function __construct(PaymentDetail $PaymentDetailTnb)
     {
         $this->PaymentDetailTnb = $PaymentDetailTnb;
     }



    public function index()
    {
        //
    }

    public function Paymentview()
    {
        $data = RmuPaymentDetailModel::with(['RmuSpendDetail'])->where('status', 'work done but not payed')->get();

       

       

        // $debugInfo = $data->map(function ($item) {
        //     return [
        //         'id' => $item->id,
        //         'rmu_id' => $item->rmu_id,
        //         'has_rmu_spend_detail' => $item->relationLoaded('RmuSpendDetail'),
        //         'rmu_spend_detail' => $item->RmuSpendDetail,
        //     ];
        // })->toArray();
        
        // dd($debugInfo);


        $budgetIds = $data->map(function ($item) {
            $item->relationLoaded('RmuSpendDetail');
            return $item->RmuSpendDetail->id_rmu_budget ?? null;
        })->filter()->unique()->values()->toArray();

        
   // dd($budgetIds);

        // Fetch pe_names for these budget IDs
        $peNames = RmuBudgetTNBModel::whereIn('id', $budgetIds)
            ->pluck('pe_name', 'id')
            ->toArray();
       // return  $peNames;

       $data = $data->map(function ($item) use ($peNames) {
        $item->relationLoaded('RmuSpendDetail');

        $budgetId = $item->RmuSpendDetail->id_rmu_budget ?? null;
        $item->pe_name = $peNames[$budgetId] ?? null;
        return $item;
    });

        

        //return $data;

        
        return view('payment', compact('data'));
    }
    

    public function UpdatePayment($id,$rmu_id,$pmt_type)
    {
        try{
        RmuAeroSpendModel::find($rmu_id)->update([
            $pmt_type.'_status'=>'work done and payed'
        ]);

        $payment_detail = RmuPaymentDetailModel::find($id);
        // get payment detail recored and check if exist
    if ($payment_detail) {

        $payment_detail->update(['status'=>'work done and payed']);
    }

    $this->PaymentDetailTnb->updatePayments($rmu_id , 'rmu');

    $data = RmuPaymentDetailModel::where('status', 'work done but not payed')->get();
    return response()->json(['success' => true], 200);

        }catch (\Throwable $th) {

            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $data = RmuAeroSpendModel::find($request->p_id);

            if (!$data) {
                return response()->json(['success' => false, 'error' => 'Reqest Falied'], 500);
            }
                $request['rmu_id'] = $request->p_id;
                $vendor=\Auth::user()->project;
                $request['project'] =$vendor;

                $paymentDetail = RmuPaymentDetailModel::create($request->all());
                $this->PaymentDetailTnb->updatePayments($request->p_id , 'rmu');

        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
        return response()->json(['success' => true, 'id' => $data->id_rmu_budget], 200);
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
        //
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

        $res_data = [];
        try {
            $payment_detail = RmuPaymentDetailModel::find($id);
                // get payment detail recored and check if exist
            if ($payment_detail) {

                $payment_detail->update($request->all());
                $this->PaymentDetailTnb->updatePayments($payment_detail->rmu_id , 'rmu');
                $data = RmuAeroSpendModel::find($payment_detail->rmu_id); // get spend table recored
                $nameTotal =$data->total;

            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 500);
            }
            $res_data['sub_total'] = $data->total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;
            $res_data['outstanding'] = $data->outstanding_balance;


            return response()->json(['success' => true, 'id' => $data->id_rmu_budget, 'data' => $res_data], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
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
            $data = RmuPaymentDetailModel::find($id);
            if ($data) {
                $data->delete();
                RmuAeroSpendModel::find($data->rmu_id)->update([
                    $data->pmt_name.'_status'=>'',
                    $data->pmt_name =>0,
                ]);

                $this->PaymentDetailTnb->updatePayments($data->rmu_id , 'rmu');


            } else {
                return  redirect()->back()->with('failed','Request Success');
            }
            return redirect()->back()->with('success','Request Success');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return  redirect()->back()->with('failed','Request Success');
        }
    }


}
