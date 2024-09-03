<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginSession extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    public $table = 'login_session';
    protected $fillable = ['name', 'phone'];
}
