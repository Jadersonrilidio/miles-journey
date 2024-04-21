<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait CreateWithUuid
{
    /**
     * 
     */
    public static function bootCreateWithUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
