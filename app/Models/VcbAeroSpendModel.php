<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcbAeroSpendModel extends Model
{
    use HasFactory;
    protected $table = "vcb_aero_spend";

    protected $fillable = [
        'amt_bo',
        'amt_bo_status',
        'amt_piw',
        'amt_piw_status',
        'amt_cable',
        'amt_cable_status',
        'amt_transducer',
        'amt_transducer_status',
        'amt_rtu',
        'amt_rtu_status',
        'amt_rtu_cable',
        'amt_rtu_cable_status',
        'amt_tools',
        'amt_tools_status',
        'amt_store_rental',
        'amt_store_rental_status',
        'amt_transport',
        'amt_transport_status',
        'id_vcb_budget',
        'total',
        'pending_payment',
        'outstanding_balance',
    ];

    public function SpendDetail() {
        return $this->hasMany(VcbPaymentDetailModel::class, 'vcb_id');
    }


    public function VcbBudget()
    {
        return $this->belongsTo(VcbBudgetTNBModel::class, 'id_vcb_budget');
    }

}
