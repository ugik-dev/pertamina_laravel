<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcu extends Model
{
    use HasFactory;

    protected $table = 'mcu';

    protected $fillable = [
        'date',
        'uploaded_by',
    ];

    public function batches()
    {
        return $this->hasMany(McuBatch::class, 'mcu_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
