<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGuarantor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'guarantor_id',
        'number',
    ];

    public function guarantor()
    {
        return $this->belongsTo(Guarantor::class, 'guarantor_id');
    }
}
