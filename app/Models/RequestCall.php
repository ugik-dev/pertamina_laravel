<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCall extends Model
{
    use HasFactory;
    protected $fillable = ['ref_emergency_id', 'long', 'lat', 'login_session_id'];

    public function ref_emergency()
    {
        return $this->belongsTo(RefEmergency::class);
    }

    public function login_session()
    {
        return $this->belongsTo(LoginSession::class);
    }

    public function logs()
    {
        return $this->hasMany(RequestCallLog::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
