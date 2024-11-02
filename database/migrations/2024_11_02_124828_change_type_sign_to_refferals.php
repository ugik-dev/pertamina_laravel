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
            $table->string('qr_doc')->nullable()->change();
            $table->string('sign_name')->nullable()->change();
            $table->time('sign_time')->nullable()->change();
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
