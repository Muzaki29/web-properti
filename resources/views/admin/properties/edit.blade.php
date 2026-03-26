@extends('layouts.admin')

@section('title', 'Edit Property - Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.properties') }}" class="inline-flex items-center text-[#8BAE66] hover:text-[#7a9a55] mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Property
    </a>
    <h1 class="text-3xl font-bold text-gray-900">Edit Property</h1>
</div>

<div class="bg-white rounded-xl shadow-lg p-8">
    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Property *</label>
                <input type="text" name="title" value="{{ old('title', $property->title) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select name="category_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none bg-white">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
            <textarea name="description" rows="5" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', $property->price) }}" required min="0" step="0.01"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Property *</label>
                <select name="property_type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none bg-white">
                    <option value="">Pilih Tipe</option>
                    <option value="rumah" {{ old('property_type', $property->property_type) == 'rumah' ? 'selected' : '' }}>Rumah</option>
                    <option value="tanah" {{ old('property_type', $property->property_type) == 'tanah' ? 'selected' : '' }}>Tanah</option>
                    <option value="apartemen" {{ old('property_type', $property->property_type) == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
                    <option value="ruko" {{ old('property_type', $property->property_type) == 'ruko' ? 'selected' : '' }}>Ruko</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select name="status" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none bg-white">
                    <option value="dijual" {{ old('status', $property->status) == 'dijual' ? 'selected' : '' }}>Dijual</option>
                    <option value="disewakan" {{ old('status', $property->status) == 'disewakan' ? 'selected' : '' }}>Disewakan</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                <input type="text" name="address" value="{{ old('address', $property->address) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                <input type="text" name="city" value="{{ old('city', $property->city) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
            <input type="text" name="province" value="{{ old('province', $property->province) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Tidur</label>
                <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi</label>
                <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Tanah (m²)</label>
                <input type="number" name="land_size" value="{{ old('land_size', $property->land_size) }}" min="0" step="0.01"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Luas Bangunan (m²)</label>
                <input type="number" name="building_size" value="{{ old('building_size', $property->building_size) }}" min="0" step="0.01"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Pemilik/User *</label>
            <select name="user_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none bg-white">
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $property->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#8BAE66] focus:ring-[#8BAE66]">
                <span class="ml-2 text-sm text-gray-700">Featured Property</span>
            </label>
            
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $property->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#8BAE66] focus:ring-[#8BAE66]">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-8 py-3 rounded-lg font-semibold transition shadow-lg">
                Update Property
            </button>
            <a href="{{ route('admin.properties') }}" 
               class="px-8 py-3 rounded-lg font-semibold border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection





