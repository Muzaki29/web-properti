@extends('layouts.admin')

@section('title', 'Kelola Gambar Property - Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.properties') }}" class="inline-flex items-center text-[#8BAE66] hover:text-[#7a9a55] mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Property
    </a>
    <h1 class="text-3xl font-bold text-gray-900">Kelola Gambar Property</h1>
    <p class="text-gray-600 mt-2">{{ $property->title }}</p>
</div>

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Upload Gambar Baru</h2>
    <form action="{{ route('admin.properties.upload-images', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Pilih Gambar (Bisa multiple, max 5MB per file)
            </label>
            <input type="file" 
                   name="images[]" 
                   id="images" 
                   multiple 
                   accept="image/*"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition"
                   required>
            <p class="mt-2 text-sm text-gray-500">Format: JPEG, PNG, JPG, GIF, WEBP. Maksimal 5MB per file.</p>
        </div>
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="set_first_as_primary" class="rounded border-gray-300 text-[#8BAE66] focus:ring-[#8BAE66]">
                <span class="ml-2 text-sm text-gray-700">Set gambar pertama sebagai gambar utama</span>
            </label>
        </div>
        <button type="submit" 
                class="w-full bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
            Upload Gambar
        </button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Gambar Property ({{ $property->images->count() }})</h2>
    
    @if($property->images->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="imagesGrid">
            @foreach($property->images as $image)
                <div class="relative group border-2 rounded-lg overflow-hidden {{ $image->is_primary ? 'border-[#8BAE66] ring-2 ring-[#8BAE66]' : 'border-gray-200' }}">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-48 object-cover">
                        @if($image->is_primary)
                            <span class="absolute top-2 left-2 bg-[#8BAE66] text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Gambar Utama
                            </span>
                        @endif
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            @if(!$image->is_primary)
                                <form action="{{ route('admin.images.set-primary', $image->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                        Set Utama
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.images.delete', $image->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus gambar ini?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50">
                        <p class="text-xs text-gray-600 truncate">{{ $image->image_name ?? 'image.jpg' }}</p>
                        <p class="text-xs text-gray-400 mt-1">Urutan: {{ $image->order + 1 }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-gray-600">Belum ada gambar. Upload gambar pertama untuk property ini.</p>
        </div>
    @endif
</div>
@endsection





