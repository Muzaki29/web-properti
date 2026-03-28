<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyImageUploadRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Services\PropertyImageService;
use Throwable;

class PropertyImageController extends Controller
{
    public function index($id)
    {
        $this->authorize('viewAny', PropertyImage::class);

        $property = Property::with('images')->findOrFail($id);
        return view('admin.properties.images', compact('property'));
    }

    public function upload(PropertyImageUploadRequest $request, $id, PropertyImageService $imageService)
    {
        $this->authorize('create', PropertyImage::class);

        $property = Property::findOrFail($id);

        try {
            $imageService->uploadImages(
                $property,
                $request->file('images', []),
                (bool) $request->boolean('set_first_as_primary'),
                null
            );
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('admin.properties.images', $property->id)
                ->with('error', 'Gagal upload gambar. Silakan coba lagi.');
        }

        return redirect()->route('admin.properties.images', $property->id)
            ->with('success', 'Gambar berhasil diupload!');
    }

    public function delete($id, PropertyImageService $imageService)
    {
        $image = PropertyImage::findOrFail($id);
        $this->authorize('delete', $image);

        try {
            $imageService->deleteImage($image);
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Gagal menghapus gambar. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function setPrimary($id, PropertyImageService $imageService)
    {
        $image = PropertyImage::findOrFail($id);
        $this->authorize('update', $image);

        try {
            $imageService->setPrimaryImage($image);
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', 'Gagal mengubah gambar utama. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Gambar utama berhasil diubah!');
    }
}

