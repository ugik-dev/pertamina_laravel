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
        Schema::table('refferals', function (Blueprint $table) {
            $table->string('ia_dari')->nullable();
            $table->string('no_poli')->nullable();
            $table->string('relation_desc')->default("Pekerja");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refferals', function (Blueprint $table) {
            //
        });
    }
};
