<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'alamat',
        'role_id',
        'unit_id',
        'field_work_id',
        'qrcode',
    ];
    protected $keyLength = 191;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static $rules = [
        'username' => 'required|regex:/^[a-z0-9]+$/|unique:users',
    ];
    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function scopeWithRole($query)
    {
        return $query->select('users.*')->selectRaw('roles.title as role_title')->leftJoin('roles', 'roles.id', '=', 'users.role_id');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function field_work()
    {
        return $this->belongsTo(Field::class, 'field_work_id');
    }
    // Scope untuk mendapatkan screening terbaru hari ini
    public function scopeValidFitality($query)
    {
        return $query->whereHas('screenings', function ($query) {
            $query->whereDate('created_at', Carbon::today())
                ->latest();
        });
    }
}
