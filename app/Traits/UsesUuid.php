<?php

namespace App\Traits;
use Ramsey\Uuid\Uuid;


trait UsesUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
