<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmuBudgetTNBModel extends Model
{
    use HasFactory;
    protected $table = "rmu_budget_tnb";

    protected $fillable = [
        'pe_name',
        'rtu_status',
        'amt_kkb_pk',
        'cfs',
        'scada',
        'total',
        'allocated_budget',
        'fix_profit',
        'date_time',
        'vendor_name',
    ];

    public function RmuSpends() {
        return $this->hasOne(RmuAeroSpendModel::class, 'id_rmu_budget');
    }


}
