<?php

namespace App\Services;

use App\Mail\LaporanBaruMail;
use App\Mail\LaporanUpdateMail;
use App\Models\Laporan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService
{
    /**
     * Cek apakah email pelapor valid dan bisa dikirim notifikasi.
     * Mengembalikan false jika email kosong, 'Anonymous', atau bukan format email.
     */
    protected function isValidEmail(?string $email): bool
    {
        if (empty($email) || strtolower($email) === 'anonymous') {
            return false;
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Kirim notifikasi email saat laporan baru dibuat.
     */
    public function notifyLaporanBaru(Laporan $laporan): void
    {
        $email = $laporan->email_pelapor;

        if (!$this->isValidEmail($email)) {
            Log::info("[EmailNotif] Skip notif laporan baru #{$laporan->id_laporan} — email tidak valid: {$email}");
            return;
        }

        try {
            $laporan->loadMissing('kategori.unit');

            Mail::to($email)->send(new LaporanBaruMail($laporan));

            Log::info("[EmailNotif] Berhasil kirim notif laporan baru ke {$email} (Tiket: {$laporan->kode_tiket})");
        } catch (\Exception $e) {
            Log::error("[EmailNotif] Gagal kirim notif laporan baru ke {$email}: {$e->getMessage()}");
        }
    }

    /**
     * Kirim notifikasi email saat status laporan diupdate.
     */
    public function notifyLaporanUpdate(Laporan $laporan, string $statusBaru, ?string $catatan = null): void
    {
        $email = $laporan->email_pelapor;

        if (!$this->isValidEmail($email)) {
            Log::info("[EmailNotif] Skip notif update #{$laporan->id_laporan} — email tidak valid: {$email}");
            return;
        }

        try {
            $laporan->loadMissing('kategori.unit');

            Mail::to($email)->send(new LaporanUpdateMail($laporan, $statusBaru, $catatan));

            Log::info("[EmailNotif] Berhasil kirim notif update ke {$email} (Tiket: {$laporan->kode_tiket}, Status: {$statusBaru})");
        } catch (\Exception $e) {
            Log::error("[EmailNotif] Gagal kirim notif update ke {$email}: {$e->getMessage()}");
        }
    }
}
