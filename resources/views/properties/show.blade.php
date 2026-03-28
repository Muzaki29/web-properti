@extends('layouts.app')

@section('title', $property->title . ' - Jagad Property')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li>/</li>
            <li><a href="{{ route('properties.index') }}" class="hover:text-blue-600">Property</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Image Gallery -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Galeri Foto</h3>
                </div>
                @if($property->images->count() > 0)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" 
                             alt="{{ $property->title }}" 
                             id="mainImage"
                             class="w-full h-96 object-cover">
                    </div>
                    @if($property->images->count() > 1)
                        <div class="grid grid-cols-4 gap-2 p-4">
                            @foreach($property->images->take(4) as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $property->title }}" 
                                     onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')"
                                     class="w-full h-20 object-cover cursor-pointer hover:opacity-75 border-2 border-transparent hover:border-blue-500 rounded">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-200">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Property Details -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
                    @if($property->is_featured)
                        <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                            Unggulan
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center space-x-4 mb-6">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm font-semibold">
                        {{ $property->category->name }}
                    </span>
                    <span class="text-gray-600">{{ $property->property_type }}</span>
                    <span class="text-gray-600">•</span>
                    <span class="text-gray-600">{{ $property->status }}</span>
                </div>

                <div class="text-4xl font-bold text-[#8BAE66] mb-6">
                    {{ $property->formatted_price }}
                </div>

                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Detail Property</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if($property->bedrooms)
                            <div>
                                <div class="text-gray-600 text-sm">Kamar Tidur</div>
                                <div class="text-lg font-semibold">{{ $property->bedrooms }}</div>
                            </div>
                        @endif
                        @if($property->bathrooms)
                            <div>
                                <div class="text-gray-600 text-sm">Kamar Mandi</div>
                                <div class="text-lg font-semibold">{{ $property->bathrooms }}</div>
                            </div>
                        @endif
                        @if($property->land_size)
                            <div>
                                <div class="text-gray-600 text-sm">Luas Tanah</div>
                                <div class="text-lg font-semibold">{{ number_format($property->land_size) }} m²</div>
                            </div>
                        @endif
                        @if($property->building_size)
                            <div>
                                <div class="text-gray-600 text-sm">Luas Bangunan</div>
                                <div class="text-lg font-semibold">{{ number_format($property->building_size) }} m²</div>
                            </div>
                        @endif
                        @if($property->garages)
                            <div>
                                <div class="text-gray-600 text-sm">Garasi</div>
                                <div class="text-lg font-semibold">{{ $property->garages }}</div>
                            </div>
                        @endif
                        @if($property->year_built)
                            <div>
                                <div class="text-gray-600 text-sm">Tahun Dibangun</div>
                                <div class="text-lg font-semibold">{{ $property->year_built }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                    <div class="text-gray-700 whitespace-pre-line">{{ $property->description }}</div>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Alamat</h2>
                    <div class="text-gray-700">
                        <p>{{ $property->address }}</p>
                        <p>{{ $property->city }}, {{ $property->province }}</p>
                        @if($property->postal_code)
                            <p>Kode Pos: {{ $property->postal_code }}</p>
                        @endif
                    </div>
                </div>

                @if($property->features && count($property->features) > 0)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Fasilitas</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($property->features as $feature)
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Related Properties -->
            @if($relatedProperties->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Property Serupa</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($relatedProperties as $related)
                            <a href="{{ route('properties.show', $related->slug) }}" class="flex gap-4 hover:bg-gray-50 p-2 rounded transition">
                                <div class="w-32 h-24 bg-gray-200 rounded flex-shrink-0">
                                    @if($related->primaryImage)
                                        <img src="{{ asset('storage/' . $related->primaryImage->image_path) }}" 
                                             alt="{{ $related->title }}" 
                                             class="w-full h-full object-cover rounded">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $related->title }}</h3>
                                    <p class="text-[#8BAE66] font-bold">{{ $related->formatted_price }}</p>
                                    <p class="text-gray-600 text-sm">{{ $related->city }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Kontak Penjual</h2>
                <div class="mb-4">
                    <p class="text-gray-600 text-sm mb-1">Nama</p>
                    <p class="font-semibold">{{ $property->contact_name }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-gray-600 text-sm mb-1">Telepon</p>
                    <a href="tel:{{ $property->contact_phone }}" class="font-semibold text-[#8BAE66] hover:text-[#7a9a55]">
                        {{ $property->contact_phone }}
                    </a>
                </div>
                @if($property->contact_email)
                    <div class="mb-6">
                        <p class="text-gray-600 text-sm mb-1">Email</p>
                        <a href="mailto:{{ $property->contact_email }}" class="font-semibold text-[#8BAE66] hover:text-[#7a9a55]">
                            {{ $property->contact_email }}
                        </a>
                    </div>
                @endif
                <a href="https://wa.me/{{ config('services.whatsapp.phone_e164_digits') }}?text=Halo%20saya%20tertarik%20dengan%20{{ urlencode($property->title) }}" rel="noopener noreferrer"
                   target="_blank"
                   class="w-full inline-flex items-center justify-center bg-[#8BAE66] text-white px-4 py-3 rounded-lg hover:bg-[#7a9a55] transition font-semibold mb-4">
                    Hubungi Sekarang
                </a>
                <div class="text-center text-sm text-gray-600">
                    <p>Dilihat {{ number_format($property->views) }} kali</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeMainImage(imageSrc) {
    document.getElementById('mainImage').src = imageSrc;
}
</script>
@endsection

