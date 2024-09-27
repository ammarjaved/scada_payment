<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmuPaymentDetailModel extends Model
{
    use HasFactory;
    protected $table = "rmu_payment_details";

    protected $fillable = [
        'pmt_name',
        'amount',
        'status',
        'description',
        'rmu_id',
        'pmt_date',
        'vendor_name',
        'bo_type',
        'project'


    ];

    public function RmuSpendDetail() {
        return $this->belongsTo(RmuAeroSpendModel::class, 'rmu_id');
    }
}
