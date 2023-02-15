<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramClassHasTrainer extends Model
{
    use HasFactory, Uuids;
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
    public function programClass()
    {
        return $this->belongsTo(ProgramClass::class);
    }
}
