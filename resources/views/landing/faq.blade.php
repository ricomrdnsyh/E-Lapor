@extends('pages.app')

@section('content')
    <section id="faq" class="py-10 py-lg-15 bg-light">
        <div class="container">
            <div class="text-center mb-8">
                <h2 class="fw-bold text-gray-900 mb-2">FAQ</h2>
                <div class="section-kicker text-muted mb-0">Pertanyaan yang sering ditanyakan</div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faq_accordion">

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_1_h">
                                <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_1" aria-expanded="true">
                                    Apakah laporan saya bisa anonim?
                                </button>
                            </h2>
                            <div id="faq_1" class="accordion-collapse collapse show" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Bisa jika kebijakan universitas mengaktifkan opsi anonim/rahasia. Pastikan tetap
                                    menyertakan bukti seperlunya.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200 mb-4"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_2_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_2">
                                    Berapa lama laporan ditangani?
                                </button>
                            </h2>
                            <div id="faq_2" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Respon awal ditargetkan ≤ 1×24 jam (contoh). Durasi penyelesaian tergantung
                                    kategori & kompleksitas.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border border-gray-200"
                            style="border-radius: var(--elapor-radius); overflow:hidden;">
                            <h2 class="accordion-header" id="faq_3_h">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq_3">
                                    Apa yang membuat laporan diproses lebih cepat?
                                </button>
                            </h2>
                            <div id="faq_3" class="accordion-collapse collapse" data-bs-parent="#faq_accordion">
                                <div class="accordion-body text-muted">
                                    Pilih kategori tepat, isi kronologi singkat-jelas, sertakan lokasi/waktu, dan
                                    unggah bukti (foto/screenshot).
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
