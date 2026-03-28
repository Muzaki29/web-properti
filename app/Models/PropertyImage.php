<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'image_path',
        'image_name',
        'order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget((string) config('cache.keys.home_landing'));
        });

        static::deleted(function () {
            Cache::forget((string) config('cache.keys.home_landing'));
        });
    }
}
