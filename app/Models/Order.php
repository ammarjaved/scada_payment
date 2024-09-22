<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','status'];

    public function orderInfo() {
        return $this->hasMany(Order_info::class, 'order_id');
    }

    public function userData() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
