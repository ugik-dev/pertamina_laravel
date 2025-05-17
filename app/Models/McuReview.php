<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McuReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_batch',
        'status_derajat_kesehatan',
        'kelaikan_kerja',
        'temuan',
        'saran',
        'hasil_follow_up',
        'nama_dokter_reviewer',
        'keterangan',
        'tgl_review',
        'source_data',
        'review_ke',
        'status',
        'labor_id',
        'date_start',
        'date_end',
        'labor_service_ids',
        'svc_lainnya',
    ];

    public function batch()
    {
        return $this->hasOne(McuBatch::class, 'id', 'id_batch');
    }
    public function labor()
    {
        return $this->hasOne(Labor::class, 'id', 'labor_id');
    }
}
