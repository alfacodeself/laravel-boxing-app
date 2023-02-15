<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHasProgramClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function programClass()
    {
        return $this->belongsTo(ProgramClass::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
