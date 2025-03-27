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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('verif_id')->nullable();
            $table->foreign('verif_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('description')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('minutes')->default(0);
            $table->integer('seconds')->default(0);
            $table->integer('km_tempuh');
            $table->string('workout_jenis')->nullable();
            $table->enum('verif_status', ['Y', 'N'])->default('N');

            $table->string('evi_attch')->nullable();
            $table->enum('evi_status', ['Y', 'N'])->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
