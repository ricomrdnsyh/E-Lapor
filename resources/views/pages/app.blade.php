<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Kanal resmi pengaduan & aspirasi civitas akademika Universitas Nurul Jadid." />
    <title>E-Lapor | Universitas Nurul Jadid</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/unuja.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @yield('css')
</head>

<body class="font-sans text-slate-700 bg-white antialiased">

    <div id="appRoot" class="flex flex-col min-h-screen">
        @include('pages.header')
        <main class="flex-1 flex flex-col">
            @yield('content')
        </main>
        @include('pages.footer')
    </div>

    <button id="scrollTop"
        class="fixed bottom-8 right-8 z-50 w-11 h-11 rounded-2xl shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 hover:shadow-xl active:shadow-xl hover:-translate-y-1 active:-translate-y-1 active:scale-[0.98]"
        style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    @yield('js')

    <script>
        (function() {
            var header = document.querySelector('.site-header');
            var scrollTop = document.getElementById('scrollTop');

            function onScroll() {
                var y = window.scrollY;
                if (header) {
                    if (y > 20) {
                        header.classList.add('shadow-lg', 'border-b', 'border-white/20');
                    } else {
                        header.classList.remove('shadow-lg', 'border-b', 'border-white/20');
                    }
                }
                if (scrollTop) {
                    var show = y > 400;
                    scrollTop.classList.toggle('opacity-100', show);
                    scrollTop.classList.toggle('visible', show);
                    scrollTop.classList.toggle('opacity-0', !show);
                    scrollTop.classList.toggle('invisible', !show);
                }
            }
            onScroll();
            window.addEventListener('scroll', onScroll, {
                passive: true
            });

            if (scrollTop) {
                scrollTop.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            var toggle = document.getElementById('mobileMenuToggle');
            var menu = document.getElementById('mobileMenu');
            var close = document.getElementById('mobileMenuClose');
            if (toggle && menu) {
                function openMenu() {
                    menu.classList.add('show');
                    document.body.classList.add('overflow-hidden');
                    var backdrop = document.createElement('div');
                    backdrop.className = 'offcanvas-backdrop';
                    backdrop.id = 'mobileBackdrop';
                    backdrop.addEventListener('click', closeMenu);
                    document.body.appendChild(backdrop);
                    setTimeout(function() {
                        backdrop.classList.add('show');
                    }, 10);
                }

                function closeMenu() {
                    menu.classList.remove('show');
                    document.body.classList.remove('overflow-hidden');
                    var backdrop = document.getElementById('mobileBackdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                }
                toggle.addEventListener('click', openMenu);
                if (close) close.addEventListener('click', closeMenu);
            }
        })();
    </script>
</body>

</html>
