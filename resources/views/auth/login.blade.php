<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TugasWeb P11</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#030712] text-white min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 rounded-xl mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Selamat Datang</h1>
            <p class="text-sm text-white/40 mt-1">Login ke akun kamu</p>
        </div>

        {{-- Flash Error --}}
        @if(session('error'))
            <div class="flex items-center gap-2 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl px-4 py-3 text-sm mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <div class="bg-[#080f1a] border border-white/[0.08] rounded-2xl p-6">
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-medium text-white/50 mb-1.5 uppercase tracking-wider">Email</label>
                    <input
                        type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
                        class="w-full bg-white/[0.04] border @error('email') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
                        autofocus
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-medium text-white/50 mb-1.5 uppercase tracking-wider">Password</label>
                    <input
                        type="password" name="password"
                        placeholder="••••••••"
                        class="w-full bg-white/[0.04] border @error('password') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
                    >
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 accent-blue-500">
                    <label for="remember" class="text-xs text-white/40">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 rounded-xl text-sm transition mt-2">
                    Masuk
                </button>
            </form>
        </div>

        {{-- Demo Accounts --}}
        <div class="mt-4 bg-[#080f1a] border border-white/[0.05] rounded-2xl p-4">
            <p class="text-xs text-white/30 mb-3 uppercase tracking-wider font-medium">Akun Demo</p>
            <div class="space-y-2 text-xs">
                <div class="flex justify-between items-center">
                    <span class="bg-red-500/15 text-red-400 px-2 py-0.5 rounded text-[10px] font-semibold uppercase">Admin</span>
                    <span class="text-white/40 font-mono">admin@tugasweb.com / password</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="bg-purple-500/15 text-purple-400 px-2 py-0.5 rounded text-[10px] font-semibold uppercase">Editor</span>
                    <span class="text-white/40 font-mono">editor@tugasweb.com / password</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="bg-blue-500/15 text-blue-400 px-2 py-0.5 rounded text-[10px] font-semibold uppercase">User</span>
                    <span class="text-white/40 font-mono">user@tugasweb.com / password</span>
                </div>
            </div>
        </div>

        <p class="text-center text-sm text-white/30 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition">Daftar sekarang</a>
        </p>
    </div>

</body>
</html>
