@extends('layouts.app')

@section('title', 'Editor Dashboard')
@section('page-title', 'Dashboard Editor')

@section('sidebar-nav')
    <a href="{{ route('editor.dashboard') }}" class="sidebar-link active">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('editor.products.index') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        Kelola Produk
    </a>
    <a href="{{ route('editor.products.create') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Produk
    </a>
@endsection

@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Total Produk</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['total_products']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Produk Aktif</p>
            <p class="text-2xl font-bold text-green-400">{{ number_format($stats['active_products']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Stok Rendah</p>
            <p class="text-2xl font-bold text-yellow-400">{{ number_format($stats['low_stock']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Kategori</p>
            <p class="text-2xl font-bold text-blue-400">{{ number_format($stats['total_categories']) }}</p>
        </div>
    </div>

    {{-- Recent Products --}}
    <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-white/[0.07] flex items-center justify-between">
            <h2 class="text-sm font-semibold text-white">Produk Terbaru</h2>
            <a href="{{ route('editor.products.create') }}"
               class="flex items-center gap-1.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                + Tambah
            </a>
        </div>
        <div class="divide-y divide-white/[0.05]">
            @forelse($recentProducts as $product)
            <div class="px-5 py-3 flex items-center gap-4">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ $product->name }}</p>
                    <p class="text-xs text-white/30">{{ $product->category->name }} · Stok: {{ $product->stock }}</p>
                </div>
                <p class="text-sm font-semibold text-blue-400 shrink-0">{{ $product->formatted_price }}</p>
                <span class="text-[10px] px-2 py-1 rounded-full shrink-0 {{ $product->is_active ? 'bg-green-500/15 text-green-400' : 'bg-red-500/15 text-red-400' }}">
                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
                <a href="{{ route('editor.products.edit', $product->id) }}"
                   class="text-xs text-white/30 hover:text-white transition shrink-0">Edit</a>
            </div>
            @empty
            <p class="px-5 py-8 text-center text-sm text-white/20">Belum ada produk.</p>
            @endforelse
        </div>
    </div>

@endsection
