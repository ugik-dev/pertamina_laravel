<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCallLog extends Model
{
    use HasFactory;
    protected $fillable = ['request_call_id', 'user_id', 'action'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
