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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_call_id')->nullable();
            $table->foreign('request_call_id')
                ->references('id')
                ->on('request_calls')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->json('form_data')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
            // data json
            $table->string('nama_pemanggil')->nullable();
            $table->string('phone_pemanggil')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('phone_pasien')->nullable();
            $table->string('umur')->nullable();
            $table->string('jamkes')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('sumber_informasi')->nullable();
            $table->string('lokasi_kejadian')->nullable();
            $table->string('alamat_rumah')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('waktu_panggilan')->nullable();
            $table->string('waktu_berangkat')->nullable();
            $table->string('waktu_tkp')->nullable();
            $table->string('waktu_yankes')->nullable();
            $table->string('waktu_rujukan')->nullable();
            $table->string('tempat_rujukan')->nullable();
            $table->text('keluhan_utama')->nullable();
            $table->integer('airway_bebas')->nullable()->default(null);
            $table->integer('airway_tiak_efektif')->nullable()->default(null);
            $table->integer('airway_benda_asing')->nullable()->default(null);
            $table->integer('airway_c_spine')->nullable()->default(null);
            $table->integer('airway_t_bebaskan_jalan_napas')->nullable()->default(null);
            $table->integer('airway_t_kel_ben')->nullable()->default(null);
            $table->string('airway_t_kel_ben_val')->nullable();
            $table->integer('airway_t_fik_man')->nullable()->default(null);
            $table->string('airway_t_fik_man_val')->nullable();
            $table->integer('airway_t_col_brance')->nullable()->default(null);
            $table->integer('airway_t_opa')->nullable()->default(null);
            $table->integer('airway_t_intubasi')->nullable()->default(null);
            $table->integer('breathing_andekuat')->nullable()->default(null);
            $table->string('breathing_val')->nullable();
            $table->integer('breathing_wheezing')->nullable()->default(null);
            $table->integer('breathing_stridor')->nullable()->default(null);
            $table->integer('breathing_apnoe')->nullable()->default(null);
            $table->string('breathing_t_o2')->nullable();
            $table->string('breathing_t_o2_val')->nullable();
            $table->string('breathing_t_satur')->nullable();
            $table->string('breathing_t_satur_val')->nullable();
            $table->integer('breathing_t_bvm')->nullable()->default(null);
            $table->integer('breathing_t_needle_thorac')->nullable()->default(null);
            $table->integer('breathing_t_thorax_drain')->nullable()->default(null);
            $table->string('cir_cap_refil')->nullable();
            $table->string('cir_col_kulit')->nullable();
            $table->string('cir_kulit')->nullable();
            $table->string('cir_nadi_tempat')->nullable();
            $table->string('cir_nadi')->nullable();
            $table->string('cir_monitor')->nullable();
            $table->string('cir_ekg')->nullable();
            $table->string('cir_cpr')->nullable();
            $table->string('cir_ifvd')->nullable();
            $table->string('cir_tensi')->nullable();
            $table->string('cir_balut_tekan')->nullable();
            $table->string('cir_bebat_tekan')->nullable();
            $table->string('cir_defibrator')->nullable();
            $table->string('gcs')->nullable();
            $table->string('gcs_res_mata')->nullable();
            $table->string('gcs_res_verbal')->nullable();
            $table->string('gcs_res_motorik')->nullable();
            $table->string('gcs_t_posisi')->nullable();
            $table->string('gcs_t_gds')->nullable();
            $table->string('gcs_t_chol')->nullable();
            $table->string('gcs_t_au')->nullable();
            $table->string('skala_nyeri')->nullable();
            $table->string('expo')->nullable();
            $table->string('sec_nipb')->nullable();
            $table->string('sec_hr')->nullable();
            $table->string('sec_temp')->nullable();
            $table->string('sec_rr')->nullable();
            $table->text('sec_riw_alergi')->nullable();
            $table->text('sec_riw_makanan')->nullable();
            $table->text('sec_riw_penyakit_kel')->nullable();
            $table->text('sec_suspect')->nullable();
            $table->text('sec_terapi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
