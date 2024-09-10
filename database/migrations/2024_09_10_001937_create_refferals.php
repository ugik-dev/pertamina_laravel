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
        Schema::create('refferals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('assist_id')->nullable();
            $table->foreign('assist_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->json('form_data')->nullable();
            $table->string('gambar')->nullable();
            //PertaminaStart

            $table->text('atas_beban')->nullable();
            $table->text('tujuan')->nullable();
            // request awal
            $table->text('diagnosis')->nullable();
            $table->text('ikhtisar')->nullable();
            $table->text('pengobatan_diberikan')->nullable();
            $table->text('konsultasi_diminta')->nullable();



            // pengkajian_awal
            // $table->text('keluhan_utama')->nullable();
            // $table->text('keluhan_tambahan')->nullable();
            // $table->integer('duration_y')->default(0);
            // $table->integer('duration_m')->default(0);
            // $table->integer('duration_d')->default(0);
            // // skrining_awal
            // $table->text('history_rps')->nullable();
            // $table->text('history_rpd')->nullable();
            // $table->text('history_rpk')->nullable();
            // $table->text('alergi_obat')->nullable();
            // $table->text('alergi_makanan')->nullable();
            // $table->text('alergi_udara')->nullable();
            // $table->text('alergi_lainnya')->nullable();
            // $table->text('kesadaran')->nullable();

            // $table->double('sistole')->nullable();
            // $table->double('diastole')->nullable();
            // $table->double('tinggi')->nullable();
            // $table->string('tinggi_cara')->nullable();
            // $table->double('berat_badan')->nullable();
            // $table->double('lingkar_perut')->nullable();
            // $table->double('nadi')->nullable();
            // $table->double('nafas')->nullable();
            // $table->double('saturasi')->nullable();
            // $table->double('suhu')->nullable();
            // $table->enum('detak_jantung', ['regular', 'iregular']);
            // $table->enum('triage', ['gd', 'd', 'td', 'm']);
            // $table->text('psiko')->nullable();
            // $table->text('keterangan')->nullable();

            // // pemeriksaan fisik
            // $table->text('rencana_tindakan')->nullable();
            // $table->text('tindakan_keperawatan')->nullable();
            // $table->text('observasi')->nullable();
            // $table->enum('merokok', ['Y', 'N'])->default('N');
            // $table->enum('alcohol', ['Y', 'N'])->default('N');
            // $table->enum('kurang_sayur', ['Y', 'N'])->default('N');

            // $table->enum('pemeriksaan_fisik', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_leher', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_kuku', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_dada', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_kepala', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_kardiovaskuler', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_mata', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_abdomen', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_telinga', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_eksterminasi_atas', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_hidung', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_eksterminasi_bawah', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_mulut', ['Y', 'N'])->default('N');
            // $table->enum('pemeriksaan_genitaliad', ['Y', 'N'])->default('N');

            // // riwayat_pengobatan
            // $table->text('obat_steroid')->nullable();
            // $table->text('obat_pengencer_darah')->nullable();
            // $table->text('obat_pengencer_dahak')->nullable();
            // $table->text('obat_penyakit_kronik')->nullable();
            // $table->text('obat_lainnya')->nullable();
            // $table->text('obat_dikonsumsi')->nullable();

            // //PertaminaEnd

            // // data json
            // $table->string('nama_pemanggil')->nullable();
            // $table->string('phone_pemanggil')->nullable();
            // $table->string('nama_pasien')->nullable();
            // $table->string('phone_pasien')->nullable();
            // $table->string('umur')->nullable();
            // $table->string('jamkes')->nullable();
            // $table->string('jenis_kelamin')->nullable();
            // $table->string('sumber_informasi')->nullable();
            // $table->string('lokasi_kejadian')->nullable();
            // $table->string('alamat_rumah')->nullable();
            // $table->date('tanggal')->nullable();
            // $table->string('waktu_panggilan')->nullable();
            // $table->string('waktu_berangkat')->nullable();
            // $table->string('waktu_tkp')->nullable();
            // $table->string('waktu_yankes')->nullable();
            // $table->string('waktu_rujukan')->nullable();
            // $table->string('tempat_rujukan')->nullable();
            // $table->text('keluhan_utama')->nullable();
            // $table->integer('airway_bebas')->nullable()->default(null);
            // $table->integer('airway_tiak_efektif')->nullable()->default(null);
            // $table->integer('airway_benda_asing')->nullable()->default(null);
            // $table->integer('airway_c_spine')->nullable()->default(null);
            // $table->integer('airway_t_bebaskan_jalan_napas')->nullable()->default(null);
            // $table->integer('airway_t_kel_ben')->nullable()->default(null);
            // $table->string('airway_t_kel_ben_val')->nullable();
            // $table->integer('airway_t_fik_man')->nullable()->default(null);
            // $table->string('airway_t_fik_man_val')->nullable();
            // $table->integer('airway_t_col_brance')->nullable()->default(null);
            // $table->integer('airway_t_opa')->nullable()->default(null);
            // $table->integer('airway_t_intubasi')->nullable()->default(null);
            // $table->integer('breathing_andekuat')->nullable()->default(null);
            // $table->string('breathing_val')->nullable();
            // $table->integer('breathing_wheezing')->nullable()->default(null);
            // $table->integer('breathing_stridor')->nullable()->default(null);
            // $table->integer('breathing_apnoe')->nullable()->default(null);
            // $table->string('breathing_t_o2')->nullable();
            // $table->string('breathing_t_o2_val')->nullable();
            // $table->string('breathing_t_satur')->nullable();
            // $table->string('breathing_t_satur_val')->nullable();
            // $table->integer('breathing_t_bvm')->nullable()->default(null);
            // $table->integer('breathing_t_needle_thorac')->nullable()->default(null);
            // $table->integer('breathing_t_thorax_drain')->nullable()->default(null);
            // $table->string('cir_cap_refil')->nullable();
            // $table->string('cir_col_kulit')->nullable();
            // $table->string('cir_kulit')->nullable();
            // $table->string('cir_nadi_tempat')->nullable();
            // $table->string('cir_nadi')->nullable();
            // $table->string('cir_monitor')->nullable();
            // $table->string('cir_ekg')->nullable();
            // $table->string('cir_cpr')->nullable();
            // $table->string('cir_ifvd')->nullable();
            // $table->string('cir_tensi')->nullable();
            // $table->string('cir_balut_tekan')->nullable();
            // $table->string('cir_bebat_tekan')->nullable();
            // $table->string('cir_defibrator')->nullable();
            // $table->string('gcs')->nullable();
            // $table->string('gcs_res_mata')->nullable();
            // $table->string('gcs_res_verbal')->nullable();
            // $table->string('gcs_res_motorik')->nullable();
            // $table->string('gcs_t_posisi')->nullable();
            // $table->string('gcs_t_gds')->nullable();
            // $table->string('gcs_t_chol')->nullable();
            // $table->string('gcs_t_au')->nullable();
            // $table->string('skala_nyeri')->nullable();
            // $table->string('expo')->nullable();
            // $table->string('sec_nipb')->nullable();
            // $table->string('sec_hr')->nullable();
            // $table->string('sec_temp')->nullable();
            // $table->string('sec_rr')->nullable();
            // $table->text('sec_riw_alergi')->nullable();
            // $table->text('sec_riw_makanan')->nullable();
            // $table->text('sec_riw_penyakit_kel')->nullable();
            // $table->text('sec_suspect')->nullable();
            // $table->text('sec_terapi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refferals');
    }
};
