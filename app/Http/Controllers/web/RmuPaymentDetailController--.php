<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuPaymentDetailModel;
use App\Models\RmuAeroSpendModel;

class RmuPaymentDetailController extends Controller
{
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
        //
        try {
            $data = RmuAeroSpendModel::find($request->id);
            if ($data) {

                switch ($request->status) {
                    case 'work done but not payed':
                        // in this case only update pending value total and outstanding_balance value will remain same;
                        $data->outstanding_balance = $data->outstanding_balance + $request->amount;

                        break;

                    case 'not work done and  not payed':
                        // in this case only update outstanding_balance value total and pending value will remain same;
                        $data->pending_payment = $data->pending_payment + $request->amount;
                        break;

                    default:
                        // in default total value will update and pending and out stating remian same
                        $data->total = $data->total + $request->amount;
                        break;
                }


                $name = $request->pmt_name;  // get name column name from request for update column value
                $nameTotal = $data->$name + $request->amount;  // update value
                $mystatus=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status'; // for update status

                $data->update([
                    'total' =>  $data->total,
                    $name => $nameTotal,
                    $mystatus => $request->status,
                    'pending_payment' => $data->pending_payment,
                    'outstanding_balance'=>$data->outstanding_balance,
                ]);   // update spend table

                RmuPaymentDetailModel::create([
                    'pmt_name' => $request->pmt_name,
                    'amount' => $request->amount,
                    'status' => $request->status,
                    'description' => $request->description,
                    'rmu_id' => $request->id,
                    'pmt_date' => $request->pmt_date,
                    'vendor_name' =>$request->vendor_name,
                ]); // update payment detail table
            }
            return response()->json(['success' => true, 'id' => $data->id_rmu_budget], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 200);
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

                $data = RmuAeroSpendModel::find($payment_detail->rmu_id); // get spend table recored



                $oldVal = $payment_detail->amount;

                $name = $payment_detail->pmt_name;   // from payment detail table getting spend clomun name where column total value will save

                $nameTotal = $data->$name + $request->amount - $payment_detail->amount;  // calulate column total value
                                                                                        // (column total value  spend table + column comming value - column old value from payment detail  )



                switch ($request->status) {
                    // Case 1:   request   is 'work done but not paid'
                    case  'work done but not payed' :
                            if ($payment_detail->status == 'work done but not payed') {
                                // old value status is same as case update outstanding_balance spendTable  (otustanding_blance spendTable + comming amount - oldValue paymentDetail Table)
                                $data->outstanding_balance = $data->outstanding_balance + $request->amount - $oldVal;

                            }elseif($payment_detail->status == 'not work done and  not payed'){
                                //update otustanding_blance (otustanding_blance spendTable   - oldValue paymentDetail Table)
                                //update total pending_payment ( pending_payment spendTable + comming amount)

                                $data->pending_payment = $data->pending_payment + $request->amount ;
                                $data->outstanding_balance = $data->outstanding_balance  - $oldVal;

                            }else{
                                //update otustanding_blance (otustanding_blance spendTable   - oldValue paymentDetail Table)
                                //update total  ( total spendTable + comming amount)

                                $data->outstanding_balance = $data->outstanding_balance -  $oldVal ;
                                $data->total = $data->total + $request->amount;
                            }
                            // return "123123213";
                        break;

                        // Case 2: Only request is 'not work done  not paid'
                    case 'not work done and  not payed':
                        if ($payment_detail->status == 'not work done and  not payed') {
                            //  update pending_payment spendTable  (pending_payment spendTable + comming amount - oldValue paymentDetail Table)
                            $data->pending_payment = $data->pending_payment + $request->amount - $oldVal;

                        }elseif($payment_detail->status == 'work done but not payed'){
                            //update otustanding_blance (otustanding_blance spendTable  +  comming amount)
                            //update total pending_payment ( pending_payment spendTable - oldValue paymentDetail Table)

                            $data->pending_payment = $data->pending_payment  -  $oldVal;
                            $data->outstanding_balance = $data->outstanding_balance + $request->amount;

                        }else{
                            //update pending_payment (pending_payment spendTable   - oldValue paymentDetail Table)
                            //update total  ( total spendTable + comming amount)

                            $data->pending_payment = $data->pending_payment -  $oldVal ;
                            $data->total = $data->total + $request->amount;
                        }
                        // return "seconda";
                        break;

                        // case 1 and case is false:
                    default:
                        if ($payment_detail->status == 'not work done and  not payed') {
                            //update pending_payment (pending_payment spendTable   + comming amount)
                            //update total  ( total spendTable - oldValue paymentDetail Table)

                            $data->pending_payment = $data->pending_payment + $request->amount  ;
                            $data->total = $data->total -  $oldVal;

                        }elseif($payment_detail->status == 'work done but not payed'){
                            //update otustanding_blance (otustanding_blance spendTable   + oldValue paymentDetail Table)
                            //update total outstanding_balance ( outstanding_balance spendTable + comming amount)

                            $data->total = $data->total  - $oldVal;
                            $data->outstanding_balance = $data->outstanding_balance + $request->amount ;

                        }else{
                            //update pending_payment (pending_payment spendTable   - oldValue paymentDetail Table- oldValue paymentDetail Table)
                            //update total  ( total spendTable + comming amount - oldValue paymentDetail Table)
                            $data->total = $data->total + $request->amount - $oldVal;
                    }
                    break;
                }


                $mystatus=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status';  // for update status getting status column name by payment detail pmt_name column concatinate '_status'


                // if this receored is latest then alse update status in payment detail column
                $latestRecord = RmuPaymentDetailModel::where('rmu_id' ,$data->id)->where('pmt_name' , $payment_detail-> pmt_name)->latest('created_at')->first();
                $status = $request->status;
                if ($latestRecord && $payment_detail->created_at != $latestRecord->created_at) {

                        $status = $data->$mystatus;
                }


                $data->update([
                    'total' => $data->total,
                    $name => $nameTotal,
                    $mystatus => $status,
                    'pending_payment' => $data->pending_payment
                ]); // update Spend Table

                $payment_detail->update([
                    'amount' => $request->amount,
                    'status' => $request->status,
                    'description' => $request->description,
                    'pmt_date' => $request->pmt_date,
                    'outstanding_balance'=>$data->outstanding_balance,
                ]);  // update payment detail Table
            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 200);
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
        $res_data = [];
        try {
            $data = RmuPaymentDetailModel::find($id);
            if ($data) {
                $dataVcb = RmuAeroSpendModel::find($data->rmu_id);

                $created_at = $data->created_at ;
                if ($data->status == 'work done but not payed') {

                    $dataVcb->outstanding_balance = $dataVcb->outstanding_balance - $data->amount;

                } elseif($data->status == 'not work done and  not payed') {

                    $dataVcb->pending_payment = $dataVcb->pending_payment - $data->amount;

                }else{
                    $dataVcb->total = $dataVcb->total - $data->amount;

                }

                $name = $data->pmt_name;
                $stat_name=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status';

                $nameTotal = $dataVcb->$name - $data->amount;

                $stat = '';
                $latestRecord = RmuPaymentDetailModel::where('rmu_id' ,$dataVcb->id)->where('pmt_name' , $data-> pmt_name)->latest('created_at')->first();

                $data->delete();
                // $status = RmuPaymentDetailModel::where('rmu_id' ,$dataVcb->id)->latest()->first();
                $stat = '';
               if ($latestRecord && $created_at == $latestRecord->created_at) {
                // return "inside if";
                $status = RmuPaymentDetailModel::where('rmu_id' ,$dataVcb->id)->where('pmt_name' , $data-> pmt_name)->latest()->first();
                if ($status) {

                    $stat = $status->status;
                }
                }else{
                    $stat = $dataVcb->$stat_name ;
                    // return $stat;
                }
            // return $nameTotal;
                $dataVcb->update([
                    'total' => $dataVcb->total,
                    $name => $nameTotal,
                    'pending_payment' => $dataVcb->pending_payment,
                    $stat_name => $stat,
                    'outstanding_balance'=> $dataVcb->outstanding_balance,
                ]);

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
