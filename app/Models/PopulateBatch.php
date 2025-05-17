<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulateBatch extends Model
{
    use HasFactory;
    protected $table = 'populate_batches';
    protected $fillable = [
        'populate_id',
        'id_position',
        'prl_bs_home',
        'person_id',
        'pers_no',
        'name',
        'tgl_lahir',
        'agama',
        'status',
        'status_pekerja',
        'departemen',
        'position',
        'personnel_subarea_name',
        'sub_area_large',
        'fungsi',
        'divisi',
        'sub_division',
        'section',
        'no_hp',
        'email',
    ];

    public function populate()
    {
        return $this->belongsTo(Populate::class, 'populate_id');
    }
}
