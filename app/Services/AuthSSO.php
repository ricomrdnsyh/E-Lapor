<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthSSO
{
    protected string $cacheKey = 'sso_auth';
    private string $authUrl;
    private string $newBase;
    private string $XToken;
    private string $devId;

    public function __construct()
    {
        $authUrl = (string) (config('services.sso.auth_url') ?: env('SSO_AUTH_URL'));
        $newBase = (string) (config('services.sso.data_base_url') ?: env('SSO_DATA_BASE_URL'));

        $replaceSource = config('services.sso.replace_source');
        $replaceTarget = config('services.sso.replace_target');
        if ($replaceSource && $replaceTarget && $replaceSource !== $replaceTarget) {
            $authUrl = str_replace($replaceSource, $replaceTarget, $authUrl);
            $newBase = str_replace($replaceSource, $replaceTarget, $newBase);
        }

        $this->authUrl = $authUrl;
        $this->newBase = $newBase;
        $this->XToken  = (string) (config('services.sso.x_token') ?: env('SSO_X_TOKEN', ''));
        $this->devId   = (string) (config('services.sso.dev_id') ?: env('SSO_DEV_ID', ''));
    }

    public function getAuth(): array
    {
        $cached = Cache::get($this->cacheKey);

        if ($cached && isset($cached['data_url'], $cached['headers'], $cached['expired_at'])) {
            $expiredAt = $cached['expired_at'];
            $isNotExpired = is_numeric($expiredAt)
                ? time() < (int) $expiredAt
                : ($expiredAt instanceof \DateTimeInterface ? now()->lessThan($expiredAt) : time() < strtotime((string) $expiredAt));

            if ($isNotExpired) {
                return $cached;
            }
        }

        return $this->refreshAuth();
    }

    public function refreshAuth(): array
    {
        $payload = [
            'X-Token' => $this->XToken,
            'dev_id'  => $this->devId,
        ];

        $forceIpv4   = filter_var(config('services.sso.force_ipv4', env('SSO_FORCE_IPV4', false)), FILTER_VALIDATE_BOOLEAN);
        $forceHttp11 = filter_var(config('services.sso.force_http_1_1', env('SSO_FORCE_HTTP_1_1', false)), FILTER_VALIDATE_BOOLEAN);

        $curlOptions = [];
        if ($forceIpv4) {
            $curlOptions[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
        }
        if ($forceHttp11) {
            $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        }

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'Accept'     => 'application/json',
        ];

        try {
            $response = Http::withoutVerifying()
                ->withHeaders($headers)
                ->withOptions(!empty($curlOptions) ? ['curl' => $curlOptions] : [])
                ->connectTimeout(10)
                ->timeout(30)
                ->post($this->authUrl, $payload);
        } catch (\Exception $e) {
            // Jika gagal dengan opsi cURL khusus (misal error 35 connection reset), coba fallback tanpa opsi curl khusus
            if (!empty($curlOptions)) {
                $response = Http::withoutVerifying()
                    ->withHeaders($headers)
                    ->connectTimeout(10)
                    ->timeout(30)
                    ->post($this->authUrl, $payload);
            } else {
                throw $e;
            }
        }

        if (!$response->successful()) {
            throw new \Exception(
                'Gagal authorize ke SSO (status ' . $response->status() . '): ' . $response->body()
            );
        }

        $json = $response->json();

        if (!is_array($json)) {
            throw new \Exception('Response authorize bukan JSON yang valid.');
        }

        $dataUrl     = data_get($json, 'data.info.urls.data');
        $tokenHeader = data_get($json, 'data.token_header', []);

        if (!$dataUrl || empty($tokenHeader['X-Token'])) {
            throw new \Exception('Data URL atau X-Token tidak ditemukan di response authorize.');
        }

        $path      = parse_url($dataUrl, PHP_URL_PATH);
        $tokenPart = $path ? basename($path) : null;

        $dataUrl = $tokenPart
            ? rtrim($this->newBase, '/') . '/' . $tokenPart
            : $this->newBase;

        $expiredAt = now()->addHours(6);

        $authData = [
            'data_url'   => $dataUrl,
            'headers'    => $tokenHeader,
            'created_at' => now()->timestamp,
            'expired_at' => $expiredAt->timestamp,
        ];

        Cache::put($this->cacheKey, $authData, $expiredAt);

        return $authData;
    }
}
