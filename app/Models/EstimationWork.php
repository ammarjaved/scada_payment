<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'rtu_cable_type',
        'rtu_size_cable',
        'rtu_cable_length',
        'rcb_cable_color',
        'rcb_cable_type',
        'rcb_size_cable',
        'rcb_cable_length',
        'rcb_cable_color',
        'bc_cable_type',
        'bc_size_cable',
        'bc_cable_length',
        'bc_cable_color',
        'efi_cable_type',
        'efi_size_cable',
        'efi_cable_length',
        'efi_cable_color',
        'tranches_work',
        'switchgear_changes',
        'cable_changes',
        'genset_need',
        'cable_tracer_work',
        'special_tools_work',
        'site_data_id',
    ];

    public function siteData()
    {
        return $this->belongsTo(SiteDataCollection::class, 'site_data_id');
    }
}
