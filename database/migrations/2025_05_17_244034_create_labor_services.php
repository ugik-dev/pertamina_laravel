<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labor_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('labor_services')->insert([
            ['name' => 'Hitung Jenis Leukosit + Hapusan darah Tepi (Bagi yang terpapar Benzene)'],
            ['name' => 'Jika ada riwayat hepatitis B / HBsAg positif sebelumnya) -> Bila HBsAg Positif dilanjutkan dengan pemeriksaan HBeAg'],
            ['name' => 'Audiometri (Bagi yang terpapar bising)'],
            ['name' => 'Spirometri (Bagi petugas keamanan dan pemadam kebakaran)'],
            ['name' => 'PSA / Tumor Maker Kanker Prostat (Bagi usia >= 40 tahun dengan riwayat pembesaran prostat Atau usia >= 50 tahun)'],
            ['name' => 'USG Mamma, Pap Smear'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labor_services');
    }
};
