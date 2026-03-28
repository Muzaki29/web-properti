<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyImageService
{
    /**
     * @param UploadedFile[] $files
     * @return PropertyImage[]
     */
    public function uploadImages(Property $property, array $files, bool $setFirstAsPrimary = false, ?int $primaryIndex = null): array
    {
        $uploaded = [];

        DB::transaction(function () use ($property, $files, $setFirstAsPrimary, $primaryIndex, &$uploaded) {
            foreach ($files as $index => $file) {
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('properties', $filename, 'public');

                $isPrimary = false;

                if ($primaryIndex !== null) {
                    $isPrimary = ((int) $primaryIndex === (int) $index);
                } elseif ($setFirstAsPrimary && $index === 0) {
                    $isPrimary = true;
                } elseif ($index === 0 && $property->images()->count() === 0) {
                    $isPrimary = true;
                }

                if ($isPrimary) {
                    $property->images()->update(['is_primary' => false]);
                }

                $image = PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'image_name' => $file->getClientOriginalName(),
                    'order' => $property->images()->count(),
                    'is_primary' => $isPrimary,
                ]);

                $uploaded[] = $image;
            }
        });

        return $uploaded;
    }

    public function deleteImage(PropertyImage $image): void
    {
        DB::transaction(function () use ($image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();
        });
    }

    public function setPrimaryImage(PropertyImage $image): void
    {
        DB::transaction(function () use ($image) {
            $image->property->images()->update(['is_primary' => false]);
            $image->update(['is_primary' => true]);
        });
    }
}

