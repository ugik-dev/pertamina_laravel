<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'satuan'];

    public function scopeWithRole($query)
    {
        return $query->select('users.*')->selectRaw('roles.title as role_title')->leftJoin('roles', 'roles.id', '=', 'users.role_id');
    }
}
