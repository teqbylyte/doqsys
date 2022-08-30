<?php


namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Uid
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid2(Uuid::DCE_DOMAIN_PERSON);
        });
    }
}
