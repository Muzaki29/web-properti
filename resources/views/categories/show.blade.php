@extends('layouts.app')

@section('title', $category->name . ' - Jagad Property')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-gray-600">{{ $category->description }}</p>
        @endif
    </div>

    @if($properties->count() > 0)
        <div class="mb-6">
            <p class="text-gray-600">{{ $properties->total() }} property ditemukan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($properties as $property)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <a href="{{ route('properties.show', $property->slug) }}">
                    <div class="h-48 bg-gray-200 relative">
                        @if($property->primaryImage)
                            <img src="{{ asset('storage/' . $property->primaryImage->image_path) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        @if($property->is_featured)
                            <span class="absolute top-2 right-2 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Unggulan
                            </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $property->title }}</h3>
                        <p class="text-blue-600 font-bold text-xl mb-2">{{ $property->formatted_price }}</p>
                        <div class="flex items-center text-gray-600 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $property->city }}, {{ $property->province }}
                        </div>
                        <div class="flex items-center mt-2 text-gray-600 text-sm">
                            @if($property->bedrooms)
                                <span class="mr-4">{{ $property->bedrooms }} Kamar</span>
                            @endif
                            @if($property->bathrooms)
                                <span class="mr-4">{{ $property->bathrooms }} KM</span>
                            @endif
                            @if($property->land_size)
                                <span>{{ number_format($property->land_size) }} m²</span>
                            @endif
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
            <p class="text-gray-600 mb-4">Belum ada property dalam kategori ini</p>
            <a href="{{ route('properties.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Lihat Semua Property
            </a>
        </div>
    @endif
</div>
@endsection








