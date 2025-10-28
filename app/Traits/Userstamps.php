<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait Userstamps
{
    protected static function bootUserstamps()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                if (Schema::hasColumn($model->getTable(), 'created_by')) {
                    $model->created_by = Auth::id();
                }

                if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                    $model->updated_by = Auth::id();
                }
            }
        });

        static::updating(function ($model) {
            if (Auth::check() && Schema::hasColumn($model->getTable(), 'updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (
                Auth::check() &&
                method_exists($model, 'isForceDeleting') &&
                !$model->isForceDeleting() &&
                Schema::hasColumn($model->getTable(), 'deleted_by')
            ) {
                $model->deleted_by = Auth::id();
                $model->saveQuietly(); 
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
