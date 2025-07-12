<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Blameable
{
    public static function bootBlameable()
    {
        // Automatically set `updated_by` on update, without affecting `deleted_by`
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        // Automatically set `deleted_by` on delete, without affecting `updated_by`
        static::deleting(function ($model) {
            if (Auth::check()) {
                // Only update the `deleted_by` column when deleting
                $model->deleted_by = Auth::id();
                $model->save(['deleted_by']);
            }
        });
    }
}
