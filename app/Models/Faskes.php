<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'alamat', 'logo', 'user_id', 'ref_jen_faskes_id', 'website', 'phone', 'whatsapp', 'pic_id', 'cover', 'long', 'lat', 'operasional_time'
    ];

    public function jen_faskes()
    {
        return $this->belongsTo(RefJenFaskes::class, 'ref_jen_faskes_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class);
    }
}
