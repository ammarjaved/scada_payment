<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'unit'];

    public function itemDetail() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
