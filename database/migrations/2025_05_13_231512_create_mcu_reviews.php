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
        Schema::create('mcu_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_batch'); // Foreign key ke tabel mcu
            $table->foreign('id_batch')
                ->references('id')
                ->on('mcu_batch')
                ->onDelete('cascade');
            $table->string('status_derajat_kesehatan')->nullable();
            $table->text('kelaikan_kerja')->nullable();
            $table->text('temuan')->nullable();
            $table->text('saran')->nullable();
            $table->text('hasil_follow_up')->nullable();
            $table->text('nama_dokter_reviewer')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tgl_review')->nullable();
            $table->integer('review_ke')->default(99);
            $table->text('source_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcu_reviews');
    }
};
