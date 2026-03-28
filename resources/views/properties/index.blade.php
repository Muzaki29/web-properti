@extends('layouts.app')

@section('title', 'Semua Property - Jagad Property')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter -->
        <aside class="lg:w-1/4">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sticky top-4">
                <h3 class="text-xl font-bold mb-4 text-gray-900">Filter Property</h3>
                
                <form action="{{ route('properties.index') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Kata kunci..." 
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Property Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Property</label>
                        <select name="type" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition bg-white">
                            <option value="">Semua Tipe</option>
                            <option value="rumah" {{ request('type') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                            <option value="tanah" {{ request('type') == 'tanah' ? 'selected' : '' }}>Tanah</option>
                            <option value="apartemen" {{ request('type') == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
                            <option value="ruko" {{ request('type') == 'ruko' ? 'selected' : '' }}>Ruko</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition bg-white">
                            <option value="">Semua Status</option>
                            <option value="dijual" {{ request('status') == 'dijual' ? 'selected' : '' }}>Dijual</option>
                            <option value="disewakan" {{ request('status') == 'disewakan' ? 'selected' : '' }}>Disewakan</option>
                        </select>
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                        <input type="text" name="city" value="{{ request('city') }}" 
                               placeholder="Nama kota..." 
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                   placeholder="Min" 
                                   class="w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                   placeholder="Max" 
                                   class="w-1/2 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition bg-white">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#8BAE66] text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-[#7a9a55] transition">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('properties.index') }}" class="block w-full text-center mt-2 text-sm font-semibold text-[#8BAE66] hover:text-[#6f8a48]">
                        Reset
                    </a>
                </form>
            </div>
        </aside>

        <!-- Property List -->
        <div class="lg:w-3/4">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Semua Property</h1>
                <p class="text-gray-600">{{ $properties->total() }} property ditemukan</p>
            </div>

            @if($properties->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @foreach($properties as $property)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <a href="{{ route('properties.show', $property->slug) }}" class="block h-48 bg-gray-200 relative">
                                @if($property->primaryImage)
                                    <img src="{{ asset('storage/' . $property->primaryImage->image_path) }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gradient-to-br from-[#8BAE66]/15 to-[#8BAE66]/5">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                @if($property->is_featured)
                                    <span class="absolute top-3 right-3 bg-[#8BAE66] text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                                        Available
                                    </span>
                                @else
                                    <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                                        Sold Out
                                    </span>
                                @endif
                            </a>
                            <div class="p-5 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="bg-[#8BAE66]/15 text-[#8BAE66] text-xs font-semibold px-2.5 py-1 rounded">
                                        {{ $property->category->name }}
                                    </span>
                                    <span class="text-gray-600 text-sm">{{ ucfirst($property->status) }}</span>
                                </div>
                                <a href="{{ route('properties.show', $property->slug) }}" class="font-bold text-lg text-gray-900 line-clamp-2 hover:text-[#8BAE66]">
                                    {{ $property->title }}
                                </a>
                                <a href="{{ route('properties.show', $property->slug) }}" class="text-[#8BAE66] font-bold text-xl hover:text-[#6f8a48] block">
                                    {{ $property->formatted_price }}
                                </a>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $property->city }}, {{ $property->province }}
                                </div>
                                <div class="flex items-center text-gray-700 text-sm gap-4">
                                    @if($property->bedrooms)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M4 12a4 4 0 014-4h8a4 4 0 014 4M4 12v6a2 2 0 002 2h12a2 2 0 002-2v-6"/></svg>
                                            {{ $property->bedrooms }} KT
                                        </span>
                                    @endif
                                    @if($property->bathrooms)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zM5.5 22a6.5 6.5 0 0113 0"/></svg>
                                            {{ $property->bathrooms }} KM
                                        </span>
                                    @endif
                                    @if($property->land_size)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                            {{ number_format($property->land_size) }} m²
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <a href="https://wa.me/{{ config('services.whatsapp.phone_e164_digits') }}?text=Halo%20saya%20minat%20{{ urlencode($property->title) }}" rel="noopener noreferrer" class="text-sm font-semibold text-[#8BAE66] hover:text-[#6f8a48] inline-flex items-center gap-1">
                                        Tanya via WA
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-4.95A8.97 8.97 0 013 9a9 9 0 1116.32 5.906L21 21l-5.093-1.34A9 9 0 019 18a8.97 8.97 0 01-6.95-3.35L3 21z"/></svg>
                                    </a>
                                    <a href="{{ route('properties.show', $property->slug) }}" class="px-4 py-2 rounded-lg bg-[#8BAE66] text-white text-sm font-semibold hover:bg-[#7a9a55] transition">
                                        Detail →
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada property ditemukan</h3>
                    <p class="text-gray-600 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="{{ route('properties.index') }}" class="inline-block bg-[#8BAE66] text-white px-6 py-2 rounded-lg hover:bg-[#7a9a55]">
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

