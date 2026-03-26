@extends('layouts.admin')

@section('title', 'Manage Categories - Admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manage Categories</h1>
        <p class="text-gray-600 mt-2">Kelola kategori property</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" 
       class="bg-[#8BAE66] hover:bg-[#7a9a55] text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg inline-flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Slug</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Properties</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                        @if($category->description)
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($category->description, 50) }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        @if($category->is_active)
                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $category->properties()->count() }} property</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" 
                               class="text-[#8BAE66] hover:text-[#7a9a55]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-600">
                        Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-[#8BAE66] hover:underline">Tambah kategori pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection





