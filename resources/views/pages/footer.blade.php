<footer id="kontak" class="bg-primary text-white">
    <div class="container py-12">
        <div class="row g-8">
            <div class="col-lg-5">
                <div class="d-flex align-items-center mb-5">
                    <span class="symbol symbol-45px symbol-circle bg-white bg-opacity-15">
                        <span class="symbol-label">
                            <img src="{{ asset('assets/media/logos/unuja.png') }}" alt="Logo" class="h-45px w-45px"
                                style="object-fit: contain;">
                        </span>
                    </span>

                    <div class="ms-3">
                        <div class="fw-bold fs-4">E-Lapor Universitas Nurul Jadid</div>
                        <div class="text-white fs-7">
                            Kanal resmi pengaduan & aspirasi civitas akademika
                        </div>
                    </div>
                </div>

                <p class="text-white mb-6 fw-semibold" style="max-width: 46ch;">
                    JL. PP Nurul Jadid, Dusun Tj. Lor, Karanganyar, Kec. Paiton, Kabupaten Probolinggo, Jawa Timur 67291
                </p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="d-inline-flex align-items-center justify-content-center text-white">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"
                                style="fill: currentColor;">
                                <path
                                    d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V21a1 1 0 0 1-1 1C10.85 22 2 13.15 2 2a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.2 2.2z" />
                            </svg>
                        </span>
                        <a href="tel:+628883077077" class="text-white text-decoration-none text-hover-warning">0888 30
                            77077</a>
                    </div>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="d-inline-flex align-items-center justify-content-center text-white">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"
                                style="fill: currentColor;">
                                <path
                                    d="M6 9V3h12v6H6zm10-2V5H8v2h8zM6 19v2h12v-2H6zm14-9h1a1 1 0 0 1 1 1v6a2 2 0 0 1-2 2h-2v-3H6v3H4a2 2 0 0 1-2-2v-6a1 1 0 0 1 1-1h1V8a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2z" />
                            </svg>
                        </span>
                        <span class="text-white">Fax</span>
                        <span class="text-white">0888 30 77077</span>
                    </div>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="d-inline-flex align-items-center justify-content-center text-white">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"
                                style="fill: currentColor;">
                                <path
                                    d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                        </span>
                        <a href="mailto:unuja@unuja.ac.id"
                            class="text-white text-decoration-none text-hover-warning">unuja@unuja.ac.id</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row g-6">
                    <div class="col-md-6">
                        <div class="text-white fw-bold fs-4 mb-5">Internal Link</div>
                        <a href="https://www.unuja.ac.id/"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">Universitas Nurul
                            Jadid</a>
                        <a href="https://pmb.unuja.ac.id/"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">PMB
                            UNUJA</a>
                    </div>

                    <div class="col-md-6">
                        <div class="text-white fw-bold fs-4 mb-5">Layanan</div>
                        <a href="{{ route('beranda') }}"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">Beranda</a>
                        <a href="{{ route('kategori') }}"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">Kategori
                            Laporan</a>
                        <a href="{{ route('alur') }}"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">Alur Penanganan</a>
                        <a href="{{ route('faq') }}"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">FAQ</a>
                        <a href="{{ route('lacak') }}"
                            class="text-white text-hover-warning d-block mb-2 text-decoration-none">Pelacakan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 py-3" style="background: rgba(0,0,0,.25);">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div class="text-white small">2026 &copy; PDSI Universitas Nurul Jadid</div>
        </div>
    </div>
</footer>
