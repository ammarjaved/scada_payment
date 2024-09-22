<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['item', 'type', 'units'];

    public function allRecords()
    {
        return $this->hasMany(Requisition::class, 'item_id');
    }

    public function orderDetail()
    {
        return $this->hasMany(Order_info::class, 'item_id');
    }

}
