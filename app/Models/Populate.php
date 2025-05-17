<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Populate extends Model
{
    use HasFactory;

    protected $table = 'populates';

    protected $fillable = [
        'date',
        'uploaded_by',
    ];

    public function batches()
    {
        return $this->hasMany(PopulateBatch::class, 'populate_id');
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
