<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberHasEvent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
