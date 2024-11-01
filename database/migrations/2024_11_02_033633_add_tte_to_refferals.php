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
            $table->unsignedBigInteger('sign_id')->nullable();
            $table->foreign('sign_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string("qr_doc");
            $table->string("sign_name");
            $table->time("sign_time");
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
