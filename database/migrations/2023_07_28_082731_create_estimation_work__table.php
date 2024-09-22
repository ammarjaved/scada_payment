<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimation_works', function (Blueprint $table) {
            $table->id();
            $table->string('rtu_cable_type')->nullable();
            $table->string('rtu_size_cable')->nullable();
            $table->string('rtu_cable_length')->nullable();
            $table->string('rtu_cable_color')->nullable();
            $table->string('rcb_cable_type')->nullable();
            $table->string('rcb_size_cable')->nullable();
            $table->string('rcb_cable_length')->nullable();
            $table->string('rcb_cable_color')->nullable();
            $table->string('bc_cable_type')->nullable();
            $table->string('bc_size_cable')->nullable();
            $table->string('bc_cable_length')->nullable();
            $table->string('bc_cable_color')->nullable();
            $table->string('efi_cable_type')->nullable();
            $table->string('efi_size_cable')->nullable();
            $table->string('efi_cable_length')->nullable();
            $table->string('efi_cable_color')->nullable();
            $table->string('tranches_work')->nullable();
            $table->string('switchgear_changes')->nullable();
            $table->string('cable_changes')->nullable();
            $table->string('genset_need')->nullable();
            $table->string('cable_tracer_work')->nullable();
            $table->string('special_tools_work')->nullable();
            $table->integer('site_data_id');
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
        Schema::dropIfExists('estimation_works');
    }
};
