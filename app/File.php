<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'finished' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->identifier = uniqid(true);
        });
    }

    public function getRouteKeyName()
    {
        return 'identifier';
    }

    public function scopeFinished(Builder $query)
    {
        return $query->where('finished', true);
    }

    public function isFree()
    {
        return $this->price === 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
