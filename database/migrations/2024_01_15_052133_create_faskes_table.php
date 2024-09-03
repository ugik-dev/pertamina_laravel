<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RefJenFaskes;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faskes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(RefJenFaskes::class)->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('logo')->nullable();
            $table->string('alamat');
            $table->string('website');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('cover')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->json('operasional_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faskes');
    }
};
