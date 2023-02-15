<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected $fillable = [
        'nama',
        'uuid',
        'email',
        'password',
        'level',
        'verifikasi_pada'
    ];
    protected $hidden = [
        'password',
        'level',
        'remember_token',
    ];
    protected $casts = [
        'verifikasi_pada' => 'datetime',
    ];
    public function member()
    {
        return $this->hasOne(Member::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }
}
