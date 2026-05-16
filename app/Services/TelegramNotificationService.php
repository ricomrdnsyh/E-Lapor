<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotificationService
{
    public function __construct(
        protected AuthSSO $auth
    ) {}

    /**
     * Kirim notifikasi Telegram ke admin dan unit terkait saat ada laporan baru.
     */
    public function notifyNewLaporan(Laporan $laporan): void
    {
        try {
            $laporan->loadMissing('kategori.unit');

            $targetUsers = $this->getTargetUsers($laporan);

            if ($targetUsers->isEmpty()) {
                Log::warning('[TelegramNotif] Tidak ada user target untuk laporan #' . $laporan->id_laporan);
                return;
            }

            Log::info('[TelegramNotif] Target users: ' . $targetUsers->pluck('username')->implode(', '));

            $text = $this->buildMessageText($laporan);
            $replyMarkup = $this->buildReplyMarkup($laporan);

            $successCount = 0;
            $failCount = 0;

            foreach ($targetUsers as $user) {
                $sent = $this->sendTelegramMessage(
                    userId: $user->username,
                    text: $text,
                    replyMarkup: $replyMarkup
                );

                if ($sent) {
                    $successCount++;
                } else {
                    $failCount++;
                }
            }

            Log::info("[TelegramNotif] Laporan #{$laporan->id_laporan}: {$successCount} berhasil, {$failCount} gagal dari {$targetUsers->count()} user");
        } catch (\Exception $e) {
            Log::error('[TelegramNotif] Gagal mengirim notifikasi: ' . $e->getMessage(), [
                'laporan_id' => $laporan->id_laporan ?? null,
                'trace'      => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Ambil user target: semua admin + user unit yang sesuai dengan kategori laporan.
     */
    protected function getTargetUsers(Laporan $laporan): Collection
    {
        $kategoriId = $laporan->kategori_id;

        $query = User::where('role', 'admin');

        if ($kategoriId) {
            $query->orWhere(function ($q) use ($kategoriId) {
                $q->where('role', 'unit')
                  ->where('kategori_id', $kategoriId);
            });
        }

        return $query->get();
    }

    /**
     * Susun teks notifikasi dalam format HTML.
     */
    protected function buildMessageText(Laporan $laporan): string
    {
        $kategori  = $laporan->kategori?->nama_kategori ?? '-';
        $unitNama  = $laporan->kategori?->unit?->nama_unit ?? '-';
        $tanggal   = $laporan->tgl_kejadian
            ? $laporan->tgl_kejadian->locale('id')->isoFormat('DD MMMM YYYY, HH:mm')
            : '-';

        $isAnonymous = $laporan->is_anonymous === 'y';

        $lines = [
            '🔔 <b>Laporan Baru Masuk Dari E-Lapor!</b>',
            '',
            '🎫 <b>Kode Tiket:</b> <code>' . e($laporan->kode_tiket) . '</code>',
            '📋 <b>Judul:</b> ' . e($laporan->judul_laporan),
            '📂 <b>Kategori:</b> ' . e($kategori),
            '🏢 <b>Unit Tujuan:</b> ' . e($unitNama),
            '📍 <b>Lokasi:</b> ' . e($laporan->lokasi_kejadian),
            '📅 <b>Tanggal:</b> ' . $tanggal,
            '',
            '👤 <b>Pelapor:</b> ' . ($isAnonymous ? '<i>Anonim</i>' : e($laporan->nama_pelapor)),
        ];

        if (!$isAnonymous) {
            if ($laporan->tipe_pelapor) {
                $lines[] = '🏷 <b>Tipe:</b> ' . e($laporan->tipe_pelapor);
            }
            $lines[] = '📧 <b>Email:</b> ' . e($laporan->email_pelapor);
            $lines[] = '📱 <b>No. Telp:</b> ' . e($laporan->no_telp_pelapor);
        }

        $lines[] = '';
        $lines[] = '📝 <b>Deskripsi:</b>';
        $lines[] = e(\Illuminate\Support\Str::limit($laporan->deskripsi_laporan, 200));

        return implode("\n", $lines);
    }

    /**
     * Susun reply_markup dengan inline keyboard.
     */
    protected function buildReplyMarkup(Laporan $laporan): array
    {
        $url = url('https://sso.unuja.ac.id/');

        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => '📄 Lihat Detail Laporan',
                        'url'  => $url,
                    ],
                ],
            ],
        ];
    }

    /**
     * Ambil auth data dan bangun URL + headers untuk Telegram API.
     *
     * Endpoint: https://sso.unuja.ac.id/portal/data/telegram/message/{token}
     * Headers: X-Token dari auth response (sama seperti ClientSSO)
     *
     * @return array{url: string, headers: array}
     */
    protected function getAuthForTelegram(): array
    {
        $auth    = $this->auth->getAuth();
        $dataUrl = $auth['data_url'];

        // Ambil token dari data_url (format: .../data/{token})
        $path  = parse_url($dataUrl, PHP_URL_PATH);
        $token = $path ? basename($path) : '';

        $baseUrl = config('services.telegram_sso.base_url');
        $url     = rtrim($baseUrl, '/') . '/' . $token;

        // Gunakan headers dari auth response (berisi X-Token yang benar)
        // Sama seperti pattern di ClientSSO::getUnitFromApi()
        $headers = $auth['headers'];
        $headers['Accept']       = 'application/json';
        $headers['Content-Type'] = 'application/json';

        return [
            'url'     => $url,
            'headers' => $headers,
        ];
    }

    /**
     * Kirim pesan Telegram via API SSO.
     */
    protected function sendTelegramMessage(string $userId, string $text, array $replyMarkup = []): bool
    {
        try {
            $telegramAuth = $this->getAuthForTelegram();
            $url     = $telegramAuth['url'];
            $headers = $telegramAuth['headers'];

            Log::info("[TelegramNotif] Kirim ke user_id={$userId} | URL={$url}");

            $body = [
                'user_id'                  => $userId,
                'type'                     => 'penduduk',
                'text'                     => $text,
                'parse_mode'               => 'HTML',
                'reply_markup'             => $replyMarkup,
                'disable_notification'     => false,
                'disable_web_page_preview' => true,
                'reply_to_message_id'      => '',
            ];

            $forceIpv4   = filter_var(env('TELEGRAM_FORCE_IPV4', true), FILTER_VALIDATE_BOOLEAN);
            $forceHttp11 = filter_var(env('TELEGRAM_FORCE_HTTP_1_1', true), FILTER_VALIDATE_BOOLEAN);

            $curlOptions = [];
            if ($forceIpv4) {
                $curlOptions[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
            }
            if ($forceHttp11) {
                $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
            }

            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::withHeaders($headers)
                ->withOptions([
                    'curl'   => $curlOptions,
                    'verify' => false,
                ])
                ->timeout((int) env('TELEGRAM_TIMEOUT', 15))
                ->connectTimeout((int) env('TELEGRAM_CONNECT_TIMEOUT', 5))
                ->retry(
                    (int) env('TELEGRAM_RETRY_TIMES', 1),
                    (int) env('TELEGRAM_RETRY_SLEEP_MS', 500)
                )
                ->post($url, $body);

            // Jika 401, refresh auth (URL token expired) dan coba lagi
            if ($response->status() === 401) {
                Log::info('[TelegramNotif] Token expired, refreshing auth...');
                $this->auth->refreshAuth();

                $telegramAuth = $this->getAuthForTelegram();
                $url     = $telegramAuth['url'];
                $headers = $telegramAuth['headers'];

                $response = Http::withHeaders($headers)
                    ->withOptions([
                        'curl'   => $curlOptions,
                        'verify' => false,
                    ])
                    ->timeout((int) env('TELEGRAM_TIMEOUT', 15))
                    ->connectTimeout((int) env('TELEGRAM_CONNECT_TIMEOUT', 5))
                    ->post($url, $body);
            }

            if ($response->successful()) {
                Log::info("[TelegramNotif] Berhasil kirim ke user_id={$userId} | Response: " . $response->body());
                return true;
            } else {
                Log::warning("[TelegramNotif] Gagal kirim ke user_id={$userId} | Status: {$response->status()} | Body: {$response->body()}");
                return false;
            }
        } catch (\Exception $e) {
            Log::error("[TelegramNotif] Exception saat kirim ke user_id={$userId}: {$e->getMessage()}");
            return false;
        }
    }
}
