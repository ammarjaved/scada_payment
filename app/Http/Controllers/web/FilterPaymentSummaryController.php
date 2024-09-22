<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSummaryModel;

class FilterPaymentSummaryController extends Controller
{
    //
    public function index(Request $request)
    {
         $type =  $request->search_type;
        $from = $request->from_search == "" ? PaymentSummaryModel::min('date_time') : $request->from_search;
        $to = $request->to_search == "" ? PaymentSummaryModel::max('date_time') : $request->to_search;

        $data = PaymentSummaryModel::where('pmt_type' , 'LIKE', '%' . $type . '%')->where('date_time' ,'>=' ,$from)->where('date_time' , '<=' , $to )->get();
        return view('PaymentSummary.payment-table',['datas'=>$data])->render();

    }
}
