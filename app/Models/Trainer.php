<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
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
    public function programClassHasTrainers()
    {
        return $this->hasMany(ProgramClassHasTrainer::class);
    }
    public function absentHasTrainer()
    {
        return $this->hasMany(AbsentHasTrainer::class);
    }
}
