<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PaymentDetail {


    public function updatePayments($id , $name)
    {
            $table_name = $name."_aero_spend";

            $paymentDetails =DB::table($name.'_payment_details')->where($name.'_id', $id)->get();

            $latestPayments = $paymentDetails->groupBy('pmt_name')->map(function ($payments) {
                return $payments->sortByDesc('created_at')->first();
            });

            $updateData = $latestPayments->mapWithKeys(function ($latestPayment, $paymentType) use ($paymentDetails) {
                return [
                    "{$paymentType}" => $paymentDetails->where('pmt_name', $paymentType)->sum('amount'),
                    "{$paymentType}_status" => $latestPayment->status,
                ];
            })->toArray();

            $updateData['total'] = $paymentDetails->whereNotIn('status', ['not work done and  not payed', 'work done but not payed'])->sum('amount');
            $updateData['pending_payment'] = $paymentDetails->where('status', 'not work done and  not payed')->sum('amount');
            $updateData['outstanding_balance'] = $paymentDetails->where('status', 'work done but not payed')->sum('amount');

            DB::table($table_name)->where('id', $id)->update($updateData);
    }

}



?>
