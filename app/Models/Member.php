<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function memberHasWeightClass()
    {
        return $this->hasMany(MemberHasWeightClass::class);
    }
    public function memberHasProgramClass()
    {
        return $this->hasMany(MemberHasProgramClass::class);
    }
    public function memberHasEvent()
    {
        return $this->hasMany(MemberHasEvent::class);
    }
    public function absentHasMember()
    {
        return $this->hasMany(AbsentHasMember::class);
    }
}
