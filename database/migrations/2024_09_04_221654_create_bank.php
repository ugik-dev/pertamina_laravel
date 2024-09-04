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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ref_bank_id');
            $table->foreign('ref_bank_id')
                ->references('id')
                ->on('ref_banks')
                ->onDelete('cascade');
            $table->unsignedBigInteger('upload_by');
            $table->foreign('upload_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('description');
            $table->date('doc_date');
            $table->string('filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank');
    }
};
