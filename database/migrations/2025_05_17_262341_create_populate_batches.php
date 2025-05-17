<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('populate_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('populate_id');
            $table->bigInteger('id_position')->nullable();
            $table->bigInteger('person_id'); //NOPEG
            $table->integer('pers_no'); // redundan, tapi kalau perlu simpan dua duanya
            $table->string('name');
            $table->date('tgl_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('status')->nullable();
            $table->string('status_pekerja')->nullable();
            $table->string('departemen')->nullable();
            $table->string('position')->nullable();
            $table->string('personnel_subarea_name')->nullable();
            $table->string('sub_area_large')->nullable();
            $table->string('fungsi')->nullable();
            $table->string('divisi')->nullable();
            $table->string('sub_division')->nullable();
            $table->string('section')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->integer('prl_bs_home')->nullable(); // tipe sesuai kebutuhan, sementara string
            $table->timestamps();

            $table->foreign('populate_id')->references('id')->on('populates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populate_batches');
    }
};
