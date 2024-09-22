<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteDataCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_data_collections', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pe')->nullable();
            $table->string('sub_station_type')->nullable();
            $table->string('switchgear')->nullable();
            $table->string('switchgear_2')->nullable();
            $table->string('switchgear_compact')->nullable();
            $table->string('type_feeder')->nullable();
            $table->string('switchgear_brand')->nullable();
            $table->string('switchgear_no')->nullable();
            $table->string('label_switch')->nullable();
            $table->string('type_cable')->nullable();
            $table->string('size_cable')->nullable();
            $table->string('tx_rating_1')->nullable();
            $table->string('tx_rating_2')->nullable();
            $table->string('tx_cable_1')->nullable();
            $table->string('tx_cable_2')->nullable();
            $table->string('genset_place')->nullable();
            $table->string('ct_cable')->nullable();
            $table->string('lvdb')->nullable();
            $table->string('type_lvdb')->nullable();
            $table->string('type_fuse')->nullable();
            $table->string('feeder')->nullable();
            $table->string('rating')->nullable();

            // $table->string('depan_pe')->nullable();
            // $table->string('full_switchgear')->nullable();
            // $table->string('full_tx1')->nullable();
            // $table->string('full_tx2')->nullable();
            // $table->string('full_lvdb')->nullable();
            // $table->string('kiri_pe')->nullable();
            // $table->string('plate1')->nullable();
            // $table->string('plate2')->nullable();
            // $table->string('plate3')->nullable();
            // $table->string('plate_lvdb')->nullable();
            // $table->string('kanan_pe')->nullable();
            // $table->string('sisi_kiri')->nullable();
            // $table->string('sisi_cable_kanan1')->nullable();
            // $table->string('sisi_cable_kanan2')->nullable();
            // $table->string('full_feeder')->nullable();
            // $table->string('pintu_pe')->nullable();
            // $table->string('sisi_kanan')->nullable();
            // $table->string('sisi_cable_kiri1')->nullable();
            // $table->string('sisi_cable_kiri2')->nullable();
            // $table->string('tagging')->nullable();
            // $table->string('board_pe')->nullable();
            // $table->string('bawah_nampak_cable')->nullable();
            // $table->string('atas1')->nullable();
            // $table->string('atas2')->nullable();
            // $table->string('full_depan_pe')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_data_collections');
    }
}
