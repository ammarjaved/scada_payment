<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
       'item_id',
        'unit',
        'last_unit',
    ];
    
    public function items() {
        return $this->belongsTo(Item::class, 'item_id');
    }
   
}
