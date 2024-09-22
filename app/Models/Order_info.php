<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_info extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','item','type','unit','item_id'];

    public function orderNo() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function itemDetail() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
