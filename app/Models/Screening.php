<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doctor_id',
        'temp',
        'hr',
        'diastole',
        'rr',
        'sistole',
        'fitality',
        'spo2',
        'romberg',
        'alcohol',
        'alcohol_level',
        'anamnesis',
        'description',
        'fisik'
    ];
}
