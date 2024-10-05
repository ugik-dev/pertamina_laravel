<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ia_dari',
        'doctor_id',
        'assist_id',
        'form_data',
        'gambar',
        // 'diagnosis',
        // 'ikhtisar',
        // 'pengobatan_diberikan',
        // 'konsultasi_diminta',
        'atas_beban',
        // 'tujuan',
        'relation_desc',
        'no_poli',
        'file_tte',
    ];



    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->select('name', 'id');
    }

    public function assist()
    {
        return $this->belongsTo(User::class, 'assist_id')->select('name', 'id');
    }

    public function drugs()
    {
        return $this->hasMany(RecipeDrug::class, 'recipe_id', 'id')->with('drug');
    }
}
