<?php

namespace App\Services;

use App\Models\Laporan;
use App\Models\TelegramOutboxLaporan;
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
            $laporan->loadMissing(['kategori.unit', 'subKategori']);

            $targetUsers = $this->getTargetUsers($laporan);

            if ($targetUsers->isEmpty()) {
                Log::warning('[TelegramNotif] Tidak ada user target untuk laporan #' . $laporan->id_laporan);
                return;
            }

            // Pastikan otentikasi SSO berhasil terlebih dahulu sebelum memproses user target
            try {
                $telegramAuth = $this->getAuthForTelegram();
            } catch (\Exception $e) {
                Log::error('[TelegramNotif] Gagal mendapatkan otentikasi SSO Telegram: ' . $e->getMessage());
                return;
            }

            $successCount = 0;
            $failCount = 0;

            foreach ($targetUsers as $user) {
                // Ambil ID HistoryLaporan terkait
                $history = $laporan->historyLaporans()->first();
                $historyId = $history ? $history->id_history : $laporan->id_laporan;

                // Tentukan target URL berdasarkan role user
                if ($user->role === 'admin') {
                    $targetUrl = route('admin.history-laporan.edit', $historyId);
                } elseif ($user->role === 'unit') {
                    $targetUrl = route('unit.history-laporan.edit', $historyId);
                } else {
                    $targetUrl = route('pimpinan.history-laporan.index');
                }

                $detailUrlSso = $this->buildSsoCallbackUrl($targetUrl, $user);
                $text = $this->buildMessageText($laporan, $detailUrlSso);

                $sentData = $this->sendTelegramMessage(
                    userId: $user->username,
                    text: $text,
                    telegramAuth: $telegramAuth
                );

                if ($sentData !== null) {
                    $successCount++;

                    // Catat ke telegram_outbox_laporans untuk relasi saat user membalas (reply) di Telegram
                    try {
                        TelegramOutboxLaporan::create([
                            'outbox_id'           => $sentData['outbox_id'] ?? null,
                            'telegram_message_id' => $sentData['telegram_message_id'] ?? null,
                            'chat_id'             => $sentData['chat_id'] ?? null,
                            'user_id'             => $user->id,
                            'laporan_id'          => $laporan->id_laporan,
                            'history_id'          => $historyId,
                        ]);

                        // Simpan telegram_id user jika belum ada
                        if (!empty($sentData['chat_id']) && empty($user->telegram_id)) {
                            $user->update(['telegram_id' => (string) $sentData['chat_id']]);
                        }
                    } catch (\Exception $e) {
                        Log::warning('[TelegramNotif] Gagal simpan outbox laporan: ' . $e->getMessage());
                    }
                } else {
                    $failCount++;
                }
            }

            // Log::info("[TelegramNotif] Laporan #{$laporan->id_laporan}: {$successCount} berhasil, {$failCount} gagal dari {$targetUsers->count()} user");
        } catch (\Exception $e) {
            Log::error('[TelegramNotif] Gagal mengirim notifikasi: ' . $e->getMessage(), [
                'laporan_id' => $laporan->id_laporan ?? null,
                'trace'      => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Ambil user target: semua admin + user unit yang memiliki kategori laporan.
     */
    protected function getTargetUsers(Laporan $laporan): Collection
    {
        $kategoriId = $laporan->kategori_id;

        $query = User::where('role', 'admin');

        if ($kategoriId) {
            $query->orWhere(function ($q) use ($kategoriId) {
                $q->where('role', 'unit')
                  ->whereHas('kategoris', function ($q2) use ($kategoriId) {
                      $q2->where('kategori_user.kategori_id', $kategoriId);
                  });
            });
        }

        return $query->get();
    }

    /**
     * Susun teks notifikasi dalam format HTML.
     */
    protected function buildMessageText(Laporan $laporan, ?string $detailUrl = null): string
    {
        $kategori  = $laporan->kategori?->nama_kategori ?? '-';
        $subKategori = $laporan->subKategori?->nama_sub ?? '-';
        $unitNama  = $laporan->kategori?->unit?->nama_unit ?? '-';
        $tanggal   = $laporan->tgl_kejadian
            ? $laporan->tgl_kejadian->locale('id')->isoFormat('DD MMMM YYYY, HH:mm')
            : '-';

        $laporan->loadMissing('ruangan.lantai.gedung');

        $lokasi = '-';
        if ($laporan->ruangan) {
            $parts = [];
            if ($laporan->ruangan->lantai && $laporan->ruangan->lantai->gedung) {
                $parts[] = $laporan->ruangan->lantai->gedung->nama_gedung;
            }
            if ($laporan->ruangan->lantai) {
                $parts[] = $laporan->ruangan->lantai->nama_lantai;
            }
            $parts[] = $laporan->ruangan->nama_ruangan;
            $lokasi = implode(' - ', $parts);
        }

        $isAnonymous = $laporan->is_anonymous === 'y';

        $lines = [
            '🔔 <b>Laporan Baru Masuk Dari E-Lapor!</b>',
            '',
            '🎫 <b>Kode Tiket:</b> <code>' . e($laporan->kode_tiket) . '</code>',
            '📋 <b>Judul:</b> ' . e($laporan->judul_laporan),
            '🏢 <b>Unit Tujuan:</b> ' . e($unitNama),
            '📂 <b>Kategori:</b> ' . e($kategori),
            '📁 <b>Sub Kategori:</b> ' . e($subKategori),
            '📍 <b>Lokasi:</b> ' . e($lokasi),
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

        $lines[] = '';
        $lines[] = '━━━━━━━━━━━━━━━━━━━━━━';
        $lines[] = '💬 <b>CARA RESPON LANGSUNG VIA TELEGRAM:</b>';
        $lines[] = '👉 Balas langsung / ketik <code>PROSES: [catatan]</code> untuk memproses laporan.';
        $lines[] = '👉 Ketik <code>TOLAK: [alasan penolakan]</code> untuk menolak laporan.';

        if ($detailUrl) {
            $lines[] = '';
            $lines[] = '📄 <a href="' . $detailUrl . '"><b>[ LIHAT DETAIL LAPORAN ]</b></a>';
        }

        return implode("\n", $lines);
    }

    /**
     * Susun URL SSO Callback terverifikasi untuk link lihat detail laporan di Telegram.
     */
    protected function buildSsoCallbackUrl(string $targetUrl, User $user): string
    {
        $appSecret = config('services.sso.x_token') ?: env('SSO_X_TOKEN', '');
        $devId = config('services.sso.dev_id') ?: env('SSO_DEV_ID', '');
        $idTelegram = (string) ($user->telegram_id ?? $user->username);
        $timestamp = time();
        $redirectUri = $targetUrl;

        $encodedXToken = base64_encode(base64_encode($appSecret));
        $encodedDevId = base64_encode(base64_encode($devId));
        $encodedIdTelegram = base64_encode(base64_encode($idTelegram));
        $encodedTimestamp = base64_encode(base64_encode($timestamp));

        $dataToSign = "x-token=" . $appSecret . "&dev_id=" . $devId . "&id_telegram=" . $idTelegram . "&timestamp=" . $timestamp . "&redirect_uri=" . $redirectUri;
        $signature = hash_hmac('sha256', $dataToSign, $appSecret);

        $params = [
            'x-token'      => $encodedXToken,
            'redirect_uri' => $redirectUri,
            'dev_id'       => $encodedDevId,
            'id_telegram'  => $encodedIdTelegram,
            'timestamp'    => $encodedTimestamp,
            'signature'    => $signature
        ];

        return 'https://sso.unuja.ac.id/callback?' . http_build_query($params);
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

        $baseUrl       = config('services.telegram_sso.base_url');
        $replaceSource = config('services.sso.replace_source');
        $replaceTarget = config('services.sso.replace_target');
        if ($replaceSource && $replaceTarget && $replaceSource !== $replaceTarget) {
            $baseUrl = str_replace($replaceSource, $replaceTarget, $baseUrl);
        }

        $url = rtrim($baseUrl, '/') . '/' . $token;

        $headers = $auth['headers'];
        $headers['Accept']       = 'application/json';
        $headers['Content-Type'] = 'application/json';
        $headers['User-Agent']   = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36';

        return [
            'url'     => $url,
            'headers' => $headers,
        ];
    }

    /**
     * Kirim pesan Telegram via API SSO.
     *
     * @return array|null Response data dari SSO jika berhasil (outbox_id, telegram_message_id, chat_id), atau null jika gagal.
     */
    protected function sendTelegramMessage(string $userId, string $text, ?array $telegramAuth = null): ?array
    {
        try {
            $telegramAuth = $telegramAuth ?: $this->getAuthForTelegram();
            $url     = $telegramAuth['url'];
            $headers = $telegramAuth['headers'];

            $callbackUrl = config('services.telegram_sso.callback_url');
            if (empty($callbackUrl) || str_contains($callbackUrl, 'localhost') || str_contains($callbackUrl, '127.0.0.1')) {
                if (app()->environment('production') || (request()->getHost() && str_contains(request()->getHost(), 'lapor.unuja.ac.id'))) {
                    $callbackUrl = 'https://lapor.unuja.ac.id/api/telegram/callback';
                } else {
                    $callbackUrl = url('/api/telegram/callback');
                }
            }

            $body = [
                'user_id'                  => $userId,
                'type'                     => 'penduduk',
                'text'                     => $text,
                'parse_mode'               => 'HTML',
                'callback_url'             => $callbackUrl,
                'disable_web_page_preview' => true,
            ];

            Log::warning("[TelegramNotif] Mengirim notif ke {$userId} | callback_url: {$callbackUrl}");

            $forceIpv4      = filter_var(config('services.telegram_sso.force_ipv4', env('TELEGRAM_FORCE_IPV4', false)), FILTER_VALIDATE_BOOLEAN);
            $forceHttp11    = filter_var(config('services.telegram_sso.force_http_1_1', env('TELEGRAM_FORCE_HTTP_1_1', false)), FILTER_VALIDATE_BOOLEAN);
            $timeout        = (int) (config('services.telegram_sso.timeout') ?: env('TELEGRAM_TIMEOUT', 15));
            $connectTimeout = (int) (config('services.telegram_sso.connect_timeout') ?: env('TELEGRAM_CONNECT_TIMEOUT', 5));
            $retryTimes     = (int) (config('services.telegram_sso.retry_times') ?: env('TELEGRAM_RETRY_TIMES', 1));
            $retrySleep     = (int) (config('services.telegram_sso.retry_sleep_ms') ?: env('TELEGRAM_RETRY_SLEEP_MS', 500));

            $curlOptions = [];
            if ($forceIpv4) {
                $curlOptions[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
            }
            if ($forceHttp11) {
                $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
            }

            try {
                /** @var \Illuminate\Http\Client\Response $response */
                $response = Http::withHeaders($headers)
                    ->withOptions([
                        'curl'   => $curlOptions,
                        'verify' => false,
                    ])
                    ->timeout($timeout)
                    ->connectTimeout($connectTimeout)
                    ->retry($retryTimes, $retrySleep)
                    ->post($url, $body);
            } catch (\Exception $e) {
                // Fallback jika curl options khusus gagal koneksi
                if (!empty($curlOptions)) {
                    $response = Http::withHeaders($headers)
                        ->withOptions(['verify' => false])
                        ->timeout($timeout)
                        ->connectTimeout($connectTimeout)
                        ->post($url, $body);
                } else {
                    throw $e;
                }
            }

            // Jika 401, refresh auth (URL token expired) dan coba lagi
            if ($response->status() === 401) {
                $this->auth->refreshAuth();

                $telegramAuth = $this->getAuthForTelegram();
                $url     = $telegramAuth['url'];
                $headers = $telegramAuth['headers'];

                $response = Http::withHeaders($headers)
                    ->withOptions(['verify' => false])
                    ->timeout($timeout)
                    ->connectTimeout($connectTimeout)
                    ->post($url, $body);
            }

            if ($response->successful()) {
                $data = $response->json('data');
                return is_array($data) ? $data : [];
            } else {
                Log::warning("[TelegramNotif] Gagal kirim ke user_id={$userId} | Status: {$response->status()} | Body: {$response->body()}");
                return null;
            }
        } catch (\Exception $e) {
            Log::error("[TelegramNotif] Exception saat kirim ke user_id={$userId}: {$e->getMessage()}");
            return null;
        }
    }
}
