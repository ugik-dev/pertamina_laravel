<?php

use App\Models\RefLiveLocation;
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
        Schema::create('live_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RefLiveLocation::class);
            $table->foreignIdFor(User::class)->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('police_number')->nullable()->unique();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->string('id_login', 12)->unique();
            $table->string('key_login')->nullable();
            $table->datetime('last_activity')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_location');
    }
};
