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
        // Schema::create('mcu_batch', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('mcu_batch', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('mcu_id'); // Foreign key ke tabel mcu
            $table->string('nama')->nullable();
            $table->string('nopek')->nullable();
            $table->string('no_rm')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('tahun_mcu')->nullable();
            $table->date('tgl_mcu')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->text('alamat')->nullable();
            $table->text('uraian_singkat_pekerjaan')->nullable();
            $table->text('hazard_risiko_lingkungan_kerja')->nullable();
            $table->text('keluhan_umum')->nullable();
            $table->string('kesadaran')->nullable();
            $table->string('status_mentalis')->nullable();
            $table->string('status_psikologis_srq29')->nullable();
            $table->text('keluhan_berhubungan_dengan_pekerjaan')->nullable();
            $table->text('riwayat_penyakit_dahulu')->nullable();
            $table->text('riwayat_penyakit_keluarga')->nullable();
            $table->text('riwayat_kecelakaan')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->text('riwayat_vaksinasi')->nullable();
            $table->text('riwayat_obs_gyn')->nullable();
            $table->text('riwayat_operasi')->nullable();
            $table->text('diet')->nullable();
            $table->text('konsumsi_buah_sayur')->nullable();
            $table->text('olah_raga')->nullable();
            $table->string('merokok')->nullable();
            $table->string('kopi')->nullable();
            $table->string('alkohol')->nullable();
            $table->text('obat_rutin')->nullable();
            $table->integer('td_sistole')->nullable();
            $table->integer('td_diastole')->nullable();
            $table->integer('nadi')->nullable();
            $table->string('irama_nadi')->nullable();
            $table->integer('pernafasan')->nullable();
            $table->string('suhu_badan')->nullable();
            $table->string('tb')->nullable();
            $table->string('bb')->nullable();
            $table->string('lp_lingkar_pinggang')->nullable();
            $table->string('bmi')->nullable();
            $table->string('status_gizi')->nullable();
            $table->string('avod')->nullable();
            $table->string('avos')->nullable();
            $table->string('add_koreksi_visus')->nullable();
            $table->string('tekanan_bola_mata')->nullable();
            $table->text('funduscopy')->nullable();
            $table->string('buta_warna')->nullable();
            $table->text('kepala')->nullable();
            $table->text('leher')->nullable();
            $table->text('mulut')->nullable();
            $table->text('tonsil')->nullable();
            $table->text('pharynx')->nullable();
            $table->text('jantung')->nullable();
            $table->text('paru_paru')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('hepar')->nullable();
            $table->text('lien')->nullable();
            $table->text('ginjal')->nullable();
            $table->text('extremitas')->nullable();
            $table->text('reflek_fisiologis')->nullable();
            $table->text('reflek_patologis')->nullable();
            $table->text('kulit')->nullable();
            $table->text('haemorhoid')->nullable();
            $table->text('tulang_belakang')->nullable();
            $table->text('lain_lain')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('ekg')->nullable();
            $table->text('pap_smear')->nullable();
            $table->text('treadmill_test')->nullable();
            $table->string('status_kebugaran')->nullable();
            $table->integer('target_nadi_olahraga')->nullable();
            $table->text('test_rockport')->nullable();
            $table->text('napfa')->nullable();
            $table->text('spirometri')->nullable();
            $table->text('audiometri')->nullable();
            $table->text('mammografi')->nullable();
            $table->text('usg_abdomen')->nullable();
            $table->text('biological_monitoring')->nullable();
            $table->text('toraks_foto')->nullable();
            $table->text('mata')->nullable();
            $table->text('tht')->nullable();
            $table->text('d')->nullable();
            $table->text('m')->nullable();
            $table->text('f')->nullable();
            $table->text('advice_gimul')->nullable();
            $table->string('hb')->nullable();
            $table->string('leukosit')->nullable();
            $table->string('eritrosit')->nullable();
            $table->string('hematokrit')->nullable();
            $table->string('trombosit')->nullable();
            $table->string('led')->nullable();
            $table->string('basofil')->nullable();
            $table->string('eosinofil')->nullable();
            $table->string('batang')->nullable();
            $table->string('segmen')->nullable();
            $table->string('limfosit')->nullable();
            $table->string('monosit')->nullable();
            $table->text('hapusan_darah')->nullable();
            $table->string('warna_urine')->nullable();
            $table->string('berat_jenis')->nullable();
            $table->string('ph_urine')->nullable();
            $table->string('protein')->nullable();
            $table->string('nitrit')->nullable();
            $table->string('reduksi_n')->nullable();
            $table->string('reduksi_pp')->nullable();
            $table->string('aseton_urin')->nullable();
            $table->string('bilirubin')->nullable();
            $table->string('urobilinogen')->nullable();
            $table->string('leukosit_esterase')->nullable();
            $table->text('sel_epithel')->nullable();
            $table->text('leukosit_urine')->nullable();
            $table->text('eritrosit_urine')->nullable();
            $table->text('silinder')->nullable();
            $table->text('bakteri')->nullable();
            $table->text('jamur')->nullable();
            $table->text('kristal')->nullable();
            $table->string('konsistensi')->nullable();
            $table->string('warna_faeces')->nullable();
            $table->text('lendir')->nullable();
            $table->text('darah_nanah')->nullable();
            $table->text('eritrosit_faeces')->nullable();
            $table->text('leukosit_faeces')->nullable();
            $table->text('amuba_protozoa')->nullable();
            $table->text('kista')->nullable();
            $table->text('sisa_pencernaan')->nullable();
            $table->text('telor_cacing')->nullable();
            $table->text('kultur_faeces')->nullable();
            $table->string('gula_darah_puasa')->nullable();
            $table->string('gula_darah_2jam_pp')->nullable();
            $table->string('hba1c')->nullable();
            $table->string('kolesterol_total')->nullable();
            $table->string('trigliserida')->nullable();
            $table->string('hdl')->nullable();
            $table->string('ldl')->nullable();
            $table->string('rasio_tc_hdl')->nullable();
            $table->string('ureum')->nullable();
            $table->string('kreatinin')->nullable();
            $table->string('asam_urat')->nullable();
            $table->string('sgot')->nullable();
            $table->string('sgpt')->nullable();
            $table->string('bill_total')->nullable();
            $table->string('bili_direct')->nullable();
            $table->string('bili_indirect')->nullable();
            $table->string('alk_fospat')->nullable();
            $table->string('kolinesterase')->nullable();
            $table->string('hbsag')->nullable();
            $table->string('anti_hbs')->nullable();
            $table->string('hbeag')->nullable();
            $table->string('anti_hcv')->nullable();
            $table->string('tpha')->nullable();
            $table->string('vdrl')->nullable();
            $table->text('bta_sputum')->nullable();
            $table->text('drug_test')->nullable();
            $table->text('alcohol_test')->nullable();
            $table->text('kesimpulan_derajat_kesehatan')->nullable();
            $table->text('kesimpulan_kelaikan_kerja')->nullable();
            $table->text('risiko_cardiovascular_skj')->nullable();
            $table->text('risiko_cardiovascular_sf')->nullable();
            $table->text('saran_dokter')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('dokter')->nullable();
            $table->text('anamnesa_mata')->nullable();
            $table->text('penglihatan')->nullable();
            $table->text('test_ishihara')->nullable();
            $table->text('kesimpulan_mata')->nullable();
            $table->text('saran_mata')->nullable();
            $table->text('anamnesa_tht')->nullable();
            $table->text('telinga')->nullable();
            $table->text('hidung')->nullable();
            $table->text('tenggorokan')->nullable();
            $table->text('kesimpulan_tht')->nullable();
            $table->text('saran_tht')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('kesimpulan1')->nullable();
            $table->text('kesimpulan2')->nullable();
            $table->text('kesimpulan3')->nullable();
            $table->text('nasehat1')->nullable();
            $table->text('nasehat2')->nullable();
            $table->text('diet1')->nullable();
            $table->text('diet2')->nullable();
            $table->text('diet3')->nullable();
            $table->text('nasehat_lain')->nullable();
            $table->text('saran1')->nullable();
            $table->text('saran2')->nullable();
            $table->text('saran3')->nullable();
            $table->timestamps(); // created_at dan updated_at

            // Foreign key ke tabel mcu
            $table->foreign('mcu_id')->references('id')->on('mcu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcu_batch');
    }
};
