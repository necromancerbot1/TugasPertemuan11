<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — TugasWeb P11</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#030712] text-white min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-sm">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 rounded-xl mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white">Buat Akun</h1>
            <p class="text-sm text-white/40 mt-1">Daftarkan dirimu sekarang</p>
        </div>

        {{-- Form --}}
        <div class="bg-[#080f1a] border border-white/[0.08] rounded-2xl p-6">
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-medium text-white/50 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                    <input
                        type="text" name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama kamu"
                        class="w-full bg-white/[0.04] border @error('name') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
                        autofocus
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-medium text-white/50 mb-1.5 uppercase tracking-wider">Email</label>
                    <input
                        type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
                        class="w-full bg-white/[0.04] border @error('email') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
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
                        placeholder="Min. 8 karakter"
                        class="w-full bg-white/[0.04] border @error('password') border-red-500/50 @else border-white/10 @enderror rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
                    >
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-xs font-medium text-white/50 mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                    <input
                        type="password" name="password_confirmation"
                        placeholder="Ulangi password"
                        class="w-full bg-white/[0.04] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/20 focus:outline-none focus:border-blue-500/50 focus:bg-white/[0.06] transition"
                    >
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2.5 rounded-xl text-sm transition mt-2">
                    Daftar Sekarang
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-white/30 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition">Login di sini</a>
        </p>
    </div>

</body>
</html>
