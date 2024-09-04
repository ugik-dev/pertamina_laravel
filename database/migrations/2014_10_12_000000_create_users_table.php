<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default('5');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('qrcode')->unique();
            $table->string('alamat')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->integer('status')->default('1');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username', 120)->unique()->nullable()->default(null);
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::statement("ALTER TABLE users MODIFY COLUMN username VARCHAR(255) NOT NULL, ADD CONSTRAINT username_format CHECK (username REGEXP '^[a-z0-9]+$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
