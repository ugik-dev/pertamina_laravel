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
        Schema::table('mcu_reviews', function (Blueprint $table) {
            $table->enum('status', ['approved_pengantar', 'draft_pengantar', 'approve', 'reject', 'excel'])->nullable();
            $table->unsignedBigInteger('labor_id')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('labor_service_ids')->nullable();
            $table->text('svc_lainnya')->nullable();
            $table->foreign('labor_id')->references('id')->on('labors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mcu_reviews', function (Blueprint $table) {
            //
        });
    }
};
