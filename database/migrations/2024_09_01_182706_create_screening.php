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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->double('sistole')->nullable();
            $table->double('diastole')->nullable();
            $table->double('hr')->nullable();
            $table->double('temp')->nullable();
            $table->double('rr')->nullable();
            $table->double('spo2')->nullable();
            $table->double('romberg')->nullable();
            $table->double('alcohol')->nullable();
            $table->double('alcohol_level')->nullable();
            $table->text('anamnesis')->nullable();
            $table->text('description')->nullable();
            $table->enum('fitality', ['Y', 'N']);
            $table->enum('fisik', ['baik', 'umum', 'buruk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screening');
    }
};
