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
            $table->text('olahraga')->nullable()->after('olah_raga');
            $table->text('paruparu')->nullable()->after('paru_paru');
        });

        // step 2: copy data
        DB::statement('UPDATE mcu_batch SET olahraga = olah_raga');
        DB::statement('UPDATE mcu_batch SET paruparu = paru_paru');

        // step 3: drop old column
        Schema::table('mcu_batch', function (Blueprint $table) {
            $table->dropColumn('olah_raga');
            $table->dropColumn('paru_paru');
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
