<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsuAeroSpendModel extends Model
{
    use HasFactory;
    protected $table = "csu_aero_spend";

    protected $fillable = [
        'amt_kkb',
        'amt_kkb_status',
        'amt_cfs',
        'amt_cfs_status',
        'amt_bo',
        'amt_bo_status',
        'amt_rtu',
        'amt_rtu_status',
        'amt_tools',
        'amt_tools_status',
        'amt_store_rental',
        'amt_store_rental_status',
        'amt_transport',
        'amt_transport_status',
        'amt_salary',
        'amt_salary_status',
        'id_csu_budget',
        'total',
        'pending_payment',
        'outstanding_balance'

    ];

    public function SpendDetail() {
        return $this->hasMany(CsuPaymentDetailModel::class, 'csu_id');
    }


    public function CsuBudget()
    {
        return $this->belongsTo(CsuBudgetTNBModel::class, 'id_csu_budget');
    }
}
