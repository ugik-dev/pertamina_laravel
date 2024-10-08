<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sebuse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kal_val',
        'kal_attch',
        'kal_status',
        'str_val',
        'str_attch',
        'str_status',
        'gym_val',
        'gym_attch',
        'gym_status',
        'mkn_val',
        'mkn_attch',
        'mkn_status',
        'created_at', // Ini harus ditambahkan jika Anda melakukan updateOrCreate berdasarkan tanggal
    ];
}
