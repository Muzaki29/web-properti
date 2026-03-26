@extends('layouts.app')

@section('title', 'Jagad Property - Temukan Property Impian Anda')

@section('navbar')
<header class="sticky top-0 z-30 bg-white/85 backdrop-blur border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#8BAE66] to-[#7a9a55] flex items-center justify-center text-white font-bold">J</div>
            <div>
                <p class="text-sm text-gray-500">Jagad Property</p>
                <p class="text-base font-semibold text-gray-900">Property Impian, Tanpa Ribet</p>
            </div>
        </div>
        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-700">
            <a href="#about" class="hover:text-[#8BAE66]">Tentang</a>
            <a href="#project" class="hover:text-[#8BAE66]">Project</a>
            <a href="#testimoni" class="hover:text-[#8BAE66]">Testimoni</a>
            <a href="#contact" class="hover:text-[#8BAE66]">Kontak</a>
        </nav>
        <div class="flex items-center gap-3">
            <a href="https://wa.me/6285781780369" target="_blank" class="hidden sm:inline-flex items-center gap-2 bg-[#25D366] text-white px-4 py-2 rounded-lg font-semibold shadow hover:shadow-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-4.95A8.97 8.97 0 013 9a9 9 0 1116.32 5.906L21 21l-5.093-1.34A9 9 0 019 18a8.97 8.97 0 01-6.95-3.35L3 21z"/></svg>
                Hubungi WA
            </a>
            <a href="{{ route('properties.index') }}" class="inline-flex items-center gap-2 border border-[#8BAE66] text-[#8BAE66] px-4 py-2 rounded-lg font-semibold hover:bg-[#8BAE66] hover:text-white transition">
                Lihat Listing
            </a>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Hero Section -->
<section class="relative bg-gray-900 text-white py-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#8BAE66]/90 via-[#6f8a48]/85 to-[#4f6333]/80"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1920');"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="text-left">
                <p class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs uppercase tracking-[0.2em] mb-4">DP 0% • Siap Huni • Free Biaya KPR</p>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-[#FFD700] drop-shadow-lg leading-tight">
                    Rumah Impian Tanpa DP,<br>Siap Huni & Strategis
        </h1>
                <p class="text-lg md:text-xl mb-8 text-white/90">Temukan project premium di lokasi terbaik dengan harga terjangkau. Konsultasi gratis dengan tim kami.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('properties.index') }}" class="inline-flex items-center bg-[#FFD700] text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg shadow hover:shadow-lg transition">
                        Jadwalkan Tur
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="#" class="inline-flex items-center border border-white/50 text-white px-6 py-3 rounded-lg font-semibold text-lg hover:bg-white/10 transition">
                        Unduh Brosur
                    </a>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur p-6 rounded-2xl border border-white/10 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-white">Cari cepat</h3>
                    <span class="text-sm text-white/70">Filter kebutuhanmu</span>
                </div>
                <form class="space-y-4" action="{{ route('properties.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-white/70 block mb-2">Kota</label>
                            <select name="city" class="w-full rounded-lg px-4 py-3 bg-white/15 text-white border border-white/20 focus:border-[#FFD700] focus:ring-2 focus:ring-[#FFD700]/50 outline-none">
                                <option class="text-gray-900">Semua</option>
                                <option class="text-gray-900">Jakarta</option>
                                <option class="text-gray-900">Bandung</option>
                                <option class="text-gray-900">Surabaya</option>
                                <option class="text-gray-900">Jogja</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm text-white/70 block mb-2">Rentang Harga</label>
                            <select name="price_range" class="w-full rounded-lg px-4 py-3 bg-white/15 text-white border border-white/20 focus:border-[#FFD700] focus:ring-2 focus:ring-[#FFD700]/50 outline-none">
                                <option class="text-gray-900">Semua</option>
                                <option class="text-gray-900">&lt; 500 jt</option>
                                <option class="text-gray-900">500 jt - 1 M</option>
                                <option class="text-gray-900">1 M - 2 M</option>
                                <option class="text-gray-900">&gt; 2 M</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-white/70 block mb-2">Tipe Unit</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="w-full rounded-lg px-4 py-3 bg-white/15 text-white border border-white/20 hover:border-[#FFD700] hover:bg-white/20 transition cursor-pointer flex items-center justify-center gap-2">
                                <input type="radio" name="type" value="rumah" class="text-[#FFD700] focus:ring-[#FFD700]" checked>
                                <span>Rumah</span>
                            </label>
                            <label class="w-full rounded-lg px-4 py-3 bg-white/15 text-white border border-white/20 hover:border-[#FFD700] hover:bg-white/20 transition cursor-pointer flex items-center justify-center gap-2">
                                <input type="radio" name="type" value="tanah" class="text-[#FFD700] focus:ring-[#FFD700]">
                                <span>Tanah</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-[#FFD700] text-gray-900 px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition">
                        Lihat 50+ Listing
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Trust badges -->
<section class="bg-white py-8 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
        @php
            $badges = [
                [
                    'value' => '10+',
                    'title' => 'Proyek Selesai',
                    'desc' => 'Terbukti tepat waktu',
                    'bg' => 'from-[#8BAE66]/10 to-[#8BAE66]/5',
                    'text' => '#8BAE66',
                ],
                [
                    'value' => '500+',
                    'title' => 'Unit Terjual',
                    'desc' => 'Konsumen puas',
                    'bg' => 'from-[#FFD700]/15 to-[#FFD700]/5',
                    'text' => '#C48F00',
                ],
                [
                    'value' => '4.9★',
                    'title' => 'Rating Layanan',
                    'desc' => 'Konsultasi responsif',
                    'bg' => 'from-[#25D366]/15 to-[#25D366]/5',
                    'text' => '#1FAF55',
                ],
            ];
        @endphp
        @foreach($badges as $badge)
        <div class="group flex items-center gap-4 px-5 py-4 rounded-xl bg-gradient-to-br {{ $badge['bg'] }} border border-gray-100 shadow-[0_10px_30px_-20px_rgba(0,0,0,0.35)] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg shadow-inner"
                 style="color: {{ $badge['text'] }}; box-shadow: inset 0 0 0 2px {{ $badge['text'] }}1A;">
                {{ $badge['value'] }}
            </div>
            <div class="text-left">
                <p class="text-sm text-gray-500">{{ $badge['title'] }}</p>
                <p class="text-base font-semibold text-gray-900">{{ $badge['desc'] }}</p>
            </div>
            <div class="ml-auto w-2 h-2 rounded-full bg-current opacity-0 group-hover:opacity-80 transition duration-300"
                 style="color: {{ $badge['text'] }};"></div>
        </div>
        @endforeach
    </div>
</section>

<!-- Project Kami Section -->
@if($featuredProperties->count() > 0)
<section id="project" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Project Kami</h2>
            <p class="text-gray-600 text-lg">Beberapa proyek terbaru yang telah kami kerjakan</p>
        </div>
        @php
            $displayProperties = $featuredProperties->take(3);
            $placeholders = max(0, 3 - $displayProperties->count());
            $dummyCards = collect([
                [
                    'title' => 'Cluster Hijau Premium',
                    'address' => 'Jl. Contoh Raya, Depok',
                    'city' => 'Depok',
                    'price' => 'Rp 900.000.000',
                    'status_label' => 'Coming Soon',
                    'certificate' => 'SHM/PPJB',
                    'promo' => 'Pre-launch',
                ],
                [
                    'title' => 'Apartment View City',
                    'address' => 'CBD Sudirman',
                    'city' => 'Jakarta',
                    'price' => 'Rp 1.200.000.000',
                    'status_label' => 'Pre-Sale',
                    'certificate' => 'Strata Title',
                    'promo' => 'Cashback 10%',
                ],
                [
                    'title' => 'Ruko Komersial Boulevard',
                    'address' => 'Jl. Raya Utama',
                    'city' => 'Bekasi',
                    'price' => 'Rp 1.500.000.000',
                    'status_label' => 'Available',
                    'certificate' => 'SHGB',
                    'promo' => 'Free BPHTB',
                ],
            ])->take($placeholders);
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($displayProperties as $property)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <a href="{{ route('properties.show', $property->slug) }}">
                    <div class="h-64 bg-gray-200 relative">
                        @if($property->primaryImage)
                            <img src="{{ asset('storage/' . $property->primaryImage->image_path) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#8BAE66] to-[#7a9a55]">
                                <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <span class="absolute top-4 right-4 bg-[#8BAE66] text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            {{ $property->status_label ?? 'Available' }}
                        </span>
                        <span class="absolute bottom-4 left-4 px-3 py-1 rounded-full text-xs bg-[#FFD700] text-gray-900 font-semibold shadow">
                            Promo DP 0%
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-gray-900 mb-3 line-clamp-2">{{ $property->title }}</h3>
                        <div class="flex items-center text-gray-600 text-sm mb-3">
                            <svg class="w-4 h-4 mr-2 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $property->address }}, {{ $property->city }}
                        </div>
                        <div class="flex items-center justify-between mb-4 text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                    {{ $property->building_area ?? 'LB ?' }} m²
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 17h16M4 7v10M20 7v10M9 7v10"/></svg>
                                    {{ $property->land_area ?? 'LT ?' }} m²
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4 text-sm text-gray-700">
                            <div class="flex items-center gap-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M4 12a4 4 0 014-4h8a4 4 0 014 4M4 12v6a2 2 0 002 2h12a2 2 0 002-2v-6"/></svg>
                                    {{ $property->bedrooms ?? '3+' }} KT
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.567 3-3.5S13.657 1 12 1 9 2.567 9 4.5 10.343 8 12 8zM5.5 22a6.5 6.5 0 0113 0"/></svg>
                                    {{ $property->certificate ?? 'SHM/PPJB' }}
                                </span>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                {{ $property->status_label ?? 'Available' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-gray-500 text-sm">Mulai dari</p>
                                <p class="text-[#8BAE66] font-bold text-2xl">{{ $property->formatted_price }}</p>
                            </div>
                            <a href="https://wa.me/6285781780369?text=Halo%20saya%20minat%20{{ urlencode($property->title) }}" class="inline-flex items-center gap-1 text-sm text-[#8BAE66] font-semibold hover:text-[#6f8a48]">
                                Tanya via WA
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-4.95A8.97 8.97 0 013 9a9 9 0 1116.32 5.906L21 21l-5.093-1.34A9 9 0 019 18a8.97 8.97 0 01-6.95-3.35L3 21z"/></svg>
                            </a>
                        </div>
                        <a href="{{ route('properties.show', $property->slug) }}" class="block w-full text-center bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-6 py-3 rounded-lg font-semibold transition">
                            Detail →
                        </a>
                    </div>
                </a>
            </div>
            @endforeach
            @foreach($dummyCards as $dummy)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-dashed border-[#8BAE66]/40">
                <div class="h-64 bg-gradient-to-br from-[#cfdcc0] to-[#9eb77c] flex items-center justify-center text-white/80 text-2xl font-semibold">
                    Coming Soon
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-xl text-gray-900">{{ $dummy['title'] }}</h3>
                        <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-700">{{ $dummy['status_label'] }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm">
                        <svg class="w-4 h-4 mr-2 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $dummy['address'] }}, {{ $dummy['city'] }}
                    </div>
                    <div class="flex items-center gap-4 text-sm text-gray-700">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            LB ? m²
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 17h16M4 7v10M20 7v10M9 7v10"/></svg>
                            LT ? m²
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#8BAE66]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M4 12a4 4 0 014-4h8a4 4 0 014 4M4 12v6a2 2 0 002 2h12a2 2 0 002-2v-6"/></svg>
                            3+ KT
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Mulai dari</p>
                            <p class="text-[#8BAE66] font-bold text-2xl">{{ $dummy['price'] }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-[#FFD700]/20 text-[#8A6A00] font-semibold">{{ $dummy['promo'] }}</span>
                    </div>
                    <button class="block w-full text-center bg-gray-200 text-gray-600 px-6 py-3 rounded-lg font-semibold cursor-not-allowed">
                        Detail →
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('properties.index') }}" class="inline-block bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-8 py-3 rounded-lg font-semibold transition">
                Lihat Semua Project →
            </a>
        </div>
    </div>
</section>
@endif

<!-- About Section -->
<section id="about" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Jagad Property</h2>
            <p class="text-gray-600 text-lg">Platform terpercaya untuk jual beli property di Indonesia</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Visi -->
            <div class="bg-white p-8 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-[#8BAE66] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                <p class="text-gray-600">Menjadi platform terpercaya yang menyediakan property berkualitas, nyaman, dan berkelanjutan untuk semua kalangan masyarakat Indonesia.</p>
            </div>
            
            <!-- Misi -->
            <div class="bg-white p-8 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-[#8BAE66] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                <ul class="text-gray-600 text-left space-y-2">
                    <li class="flex items-start">
                        <span class="text-[#8BAE66] mr-2">•</span>
                        <span>Mengembangkan proyek property berkualitas tinggi</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-[#8BAE66] mr-2">•</span>
                        <span>Memberikan pelayanan terbaik kepada pelanggan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-[#8BAE66] mr-2">•</span>
                        <span>Desain modern dan fungsional</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-[#8BAE66] mr-2">•</span>
                        <span>Membangun hubungan jangka panjang dengan pelanggan</span>
                    </li>
                </ul>
            </div>
            
            <!-- Sejarah -->
            <div class="bg-white p-8 rounded-xl shadow-md text-center">
                <div class="w-16 h-16 bg-[#8BAE66] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Sejarah</h3>
                <p class="text-gray-600">Jagad Property didirikan dengan tujuan menyediakan property berkualitas dengan harga terjangkau. Dari proyek sederhana hingga berkembang menjadi banyak property di berbagai daerah di Indonesia.</p>
            </div>
        </div>
        <div class="mt-12 bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-100 relative overflow-hidden">
            <h4 class="text-xl font-semibold text-gray-900 mb-6">Tonggak Sejarah Singkat</h4>
            @php
                $milestones = [
                    ['year' => '2015', 'title' => 'Mulai Beroperasi', 'desc' => 'Proyek perdana 20 unit rumah.', 'color' => '#8BAE66'],
                    ['year' => '2018', 'title' => 'Ekspansi Kota', 'desc' => 'Masuk ke Bandung & Surabaya.', 'color' => '#C48F00'],
                    ['year' => '2021', 'title' => '500+ Unit', 'desc' => 'Unit terjual dengan kepuasan tinggi.', 'color' => '#1FAF55'],
                    ['year' => 'Now', 'title' => 'Fokus Layanan', 'desc' => 'Konsultasi end-to-end & dukungan KPR.', 'color' => '#8BAE66'],
                ];
            @endphp
            <div class="relative">
                <div class="hidden md:block absolute top-12 left-6 right-6 h-px bg-gradient-to-r from-gray-100 via-gray-200 to-gray-100 pointer-events-none"></div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @foreach($milestones as $item)
                    <div class="group relative flex items-start gap-4 p-4 rounded-xl hover:-translate-y-1 transition-all duration-300 bg-white/60 hover:bg-white shadow-[0_10px_30px_-22px_rgba(0,0,0,0.35)] border border-transparent hover:border-gray-100">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm bg-white shadow-inner"
                                 style="color: {{ $item['color'] }}; box-shadow: inset 0 0 0 2px {{ $item['color'] }}1A;">
                                {{ $item['year'] }}
                            </div>
                            <div class="hidden md:block absolute -bottom-3 left-1/2 -translate-x-1/2 w-2 h-2 rounded-full"
                                 style="background: {{ $item['color'] }};"></div>
                            <div class="hidden md:block absolute -bottom-3 left-1/2 -translate-x-1/2 w-6 h-6 rounded-full opacity-30 animate-ping"
                                 style="background: {{ $item['color'] }};"></div>
                        </div>
                        <div class="space-y-1">
                            <p class="font-semibold text-gray-900">{{ $item['title'] }}</p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="testimoni" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Testimoni</h2>
            <p class="text-gray-600 text-lg">Setiap transaksi adalah langkah besar menuju impian</p>
        </div>
        <div class="relative">
            <div class="overflow-hidden rounded-2xl shadow-md" data-testimonial-slider>
                <div class="flex transition-transform duration-500" data-testimonial-track>
                    @foreach([[
                        'initials' => 'AS',
                        'name' => 'Ahmad Santoso',
                        'role' => 'Pembeli Rumah di Jakarta',
                        'text' => 'Proses pembelian sangat mudah dan transparan. Tim Jagad Property sangat membantu dari awal hingga akhir.',
                        'rating' => 5
                    ],[
                        'initials' => 'SM',
                        'name' => 'Siti Mulyani',
                        'role' => 'Pembeli Tanah di Bandung',
                        'text' => 'Pelayanan memuaskan dan profesional. Lokasi strategis, harga sesuai, proses cepat.',
                        'rating' => 5
                    ],[
                        'initials' => 'DR',
                        'name' => 'Dimas Raharjo',
                        'role' => 'Investor di Surabaya',
                        'text' => 'Tim riset market-nya detail. Saya dibantu pilih unit dengan yield sewa optimal.',
                        'rating' => 5
                    ]] as $index => $t)
                    <div class="min-w-full bg-gray-50 p-8 md:p-10">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-[#8BAE66] rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                {{ $t['initials'] }}
                    </div>
                    <div>
                                <h4 class="font-bold text-gray-900">{{ $t['name'] }}</h4>
                                <p class="text-gray-600 text-sm">{{ $t['role'] }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700 italic mb-4">"{{ $t['text'] }}"</p>
                        <div class="flex text-[#FFD700]" aria-label="rating">
                            @for($i = 0; $i < $t['rating']; $i++)
                                ★
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-between mt-4">
                <div class="flex gap-2" data-testimonial-dots>
                    @for($i = 0; $i < 3; $i++)
                        <button class="w-3 h-3 rounded-full bg-gray-300" aria-label="slide {{ $i+1 }}"></button>
                    @endfor
                </div>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full border border-gray-200 text-gray-700 hover:border-[#8BAE66] hover:text-[#8BAE66]" data-testimonial-prev>‹</button>
                    <button class="w-10 h-10 rounded-full border border-gray-200 text-gray-700 hover:border-[#8BAE66] hover:text-[#8BAE66]" data-testimonial-next>›</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Kontak Kami</h2>
            <p class="text-gray-600 text-lg">Diskusikan kebutuhanmu, kami siap bantu konsultasi & jadwalkan tur.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Form cepat</p>
                        <h3 class="text-2xl font-semibold text-gray-900">Tim kami akan menghubungi ≤ 1x24 jam</h3>
                    </div>
                    <a href="https://wa.me/6285781780369" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#25D366] text-white font-semibold shadow hover:shadow-lg transition">
                        Chat via WA
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21l1.65-4.95A8.97 8.97 0 013 9a9 9 0 1116.32 5.906L21 21l-5.093-1.34A9 9 0 019 18a8.97 8.97 0 01-6.95-3.35L3 21z"/></svg>
                    </a>
                </div>
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                    </div>
                </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon (WhatsApp)</label>
                    <input type="tel" id="phone" name="phone" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="project" class="block text-sm font-medium text-gray-700 mb-2">Pilih Proyek</label>
                            <select id="project" name="project"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition">
                                <option value="">Pilih salah satu</option>
                                @foreach($featuredProperties as $property)
                                    <option value="{{ $property->title }}">{{ $property->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preferensi Kontak</label>
                            <div class="flex items-center gap-3">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="contact_pref" value="whatsapp" checked class="text-[#8BAE66]">
                                    <span class="text-sm text-gray-700">WhatsApp</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="contact_pref" value="email" class="text-[#8BAE66]">
                                    <span class="text-sm text-gray-700">Email</span>
                                </label>
                            </div>
                        </div>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                    <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition" placeholder="Ceritakan kebutuhan Anda, jadwal survey, atau budget."></textarea>
                </div>
                <button type="submit" class="w-full bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-6 py-4 rounded-lg font-semibold text-lg transition shadow-lg flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                        Kirim & Jadwalkan Konsultasi
                </button>
            </form>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Kantor & Dukungan</h3>
                <div class="space-y-4 text-gray-700">
                    <div>
                        <p class="font-semibold">Alamat</p>
                        <p class="text-sm text-gray-600">GQX7+3RW, Jl. Raya Pemuda, Tajurhalang, Kec. Tajur Halang, Kabupaten Bogor, Jawa Barat 16320</p>
                    </div>
                    <div>
                        <p class="font-semibold">Jam Operasional</p>
                        <p class="text-sm text-gray-600">Senin - Sabtu, 09:00 - 18:00 WIB</p>
                    </div>
                    <div>
                        <p class="font-semibold">Kontak</p>
                        <p class="text-sm text-gray-600">WhatsApp: +62 857-8178-0369</p>
                        <p class="text-sm text-gray-600">Email: info@jagadproperty.com</p>
                    </div>
                </div>
                <div class="mt-6">
                    <div class="w-full h-64 rounded-lg overflow-hidden border border-gray-200">
                        <iframe
                            title="Lokasi Kantor Jagad Property"
                            src="https://www.google.com/maps?q=GQX7%2B3RW%2C%20Jl.%20Raya%20Pemuda%2C%20Tajurhalang%2C%20Kec.%20Tajur%20Halang%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016320&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=GQX7%2B3RW%2C%20Jl.%20Raya%20Pemuda%2C%20Tajurhalang%2C%20Kec.%20Tajur%20Halang%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016320" target="_blank" class="mt-2 inline-flex items-center gap-2 text-sm text-[#8BAE66] font-semibold hover:text-[#6f8a48]">
                        Buka di Google Maps
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Simple slider script -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('[data-testimonial-track]');
    const dots = document.querySelectorAll('[data-testimonial-dots] button');
    const prev = document.querySelector('[data-testimonial-prev]');
    const next = document.querySelector('[data-testimonial-next]');
    const slides = track ? track.children.length : 0;
    let index = 0;

    const update = () => {
        if (!track) return;
        track.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle('bg-[#8BAE66]', i === index);
            dot.classList.toggle('bg-gray-300', i !== index);
        });
    };

    dots.forEach((dot, i) => dot.addEventListener('click', () => { index = i; update(); }));
    prev?.addEventListener('click', () => { index = (index - 1 + slides) % slides; update(); });
    next?.addEventListener('click', () => { index = (index + 1) % slides; update(); });

    setInterval(() => {
        index = (index + 1) % slides;
        update();
    }, 5000);

    update();
});
</script>
@endpush
@endsection
