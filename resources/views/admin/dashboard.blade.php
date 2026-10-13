@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Admin')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('admin.products.index') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        Produk
    </a>
    <a href="{{ route('admin.orders.index') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Order
    </a>
    <a href="{{ route('admin.users.index') }}" class="sidebar-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        Users
    </a>
@endsection

@section('content')

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <div class="stat-card col-span-2 lg:col-span-1">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Total Users</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['total_users']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Produk</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['total_products']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Total Order</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['total_orders']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Pending</p>
            <p class="text-2xl font-bold text-yellow-400">{{ number_format($stats['pending_orders']) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Stok Rendah</p>
            <p class="text-2xl font-bold text-red-400">{{ number_format($stats['low_stock']) }}</p>
        </div>
        <div class="stat-card col-span-2 lg:col-span-1">
            <p class="text-xs text-white/30 uppercase tracking-wider mb-1">Revenue</p>
            <p class="text-xl font-bold text-blue-400">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Orders --}}
        <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden">
            <div class="px-5 py-4 border-b border-white/[0.07] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white">Order Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Lihat semua →</a>
            </div>
            <div class="divide-y divide-white/[0.05]">
                @forelse($recentOrders as $order)
                <div class="px-5 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white">{{ $order->order_code }}</p>
                        <p class="text-xs text-white/30">{{ $order->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-xs px-2 py-1 rounded-full {{ $order->status_badge }} capitalize">
                            {{ $order->status }}
                        </span>
                        <p class="text-xs text-white/30 mt-1">{{ $order->formatted_total }}</p>
                    </div>
                </div>
                @empty
                <p class="px-5 py-8 text-center text-sm text-white/20">Belum ada order.</p>
                @endforelse
            </div>
        </div>

        {{-- Top Products --}}
        <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden">
            <div class="px-5 py-4 border-b border-white/[0.07] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white">Produk Populer</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Lihat semua →</a>
            </div>
            <div class="divide-y divide-white/[0.05]">
                @forelse($topProducts as $i => $product)
                <div class="px-5 py-3 flex items-center gap-3">
                    <span class="text-xs font-mono text-white/20 w-5">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
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

        {{-- Recent Users --}}
        <div class="bg-[#080f1a] border border-white/[0.07] rounded-2xl overflow-hidden lg:col-span-2">
            <div class="px-5 py-4 border-b border-white/[0.07] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white">User Terbaru</h2>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Lihat semua →</a>
            </div>
            <div class="divide-y divide-white/[0.05]">
                @forelse($recentUsers as $user)
                <div class="px-5 py-3 flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-blue-600/20 border border-blue-500/20 flex items-center justify-center text-blue-400 text-xs font-bold shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white">{{ $user->name }}</p>
                        <p class="text-xs text-white/30">{{ $user->email }}</p>
                    </div>
                    <span class="text-[10px] font-semibold uppercase px-2 py-1 rounded
                        @if($user->isAdmin()) bg-red-500/15 text-red-400
                        @elseif($user->isEditor()) bg-purple-500/15 text-purple-400
                        @else bg-blue-500/15 text-blue-400 @endif">
                        {{ $user->role?->name }}
                    </span>
                    <span class="text-xs text-white/20">{{ $user->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <p class="px-5 py-8 text-center text-sm text-white/20">Belum ada user.</p>
                @endforelse
            </div>
        </div>

    </div>
@endsection
