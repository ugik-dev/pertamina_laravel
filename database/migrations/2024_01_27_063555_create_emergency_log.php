<?php

use App\Models\RequestCall;
use App\Models\User;
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
        Schema::create('request_call_logs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId(RequestCall::class)->onDelete('cascade');
            $table->unsignedBigInteger('request_call_id');
            $table->foreign('request_call_id')
                ->references('id')
                ->on('request_calls')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_call_logs');
    }
};
