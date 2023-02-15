<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function programClass()
    {
        return $this->belongsTo(ProgramClass::class);
    }
    public function day()
    {
        return $this->belongsTo(Day::class);
    }
    public function time()
    {
        return $this->belongsTo(Time::class);
    }
}
