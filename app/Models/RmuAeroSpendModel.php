<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmuAeroSpendModel extends Model
{
    use HasFactory;
    protected $table = "rmu_aero_spend";

    protected $fillable = [
        'amt_kkb',
        'amt_kkb_status',
        'amt_ir',
        'amt_ir_status',
        'amt_bo',
        'amt_bo_status',
        'amt_piw',
        'amt_piw_status',
        'amt_cable',
        'amt_cable_status',
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
        'id_rmu_budget',
        'total',
        'allocated_budget',
        'amt_pk',
        'amt_pk_status',
        'pending_payment',
        'outstanding_balance'

    ];

    public function RmuBudget()
    {
        return $this->belongsTo(RmuBudgetTNBModel::class, 'id_rmu_budget');
    }

    public function SpendDetail() {
        return $this->hasMany(RmuPaymentDetailModel::class, 'rmu_id');
    }

}
