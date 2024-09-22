<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDataCollection extends Model
{
    use HasFactory;

    protected $table = 'tbl_site_survey';


    protected $fillable = ['nama_pe', 'jenis','jenis_perkakasuis',
   'geom' ];


   
    public function estWork() {
        return $this->hasOne(EstimationWork::class, 'site_data_id');
    }

    public function siteImg() {
        return $this->hasMany(SiteImage::class, 'site_data_id');
    }



}
