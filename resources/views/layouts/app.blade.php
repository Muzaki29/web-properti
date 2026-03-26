<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jagad Property - Jual Beli Property')</title>
    <meta name="description" content="@yield('description', 'Temukan property impian Anda - Rumah, Tanah, Apartemen, Ruko dan lainnya')">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @if(View::hasSection('navbar'))
        @yield('navbar')
    @else
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-[#8BAE66] rounded-lg flex items-center justify-center">
                                <span class="text-white text-xl font-bold">J</span>
                            </div>
                            <span class="text-2xl font-bold text-gray-900">Jagad Property</span>
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#8BAE66] px-3 py-2 rounded-md text-sm font-medium transition">Beranda</a>
                        <a href="{{ route('properties.index') }}" class="text-gray-700 hover:text-[#8BAE66] px-3 py-2 rounded-md text-sm font-medium transition">Project</a>
                        <a href="{{ route('home') }}#about" class="text-gray-700 hover:text-[#8BAE66] px-3 py-2 rounded-md text-sm font-medium transition">Tentang</a>
                        <a href="{{ route('home') }}#testimoni" class="text-gray-700 hover:text-[#8BAE66] px-3 py-2 rounded-md text-sm font-medium transition">Testimoni</a>
                        <a href="{{ route('home') }}#contact" class="text-gray-700 hover:text-[#8BAE66] px-3 py-2 rounded-md text-sm font-medium transition">Kontak</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Website public hanya untuk melihat katalog, tidak ada akses admin -->
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-[#8BAE66] rounded-lg flex items-center justify-center">
                            <span class="text-white text-xl font-bold">J</span>
                        </div>
                        <span class="text-xl font-bold">Jagad Property</span>
                    </div>
                    <p class="text-gray-400 text-sm">Platform terpercaya untuk jual beli property di Indonesia.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-[#8BAE66] transition">Beranda</a></li>
                        <li><a href="{{ route('properties.index') }}" class="hover:text-[#8BAE66] transition">Project</a></li>
                        <li><a href="#about" class="hover:text-[#8BAE66] transition">Tentang Kami</a></li>
                        <li><a href="#contact" class="hover:text-[#8BAE66] transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 123 456 789
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@jagadproperty.com
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Alamat</h4>
                    <p class="text-gray-400 text-sm">Jl. Property No. 123<br>Jakarta Selatan, DKI Jakarta<br>12345</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Jagad Property. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

