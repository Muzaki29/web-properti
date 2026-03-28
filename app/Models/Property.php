<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'property_type',
        'status',
        'address',
        'city',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'garages',
        'land_size',
        'building_size',
        'year_built',
        'features',
        'contact_name',
        'contact_phone',
        'contact_email',
        'is_featured',
        'is_active',
        'views',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'land_size' => 'decimal:2',
        'building_size' => 'decimal:2',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $slug = Str::slug($property->title);
                $originalSlug = $slug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $property->slug = $slug;
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('title') && empty($property->slug)) {
                $slug = Str::slug($property->title);
                $originalSlug = $slug;
                $counter = 1;
                while (static::where('slug', $slug)->where('id', '!=', $property->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $property->slug = $slug;
            }
        });

        static::saved(function (Property $property) {
            $changes = $property->getChanges();
            if ($changes !== [] && array_keys($changes) === ['views']) {
                return;
            }
            Cache::forget((string) config('cache.keys.home_landing'));
        });

        static::deleted(function () {
            Cache::forget((string) config('cache.keys.home_landing'));
        });
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
