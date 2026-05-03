<?php

namespace App\Mail;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LaporanUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Laporan $laporan,
        public string $statusBaru,
        public ?string $catatan = null
    ) {}

    public function envelope(): Envelope
    {
        $statusLabel = match ($this->statusBaru) {
            'menunggu'  => 'Menunggu',
            'diproses'  => 'Sedang Diproses',
            'selesai'   => 'Selesai',
            'ditolak'   => 'Ditolak',
            default     => $this->statusBaru,
        };

        return new Envelope(
            subject: '[E-Lapor UNUJA] Update Laporan ' . $this->laporan->kode_tiket . ' - ' . $statusLabel,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.laporan-update',
        );
    }
}
