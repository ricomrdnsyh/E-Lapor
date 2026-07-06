<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Lapor UNUJA</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/unuja.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-grid {
            background-color: #f0f7ff;
            background-image: linear-gradient(to right, rgba(30, 64, 175, 0.08) 1px, transparent 1px), linear-gradient(to bottom, rgba(30, 64, 175, 0.08) 1px, transparent 1px);
            background-size: 25px 25px;
        }
    </style>
</head>

<body class="bg-grid antialiased min-h-screen flex items-center justify-center p-4 sm:p-10">
    <div class="w-full max-w-lg">
        <div
            class="relative bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl border border-slate-300/50 p-8 sm:p-10 overflow-hidden">
            <div class="absolute inset-0 rounded-2xl pointer-events-none"
                style="background: linear-gradient(135deg, rgba(30,64,175,0.12), rgba(59,130,246,0.02));"></div>
            <div class="relative z-10">
                <div class="text-center mb-8">
                    <a href="{{ route('beranda') }}" class="inline-block mb-5">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo-elapor-dark.png') }}"
                            class="h-12 mx-auto" />
                    </a>
                    <h1 class="font-bold text-primary-darker text-xl mb-1">Halo, {{ $ssoUser['nama'] ?? 'Pengguna' }}!
                    </h1>
                    <p class="text-slate-500 text-sm">
                        Anda memiliki akses <span class="font-semibold text-primary">{{ ucfirst($role) }}</span> di
                        E-Lapor.
                        Silakan pilih aksi yang ingin dilakukan.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 gap-4 mb-6">
                    <a href="{{ route('sso.pilih.dashboard') }}"
                        class="flex flex-col items-center text-center gap-2.5 p-6 rounded-xl border-2 border-slate-200 bg-white no-underline text-inherit transition-all duration-300 hover:border-primary hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg hover:shadow-primary/10 active:shadow-primary/10 active:border-primary active:scale-[0.98] active:bg-slate-50 group">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white shadow-sm group-hover:shadow-md group-active:shadow-md transition-shadow group-active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-slate-800">Masuk Dashboard</div>
                            <div class="text-xs text-slate-400">Kelola & pantau laporan sebagai {{ ucfirst($role) }}
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('sso.pilih.lapor') }}"
                        class="flex flex-col items-center text-center gap-2.5 p-6 rounded-xl border-2 border-slate-200 bg-white no-underline text-inherit transition-all duration-300 hover:border-emerald-400 hover:-translate-y-1 active:-translate-y-1 hover:shadow-lg active:shadow-lg hover:shadow-emerald-500/10 active:shadow-emerald-500/10 active:border-emerald-400 active:scale-[0.98] active:bg-slate-50 group">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-sm group-hover:shadow-md group-active:shadow-md transition-shadow group-active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-slate-800">Buat Laporan</div>
                            <div class="text-xs text-slate-400">Kirim pengaduan atau aspirasi Anda</div>
                        </div>
                    </a>
                </div>

                <div class="text-center mb-3">
                    <p class="text-[13px] text-slate-400">E-Lapor Universitas Nurul Jadid</p>
                </div>
                <div class="text-center">
                    <span class="text-sm text-slate-400">Kembali ke </span>
                    <a href="{{ route('beranda') }}"
                        class="text-sm font-semibold text-primary no-underline hover:text-primary-dark active:text-primary-dark transition-colors active:scale-[0.98]">Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
