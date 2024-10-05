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
        Schema::create('recipe_drugs', function (Blueprint $table) {
            $table->id();
            $table->string('signatura');
            $table->integer('drug_qyt');
            $table->integer('drug_number');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')
                ->references('id')
                ->on('recipes')
                ->onDelete('cascade');
            $table->unsignedBigInteger('drug_id')->nullable();
            $table->foreign('drug_id')
                ->references('id')
                ->on('drugs')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_drugs');
    }
};
