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
        Schema::table('drugs', function (Blueprint $table) {
            $table->string('kode_oss', 50);
            $table->string('kelas');
            $table->string('sub_kelas');
            $table->string('nama_obat');
            $table->string('pabrik');
            $table->string('pbf');
            $table->string('zat_aktif_utama');
            $table->string('zat_aktif_lain')->nullable();
            $table->string('sediaan');
            $table->integer('isi_perkemasan');
            $table->string('dosis');
            $table->decimal('hna_per_kemasan', 15, 2);
            $table->decimal('hna_satuan', 15, 2);
            $table->decimal('disc', 5, 2);
            $table->decimal('harga_beli_satuan', 15, 2);
            $table->decimal('harga_beli_kemasan', 15, 2);
            $table->string('golongan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drugs', function (Blueprint $table) {
            //
        });
    }
};
