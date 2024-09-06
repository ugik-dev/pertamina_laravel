<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            $table->enum('romberg_temp', ['Y', 'N'])->default('N');
            $table->enum('alcohol_temp', ['Y', 'N'])->default('N');
        });

        // DB::table('screenings')->update([
        //     'romberg_temp' => DB::raw("IF(romberg = 1, 'Y', 'N')"),
        //     'alcohol_temp' => DB::raw("IF(alcohol = 1, 'Y', 'N')")
        // ]);

        Schema::table('screenings', function (Blueprint $table) {
            $table->dropColumn('romberg');
            $table->dropColumn('alcohol');
            // $table->renameColumn('romberg_temp', 'romberg');
            // $table->renameColumn('alcohol_temp', 'alcohol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            //
        });
    }
};
