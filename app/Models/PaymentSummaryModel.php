<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSummaryModel extends Model
{
    use HasFactory;
    protected $table = "other_payments";


    protected $fillable = [
        'pmt_type',
        'pmt_amount',
        'pmt_receiver_name',
        'date_time',
        'description',

    ];

}
