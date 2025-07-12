<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Blameable
{
    // Boot the trait
    public static function bootBlameable()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check() && method_exists($model, 'isSoftDeleting') && $model->isSoftDeleting()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }

    // Check if model is using SoftDeletes
    protected function isSoftDeleting()
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this));
    }
}
