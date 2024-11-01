<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_oss',
        'kelas',
        'sub_kelas',
        'nama_obat',
        'pabrik',
        'pbf',
        'zat_aktif_utama',
        'zat_aktif_lain',
        'sediaan',
        'isi_perkemasan',
        'dosis',
        'hna_per_kemasan',
        'hna_satuan',
        'disc',
        'harga_beli_satuan',
        'harga_beli_kemasan',
        'golongan'
    ];

    public function scopeWithRole($query)
    {
        return $query->select('users.*')->selectRaw('roles.title as role_title')->leftJoin('roles', 'roles.id', '=', 'users.role_id');
    }
}
