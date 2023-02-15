<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentHasMember extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function absent()
    {
        return $this->belongsTo(Absent::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
