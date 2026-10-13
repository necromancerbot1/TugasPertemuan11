<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TugasWeb P11') — E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-white/50 hover:text-white hover:bg-white/5 transition-all; }
        .sidebar-link.active { @apply text-white bg-blue-600/20 border border-blue-500/30; }
        .stat-card { @apply bg-[#111827] border border-white/10 rounded-xl p-5; }
        .badge-pending    { @apply bg-yellow-500/15 text-yellow-400 border border-yellow-500/20; }
        .badge-processing { @apply bg-blue-500/15 text-blue-400 border border-blue-500/20; }
        .badge-shipped    { @apply bg-indigo-500/15 text-indigo-400 border border-indigo-500/20; }
        .badge-delivered  { @apply bg-green-500/15 text-green-400 border border-green-500/20; }
        .badge-cancelled  { @apply bg-red-500/15 text-red-400 border border-red-500/20; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #1d4ed8; border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#030712] text-white min-h-screen flex">

    {{-- ── Sidebar ───────────────────────────────────────────── --}}
    <aside class="w-60 min-h-screen bg-[#080f1a] border-r border-white/[0.07] flex flex-col fixed top-0 left-0 z-40">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-white/[0.07]">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-white">TugasWeb P11</p>
                    <p class="text-[10px] text-white/30 uppercase tracking-wider">E-Commerce</p>
                </div>
            </div>
        </div>

        {{-- User Info --}}
        <div class="px-4 py-4 border-b border-white/[0.07]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Guest' }}</p>
                    <span class="text-[10px] font-semibold uppercase tracking-wider px-1.5 py-0.5 rounded
                        @if(auth()->user()?->isAdmin()) bg-red-500/20 text-red-400
                        @elseif(auth()->user()?->isEditor()) bg-purple-500/20 text-purple-400
                        @else bg-blue-500/20 text-blue-400 @endif">
                        {{ auth()->user()->role?->label ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            @yield('sidebar-nav')
        </nav>

        {{-- Logout --}}
        <div class="px-3 py-4 border-t border-white/[0.07]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-red-400/70 hover:text-red-400 hover:bg-red-500/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main Content ─────────────────────────────────────── --}}
    <div class="flex-1 ml-60 flex flex-col min-h-screen">

        {{-- Top Bar --}}
        <header class="h-14 bg-[#080f1a]/80 backdrop-blur border-b border-white/[0.07] flex items-center justify-between px-6 sticky top-0 z-30">
            <div>
                <h1 class="text-sm font-semibold text-white/80">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3 text-xs text-white/30">
                <span>{{ now()->format('d M Y') }}</span>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="flex items-center gap-3 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl px-4 py-3 text-sm mb-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl px-4 py-3 text-sm mb-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 px-6 py-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="px-6 py-4 border-t border-white/[0.07] text-xs text-white/20 text-center">
            TugasWeb P11 — E-Commerce DB + Secure Auth · {{ date('Y') }}
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
