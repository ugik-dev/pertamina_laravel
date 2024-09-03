<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_call_id', 'user_id', 'form_data', 'gambar',
        'nama_pemanggil',
        'phone_pemanggil',
        'nama_pasien',
        'phone_pasien',
        'umur',
        'jamkes',
        'jenis_kelamin',
        'sumber_informasi',
        'lokasi_kejadian',
        'alamat_rumah',
        'tanggal',
        'waktu_panggilan',
        'waktu_berangkat',
        'waktu_tkp',
        'waktu_yankes',
        'waktu_rujukan',
        'tempat_rujukan',
        'keluhan_utama',
        'airway_bebas',
        'airway_tiak_efektif',
        'airway_benda_asing',
        'airway_c_spine',
        'airway_t_bebaskan_jalan_napas',
        'airway_t_kel_ben',
        'airway_t_kel_ben_val',
        'airway_t_fik_man',
        'airway_t_fik_man_val',
        'airway_t_col_brance',
        'airway_t_opa',
        'airway_t_intubasi',
        'breathing_andekuat',
        'breathing_val',
        'breathing_wheezing',
        'breathing_stridor',
        'breathing_apnoe',
        'breathing_t_o2',
        'breathing_t_o2_val',
        'breathing_t_satur',
        'breathing_t_satur_val',
        'breathing_t_bvm',
        'breathing_t_needle_thorac',
        'breathing_t_thorax_drain',
        'cir_cap_refil',
        'cir_col_kulit',
        'cir_kulit',
        'cir_nadi_tempat',
        'cir_nadi',
        'cir_monitor',
        'cir_ekg',
        'cir_cpr',
        'cir_ifvd',
        'cir_tensi',
        'cir_balut_tekan',
        'cir_bebat_tekan',
        'cir_defibrator',
        'gcs',
        'gcs_res_mata',
        'gcs_res_verbal',
        'gcs_res_motorik',
        'gcs_t_posisi',
        'gcs_t_gds',
        'gcs_t_chol',
        'gcs_t_au',
        'skala_nyeri',
        'expo',
        'sec_nipb',
        'sec_hr',
        'sec_temp',
        'sec_rr',
        'sec_riw_alergi',
        'sec_riw_makanan',
        'sec_riw_penyakit_kel',
        'sec_suspect',
        'sec_terapi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
