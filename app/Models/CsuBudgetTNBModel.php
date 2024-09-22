<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsuBudgetTNBModel extends Model
{
    use HasFactory;
    protected $table = "csu_budget_tnb";

    protected $fillable = [
        'pe_name',
        'kkb',
        'cfs',
        'scada',
        'total',
        'date_time',
        'allocated_budget',
        'fix_profit',
        'vendor_name',

    ];

    public function CsuSpends() {
        return $this->hasOne(CsuAeroSpendModel::class, 'id_csu_budget');
    }

}
