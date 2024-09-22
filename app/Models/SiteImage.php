<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    use HasFactory;

    protected $fillable = [

        'site_data_id' , 'status', 'full_switchgear', 'full_tx1', 'full_tx2', 'full_lvdb', 'kiri_pe',  'plate1', 'plate2', 'plate3', 'plate_lvdb', 'kanan_pe', 'sisi_kiri', 'sisi_cable_kanan1', 'sisi_cable_kanan2', 'full_feeder', 'pintu_pe', 'sisi_kanan', 'sisi_cable_kiri1', 'sisi_cable_kiri2', 'tagging', 'board_pe', 'bawah_nampak_cable', 'atas1', 'atas2', 'full_depan_pe', 'depan_pe'
    ];

    public function siteData()
    {
        return $this->belongsTo(SiteDataCollection::class, 'site_data_id');
    }
}
