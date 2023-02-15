<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function absents()
    {
        return $this->hasMany(Absent::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function programClassHasTrainer()
    {
        return $this->hasMany(ProgramClassHasTrainer::class);
    }
    public function memberHasProgramClass()
    {
        return $this->hasMany(MemberHasProgramClass::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
