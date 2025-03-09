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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('dcu_id')->nullable();
            $table->foreign('dcu_id')
                ->references('id')
                ->on('screenings')
                ->onDelete('cascade');
            $table->unsignedBigInteger('in_security_id')->nullable();
            $table->foreign('in_security_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamp('checkin_time')->nullable();
            $table->unsignedBigInteger('out_security_id')->nullable();
            $table->foreign('out_security_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamp('checkout_time')->nullable();
            $table->string('status')->nullable();
            $table->string('qrcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
