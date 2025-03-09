<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'in_security_id',
        'checkin_time',
        'out_security_id',
        'checkout_time',
        'status',
        'qrcode',
    ];
    protected $table = 'attendances';
    protected $dates = ['checkin_time', 'checkout_time'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi dengan User (untuk security yang melakukan check-in)
     */
    public function inSecurity()
    {
        return $this->belongsTo(User::class, 'in_security_id');
    }

    /**
     * Relasi dengan User (untuk security yang melakukan check-out)
     */
    public function outSecurity()
    {
        return $this->belongsTo(User::class, 'out_security_id');
    }
}
