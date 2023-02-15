<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function programClass()
    {
        return $this->belongsTo(ProgramClass::class);
    }
    public function absentHasMember()
    {
        return $this->hasMany(AbsentHasMember::class);
    }
    public function absentHasTrainer()
    {
        return $this->hasMany(AbsentHasTrainer::class);
    }
}
