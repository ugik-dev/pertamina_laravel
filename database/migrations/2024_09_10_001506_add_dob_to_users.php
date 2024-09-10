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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->date("dob")->nullable();
            $table->string("rm_number")->nullable();
            $table->string("guarantor_number")->nullable();
            $table->string("empoyee_id")->nullable();
            $table->enum("gender", ["L", "P"])->nullable();
            $table->unsignedBigInteger("guarantor_id")->nullable();
            $table->foreign('guarantor_id')
                ->references('id')
                ->on('guarantors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
