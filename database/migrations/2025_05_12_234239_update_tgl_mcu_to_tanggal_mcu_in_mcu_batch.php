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
        Schema::table('mcu_batch', function (Blueprint $table) {
            $table->date('tanggal_mcu')->nullable()->after('tgl_mcu'); // step 1
        });

        // step 2: copy data
        DB::statement('UPDATE mcu_batch SET tanggal_mcu = tgl_mcu');

        // step 3: drop old column
        Schema::table('mcu_batch', function (Blueprint $table) {
            $table->dropColumn('tgl_mcu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mcu_batch', function (Blueprint $table) {
            //
        });
    }
};
