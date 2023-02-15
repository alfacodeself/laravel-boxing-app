<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // if (empty($model->{$model->getKeyName()})) {
            $model->uuid = Str::uuid()->toString();
            // }
        });
    }
}
