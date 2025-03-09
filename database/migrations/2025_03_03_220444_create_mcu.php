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
        // Schema::create('mcu', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('mcu', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->date('date'); // Tanggal upload batch MCU
            $table->unsignedBigInteger('uploaded_by'); // ID pengguna yang mengunggah
            $table->timestamps(); // created_at dan updated_at
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcu');
    }
};
