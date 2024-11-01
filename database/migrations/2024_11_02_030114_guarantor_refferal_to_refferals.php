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
            //
            $table->unsignedBigInteger('user_guarantor_id')->nullable();
            $table->foreign('user_guarantor_id')
                ->references('id')
                ->on('user_guarantors')
                ->onDelete('cascade');
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
