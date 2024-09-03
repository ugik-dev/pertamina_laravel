<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LiveLocation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name', 'description', 'key_login', 'id_login', 'police_number', 'user_id', 'ref_live_location_id', 'pic_id', 'long', 'lat',
    ];

    public function ref_live_location()
    {
        return $this->belongsTo(RefLiveLocation::class, 'ref_live_location_id');
    }
}
