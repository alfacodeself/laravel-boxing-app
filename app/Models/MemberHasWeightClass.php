<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHasWeightClass extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function weightClass()
    {
        return $this->belongsTo(WeightClass::class);
    }
}
