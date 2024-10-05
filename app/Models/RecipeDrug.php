<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDrug extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id',
        'drug_id',
        'signatura',
        'drug_qyt',
        'drug_number'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
}
