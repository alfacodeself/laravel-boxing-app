<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightClass extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function memberHasWeightClass()
    {
        return $this->hasMany(MemberHasWeightClass::class);
    }
}
