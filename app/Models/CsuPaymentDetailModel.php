<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsuPaymentDetailModel extends Model
{
    use HasFactory;
    protected $table = "csu_payment_details";


    protected $fillable = [
        'pmt_name',
        'amount',
        'status',
        'description',
        'csu_id',
        'pmt_date',
        'vendor_name',
    ];

    public function SpendDetail() {
        return $this->belongsTo(CsuAeroSpendModel::class, 'csu_id');
    }
}
