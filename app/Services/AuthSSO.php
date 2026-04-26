<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthSSO
{
    protected string $cacheKey = 'sso_auth';

    private string $authUrl    = 'https://sso.unuja.ac.id/portal/data/authorize';
    private string $XToken     = 'FLVtfNC5KrTxVHOJ';
    private string $devId      = '8ZiVo95nM1xUJzhA';

    public function getAuth(): array
    {
        $cached = Cache::get($this->cacheKey);

        if ($cached && isset($cached['data_url'], $cached['headers'], $cached['expired_at'])) {
            if (now()->lessThan($cached['expired_at'])) {
                return $cached;
            }
        }

        return $this->refreshAuth();
    }

    public function refreshAuth(): array
    {
        $payload = [
            'X-Token'  => $this->XToken,
            'dev_id'   => $this->devId,
        ];

        $curlOptions = [];
        if (filter_var(env('TELEGRAM_FORCE_IPV4', true), FILTER_VALIDATE_BOOLEAN)) {
            $curlOptions[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
        }
        if (filter_var(env('TELEGRAM_FORCE_HTTP_1_1', true), FILTER_VALIDATE_BOOLEAN)) {
            $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        }

        $response = Http::withoutVerifying()
            ->withOptions(['curl' => $curlOptions])
            ->connectTimeout(10)
            ->timeout(30)
            ->post($this->authUrl, $payload);

        if (! $response->successful()) {
            throw new \Exception('Gagal authorize ke API (status ' . $response->status() . '): ' . $response->body());
        }

        $json = $response->json();

        if (! is_array($json)) {
            throw new \Exception('Response authorize bukan JSON yang valid.');
        }

        $dataUrl     = data_get($json, 'data.info.urls.data');
        $tokenHeader = data_get($json, 'data.token_header', []);

        if (! $dataUrl || empty($tokenHeader['X-Token'])) {
            throw new \Exception('Data URL atau X-Token tidak ditemukan di response authorize.');
        }

        $newBase = 'https://sso.unuja.ac.id/portal/data/data';

        $path      = parse_url($dataUrl, PHP_URL_PATH);
        $tokenPart = $path ? basename($path) : null;

        if ($tokenPart) {
            $dataUrl = rtrim($newBase, '/') . '/' . $tokenPart;
        } else {
            $dataUrl = $newBase;
        }

        $createdAt = now();
        $expiredAt = now()->addHours(6);

        $authData = [
            'data_url'   => $dataUrl,
            'headers'    => $tokenHeader,
            'created_at' => $createdAt,
            'expired_at' => $expiredAt,
        ];

        Cache::put($this->cacheKey, $authData, $expiredAt);

        return $authData;
    }
}
