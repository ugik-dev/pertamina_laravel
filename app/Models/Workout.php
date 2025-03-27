<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workout_jenis',
        'km_tempuh',
        'hours',
        'minutes',
        'seconds',
        'evi_status',
        'evi_attch',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
