<footer id="kontak" class="elapor-footer py-12 bg-primary">
    <div class="container">

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
                        <div class="fw-bold text-white fs-4">E-Lapor Universitas Nurul Jadid</div>
                        <div class="text-white text-opacity-75 fs-7">
                            Kanal resmi pengaduan & aspirasi civitas akademika
                        </div>
                    </div>
                </div>

                <p class="text-white text-opacity-75 mb-6" style="max-width: 46ch;">
                    Gunakan E-Lapor untuk meningkatkan kualitas layanan kampus secara tertib, aman, dan terukur.
                </p>
            </div>

            <div class="col-lg-7">
                <div class="row g-6">

                    <div class="col-md-6">
                        <div class="footer-title text-white text-opacity-75 fw-bold fs-4 mb-5">Internal Link
                        </div>
                        <a href="https://www.unuja.ac.id/"
                            class="footer-link text-white text-opacity-60 d-block mb-2">Universitas Nurul
                            Jadid</a>
                        <a href="https://pmb.unuja.ac.id/"
                            class="footer-link text-white text-opacity-60 d-block mb-2">PMB UNUJA</a>
                    </div>

                    <div class="col-md-6">
                        <div class="footer-title text-white text-opacity-75 fw-bold fs-4 mb-5">Layanan</div>
                        <a href="{{ route('beranda') }}"
                            class="footer-link text-white text-opacity-60 d-block mb-2">Beranda</a>
                        <a href="{{ route('kategori') }}"
                            class="footer-link text-white text-opacity-60 d-block mb-2">Kategori</a>
                        <a href="{{ route('alur') }}"
                            class="footer-link text-white text-opacity-60 d-block mb-2">Alur</a>
                        <a href="{{ route('faq') }}"
                            class="footer-link text-white text-opacity-60 d-block mb-2">FAQ</a>
                        <a href="{{ route('lacak') }}"
                            class="footer-link text-white text-opacity-60 d-block mb-2">Pelacakan</a>
                    </div>

                </div>
            </div>

        </div>

        <div class="footer-sep my-8"></div>

        <div class="row g-4 align-items-start">
            <div class="col-md-6">
                <div class="text-white text-opacity-75 fs-8">2026 &copy; PDSI Universitas Nurul Jadid</div>
            </div>
        </div>

    </div>
</footer>
