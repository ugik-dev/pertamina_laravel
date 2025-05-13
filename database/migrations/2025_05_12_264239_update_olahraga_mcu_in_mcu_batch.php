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
            $table->text('kesimpulan_1')->nullable()->after('kesimpulan1');
            $table->text('kesimpulan_2')->nullable()->after('kesimpulan2');
            $table->text('kesimpulan_3')->nullable()->after('kesimpulan3');
            $table->text('nasehat_1')->nullable()->after('nasehat1');
            $table->text('nasehat_2')->nullable()->after('nasehat2');
            $table->text('diet_1')->nullable()->after('diet1');
            $table->text('diet_2')->nullable()->after('diet2');
            $table->text('diet_3')->nullable()->after('diet3');
            $table->text('saran_1')->nullable()->after('saran1');
            $table->text('saran_2')->nullable()->after('saran2');
            $table->text('saran_3')->nullable()->after('saran3');
        });

        // Copy data
        DB::statement('UPDATE mcu_batch SET kesimpulan_1 = kesimpulan1');
        DB::statement('UPDATE mcu_batch SET kesimpulan_2 = kesimpulan2');
        DB::statement('UPDATE mcu_batch SET kesimpulan_3 = kesimpulan3');
        DB::statement('UPDATE mcu_batch SET nasehat_1 = nasehat1');
        DB::statement('UPDATE mcu_batch SET nasehat_2 = nasehat2');
        DB::statement('UPDATE mcu_batch SET diet_1 = diet1');
        DB::statement('UPDATE mcu_batch SET diet_2 = diet2');
        DB::statement('UPDATE mcu_batch SET diet_3 = diet3');
        DB::statement('UPDATE mcu_batch SET saran_1 = saran1');
        DB::statement('UPDATE mcu_batch SET saran_2 = saran2');
        DB::statement('UPDATE mcu_batch SET saran_3 = saran3');

        // Drop old columns
        Schema::table('mcu_batch', function (Blueprint $table) {
            $table->dropColumn([
                'kesimpulan1',
                'kesimpulan2',
                'kesimpulan3',
                'nasehat1',
                'nasehat2',
                'diet1',
                'diet2',
                'diet3',
                'saran1',
                'saran2',
                'saran3'
            ]);
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
