<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcbPaymentDetailModel extends Model
{
    use HasFactory;

    protected $table = "vcb_payment_details";

    protected $fillable = [
        'pmt_name',
        'amount',
        'status',
        'description',
        'vcb_id',
        'pmt_date',
        'vendor_name',


    ];

    public function SpendDetail() {
        return $this->belongsTo(VcbAeroSpendModel::class, 'vcb_id');
    }
}
