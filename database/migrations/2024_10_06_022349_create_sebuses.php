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
        Schema::create('sebuses', function (Blueprint $table) {
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
            $table->double('tb')->nullable();
            $table->double('bb')->nullable();
            $table->double('fat')->nullable();
            $table->double('pinggang')->nullable();
            $table->double('sistole')->nullable();
            $table->double('diastole')->nullable();
            $table->double('gdp')->nullable();
            $table->double('gd2')->nullable();
            $table->double('col')->nullable();
            $table->double('as_urat')->nullable();
            $table->double('skor')->nullable();
            $table->enum('verif_status', ['Y', 'N'])->default('N');

            $table->double('kal_val')->nullable();
            $table->string('kal_attch')->nullable();
            $table->enum('kal_status', ['Y', 'N'])->default('N');

            $table->string('str_attch')->nullable();
            $table->double('str_val')->nullable();
            $table->enum('str_status', ['Y', 'N'])->default('N');

            $table->string('gym_attch')->nullable();
            $table->double('gym_val')->nullable();
            $table->enum('gym_status', ['Y', 'N'])->default('N');

            $table->string('mkn_attch')->nullable();
            $table->double('mkn_val')->nullable();
            $table->enum('mkn_status', ['Y', 'N'])->default('N');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sebuses');
    }
};
