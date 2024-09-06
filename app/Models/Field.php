<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    public $table = 'field_works';

    protected $fillable = [
        'name',
        'high_risk'
    ];
}
