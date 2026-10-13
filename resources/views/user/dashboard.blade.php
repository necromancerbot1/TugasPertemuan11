@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Saya')

@section('sidebar-nav')
    <a href="{{ route('user.dashboard') }}" class="sidebar-link active">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('user.orders.index') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Riwayat Order
    </a>
@endsection

@section('content')

    {{-- Welcome --}}
    <div class="bg-gradient-to-r from-blue-600/20 to-blue-900/10 border border-blue-500/20 rounded-2xl px-6 py-5 mb-6">
        <p class="text-xs text-blue-400 uppercase tracking-widest mb-1">Selamat datang kembali</p>
        <h2 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h2>
        <p class="text-sm text-white/40 mt-1">{{ auth()->user()->email }}</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Total Order</p>
            <p class="text-2xl font-bold text-white">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Pending</p>
            <p class="text-2xl font-bold text-yellow-400">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Selesai</p>
            <p class="text-2xl font-bold text-green-400">{{ $stats['delivered_orders'] }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Total Belanja</p>
            <p class="text-lg font-bold text-blue-400">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Orders --}}
        <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden">
            <div class="px-5 py-4 border-b border-white/[0.07] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white">Order Terakhir</h2>
                <a href="{{ route('user.orders.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Lihat semua →</a>
            </div>
            <div class="divide-y divide-white/[0.05]">
                @forelse($recentOrders as $order)
                <div class="px-5 py-3">
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-sm font-medium text-white">{{ $order->order_code }}</p>
                        <span class="text-xs px-2 py-0.5 rounded-full badge-{{ $order->status }} capitalize">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs text-white/30">{{ $order->items->count() }} item · {{ $order->created_at->format('d M Y') }}</p>
                        <p class="text-xs font-semibold text-white/70">{{ $order->formatted_total }}</p>
                    </div>
                </div>
                @empty
                <p class="px-5 py-8 text-center text-sm text-white/20">Belum ada order.</p>
                @endforelse
            </div>
        </div>

        {{-- Featured Products --}}
        <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden">
            <div class="px-5 py-4 border-b border-white/[0.07]">
                <h2 class="text-sm font-semibold text-white">Produk Tersedia</h2>
            </div>
            <div class="divide-y divide-white/[0.05]">
                @forelse($featuredProducts as $product)
                <div class="px-5 py-3 flex items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ $product->name }}</p>
                        <p class="text-xs text-white/30">{{ $product->category->name }} · Stok: {{ $product->stock }}</p>
                    </div>
                    <p class="text-sm font-semibold text-blue-400 shrink-0">{{ $product->formatted_price }}</p>
                </div>
                @empty
                <p class="px-5 py-8 text-center text-sm text-white/20">Belum ada produk.</p>
                @endforelse
            </div>
        </div>

    </div>
@endsection
