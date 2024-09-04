<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'upload_by', 'user_id', 'doc_date', 'ref_bank_id', 'file_name'];

    public function ref_bank()
    {
        return $this->belongsTo(RefBank::class, 'ref_bank_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name');;
    }
}
