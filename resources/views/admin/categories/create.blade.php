@extends('layouts.admin')

@section('title', 'Tambah Kategori - Admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.categories') }}" class="inline-flex items-center text-[#8BAE66] hover:text-[#7a9a55] mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Kategori
    </a>
    <h1 class="text-3xl font-bold text-gray-900">Tambah Kategori Baru</h1>
</div>

<div class="bg-white rounded-xl shadow-lg p-8">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Slug (otomatis jika kosong)</label>
            <input type="text" name="slug" value="{{ old('slug') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">
            <p class="mt-1 text-sm text-gray-500">Slug akan dibuat otomatis dari nama jika dikosongkan</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#8BAE66] focus:border-[#8BAE66] outline-none">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#8BAE66] focus:ring-[#8BAE66]">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                    class="bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-8 py-3 rounded-lg font-semibold transition shadow-lg">
                Simpan Kategori
            </button>
            <a href="{{ route('admin.categories') }}" 
               class="px-8 py-3 rounded-lg font-semibold border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection





