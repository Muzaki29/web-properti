<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Login - Jagad Property</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="flex justify-center">
                    <div class="w-16 h-16 rounded-lg bg-[#8BAE66] flex items-center justify-center text-white font-bold text-2xl">
                        J
                    </div>
                </div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    Super Admin Login
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Jagad Property Admin Panel
                </p>
            </div>
            
            <form class="mt-8 space-y-6 bg-white p-8 rounded-xl shadow-lg" action="{{ route('super-admin.login') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               autocomplete="email" 
                               required 
                               value="{{ old('email', 'admin@jagadproperty.com') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition"
                               placeholder="admin@jagadproperty.com">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none transition"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-[#8BAE66] focus:ring-[#8BAE66]">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                        Masuk sebagai Super Admin
                    </button>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('home') }}" class="text-sm text-[#8BAE66] hover:text-[#7a9a55]">
                        ← Kembali ke Website
                    </a>
                </div>
            </form>
            
            <div class="text-center text-sm text-gray-500">
                <p class="font-semibold mb-2">Akses Khusus Super Admin</p>
                <p class="text-xs">Hanya user dengan role admin yang dapat mengakses dashboard</p>
            </div>
        </div>
    </div>
</body>
</html>





