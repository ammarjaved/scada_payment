<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcbBudgetTNBModel extends Model
{
    use HasFactory;
    protected $table = "vcb_budget_tnb";

    protected $fillable = [
        'pe_name',
        'rtu_status',
        'cfs',
        'scada',
        'total',
        'date_time',
        'allocated_budget',
        'fix_profit',
        'vendor_name',
    ];

    public function VcbSpends() {
        return $this->hasOne(VcbAeroSpendModel::class, 'id_vcb_budget');
    }


}
