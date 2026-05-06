<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Lapor UNUJA</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/unuja.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --dark-color: #1f2937;
        }

        body.bg-grid {
            background-color: #f1f4f8;
            background-image:
                linear-gradient(to right, rgba(206, 206, 206, 0.31) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(206, 206, 206, 0.31) 1px, transparent 1px);
            background-size: 25px 25px;
            font-family: 'Poppins', sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 2.5rem 2.25rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.18);
            border: 1px solid rgba(148, 163, 184, 0.5);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(59, 130, 246, 0.02));
            opacity: 0.9;
            pointer-events: none;
        }

        .auth-card-inner {
            position: relative;
            z-index: 1;
        }

        .auth-title {
            font-weight: 600;
            letter-spacing: 0.02em;
            color: var(--dark-color);
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .pick-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: .65rem;
            padding: 1.75rem 1rem;
            border-radius: 0.85rem;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            height: 100%;
        }

        .pick-option:hover {
            border-color: var(--c, var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.12);
            color: inherit;
        }

        .pick-icon {
            width: 56px;
            height: 56px;
            border-radius: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .link-back {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .link-back:hover {
            color: var(--primary-hover);
        }

        .auth-footer-text {
            font-size: 0.8rem;
            color: #9ca3af;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body id="kt_body" class="bg-body bg-grid">
    <div class="d-flex flex-column flex-root auth-wrapper">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <div class="w-lg-600px mx-auto auth-card">
                <div class="auth-card-inner">

                    <div class="text-center mb-8">
                        <a href="{{ route('beranda') }}" class="d-inline-block mb-5">
                            <img alt="Logo" src="{{ asset('assets/media/logos/unuja.png') }}" class="h-50px" />
                        </a>
                        <h1 class="text-dark mb-2 auth-title fs-2">Halo, {{ $ssoUser['nama'] ?? 'Pengguna' }}!</h1>
                        <p class="text-muted auth-subtitle">
                            Anda memiliki akses <span class="fw-semibold" style="color: var(--primary-color)">{{ ucfirst($role) }}</span> di E-Lapor.
                            Silakan pilih aksi yang ingin dilakukan.
                        </p>
                    </div>

                    <div class="row g-4 mb-6">
                        <div class="col-sm-6">
                            <a href="{{ route('sso.pilih.dashboard') }}" class="pick-option" style="--c: var(--primary-color)">
                                <div class="pick-icon bg-light-primary">
                                    <i class="ki-duotone ki-element-11 fs-2x text-primary">
                                        <span class="path1"></span><span class="path2"></span>
                                        <span class="path3"></span><span class="path4"></span>
                                    </i>
                                </div>
                                <div class="fw-semibold text-dark fs-5">Masuk Dashboard</div>
                                <div class="text-muted" style="font-size: .82rem">Kelola & pantau laporan sebagai {{ ucfirst($role) }}</div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('sso.pilih.lapor') }}" class="pick-option" style="--c: #10b981">
                                <div class="pick-icon bg-light-success">
                                    <i class="ki-duotone ki-pencil fs-2x text-success">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>
                                <div class="fw-semibold text-dark fs-5">Buat Laporan</div>
                                <div class="text-muted" style="font-size: .82rem">Kirim pengaduan atau aspirasi Anda</div>
                            </a>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <div class="text-muted auth-footer-text">E-Lapor Universitas Nurul Jadid</div>
                    </div>

                    <div class="text-center">
                        <span class="text-muted">Kembali ke </span>
                        <a href="{{ route('beranda') }}" class="link-back">Beranda</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
