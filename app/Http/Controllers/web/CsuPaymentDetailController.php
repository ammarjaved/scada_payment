<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuPaymentDetailModel;
use Exception;
use App\Models\CsuAeroSpendModel;
use App\Repositories\PaymentDetail;



class CsuPaymentDetailController extends Controller
{


    protected $PaymentDetailTnb;

    public function __construct(PaymentDetail $PaymentDetailTnb)
    {
        $this->PaymentDetailTnb = $PaymentDetailTnb;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $data = CsuAeroSpendModel::find($request->p_id);

            if (!$data) {
                return response()->json(['success' => false, 'error' => 'Reqest Falied'], 500);
            }
                $request['csu_id'] = $request->p_id;
                $paymentDetail = CsuPaymentDetailModel::create($request->all());
                $this->PaymentDetailTnb->updatePayments($request->p_id , 'csu');

        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
        return response()->json(['success' => true, 'id' => $data->id_csu_budget], 200);
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


        $res_data = [];
        try {
            $payment_detail = CsuPaymentDetailModel::find($id);
                // get payment detail recored and check if exist
            if ($payment_detail) {

                $payment_detail->update($request->all());
                $this->PaymentDetailTnb->updatePayments($payment_detail->csu_id , 'csu');


                $data = CsuAeroSpendModel::find($payment_detail->csu_id); // get spend table recored
                $nameTotal =$data->total;

            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 200);
            }
            $res_data['sub_total'] = $data->total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;
            $res_data['outstanding'] = $data->outstanding_balance;


            return response()->json(['success' => true, 'id' => $data->id_csu_budget, 'data' => $res_data], 200);
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
            $data = CsuPaymentDetailModel::find($id);
            if ($data) {
                $data->delete();
                CsuAeroSpendModel::find($data->csu_id)->update([
                    $data->pmt_name.'_status'=>'',
                    $data->pmt_name =>0,
                ]);

                $this->PaymentDetailTnb->updatePayments($data->csu_id , 'csu');

            } else {
                return  redirect()->back()->with('failed','Request Failed');
            }
            return redirect()->back()->with('success','Request Success');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return  redirect()->back()->with('failed','Request Failed');
        }
    }


}
