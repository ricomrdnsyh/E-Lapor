<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <title>E-Lapor | Universitas Nurul Jadid</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Kanal resmi pengaduan & aspirasi civitas akademika Universitas Nurul Jadid." />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/unuja.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <style>
        :root {
            --elapor-radius: 1.25rem;
            --elapor-shadow: 0 12px 40px rgba(15, 23, 42, .10);
            --elapor-shadow-soft: 0 10px 24px rgba(15, 23, 42, .08);
            --elapor-border: rgba(15, 23, 42, .08);
            --nav-blue: #004289;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bs-body-bg);
        }

        .elapor-header {
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color .2s ease, box-shadow .2s ease, backdrop-filter .2s ease;
            background: rgba(255, 255, 255, .72);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, .35);
        }

        .elapor-header.is-scrolled {
            box-shadow: 0 8px 24px rgba(15, 23, 42, .10);
        }

        .mobile-header {
            position: relative;
            padding-right: 3.25rem;
        }

        .mobile-close {
            position: absolute;
            top: .75rem;
            right: .75rem;
        }

        #kt_landing_menu .elapor-nav-link {
            display: inline-flex;
            align-items: center;
            padding: .45rem 1.05rem;
            border-radius: .55rem;
            text-decoration: none;
            color: var(--nav-blue);
            transition: background-color .18s ease, color .18s ease, box-shadow .18s ease;
        }

        #kt_landing_menu .elapor-nav-link:hover {
            background: var(--nav-blue);
            color: #fff;
        }

        #kt_landing_menu .elapor-nav-link.is-active {
            background: var(--nav-blue);
            color: #fff;
        }

        #kt_landing_menu .elapor-nav-link:focus-visible {
            outline: 2px solid rgba(0, 66, 137, .25);
            outline-offset: 2px;
        }

        .elapor-hero {
            position: relative;
            overflow: hidden;
            padding: 6rem 0;
            background:
                radial-gradient(1200px 500px at 10% -10%, rgba(59, 130, 246, .18), transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(16, 185, 129, .16), transparent 55%),
                linear-gradient(180deg, rgba(15, 23, 42, .02), transparent 40%);
        }

        .hero-badge {
            border: 1px solid var(--elapor-border);
            border-radius: 999px;
            padding: .55rem 1rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06);
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(10px);
        }

        .elapor-card {
            border-radius: var(--elapor-radius);
            border: 1px solid var(--elapor-border);
            box-shadow: var(--elapor-shadow-soft);
        }

        .elapor-card-hover {
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .elapor-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: var(--elapor-shadow);
            border-color: rgba(59, 130, 246, .25);
        }

        .cat-tile {
            border-radius: var(--elapor-radius);
            border: 1px solid var(--elapor-border);
            box-shadow: 0 8px 20px rgba(15, 23, 42, .06);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .cat-tile:hover {
            transform: translateY(-4px);
            box-shadow: var(--elapor-shadow);
            border-color: rgba(59, 130, 246, .25);
        }

        .section-kicker {
            letter-spacing: .08em;
            text-transform: uppercase;
            font-size: .75rem;
            font-weight: 700;
            opacity: .75;
        }

        .footer-link {
            text-decoration: none;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .stat-pill {
            border-radius: 999px;
            border: 1px solid var(--elapor-border);
            background: rgba(255, 255, 255, .7);
            backdrop-filter: blur(10px);
            padding: .6rem .9rem;
        }
        .alur-section {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(1200px 500px at 10% -10%, rgba(59, 130, 246, .18), transparent 60%),
            radial-gradient(900px 500px at 90% 0%, rgba(16, 185, 129, .16), transparent 55%),
            linear-gradient(180deg, rgba(15, 23, 42, .02), transparent 40%);
        }
    </style>
    <script>
        document.documentElement.setAttribute("data-bs-theme", "light");
        localStorage.removeItem("data-bs-theme");
        localStorage.setItem("data-bs-theme", "light");
    </script>
</head>

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">

    <div class="d-flex flex-column flex-root" id="kt_app_root">

        @include('pages.header')

        @yield('content')

        @include('pages.footer')

    </div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
    </div>

    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    @yield('js')

    <script>
        (function() {
            var header = document.querySelector('.elapor-header');
            if (!header) return;
            var onScroll = function() {
                if (window.scrollY > 8) header.classList.add('is-scrolled');
                else header.classList.remove('is-scrolled');
            };
            onScroll();
            window.addEventListener('scroll', onScroll, {
                passive: true
            });
        })();
    </script>
</body>

</html>
