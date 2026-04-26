<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ClientSSO
{
    public function __construct(
        protected AuthSSO $auth
    ) {}

    public function getUnitFromApi(): array
    {
        $auth = $this->auth->getAuth();

        $url     = $auth['data_url'];
        $headers = $auth['headers'];

        $payload = [
            'filter'     => 'lembaga',
            'pagination' => 'off',
        ];

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::withHeaders($headers)
            ->timeout(60)
            ->connectTimeout(10)
            ->post($url, $payload);

        if ($response->status() === 401) {
            $auth    = $this->auth->refreshAuth();
            $url     = $auth['data_url'];
            $headers = $auth['headers'];

            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::withHeaders($headers)
                ->withoutVerifying()
                ->connectTimeout(30)
                ->timeout(120)
                ->post($url, $payload);
        }

        $response->throw();

        return $response->json('data') ?? [];
    }

    public function getKaryawanFromApi(): array
    {
        $auth    = $this->auth->getAuth();
        $url     = $auth['data_url'];
        $headers = $auth['headers'];

        $allKaryawan = [];
        $seen = [];

        for ($idLembaga = 1; $idLembaga <= 17; $idLembaga++) {
            try {
                $payload = [
                    'filter'     => 'karyawan',
                    'id_lembaga' => $idLembaga,
                    'pagination' => 'off',
                ];

                $response = Http::withHeaders($headers)
                    ->withoutVerifying()
                    ->withOptions([
                        'curl' => [
                            CURLOPT_IPRESOLVE    => CURL_IPRESOLVE_V4,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        ],
                    ])
                    ->connectTimeout(10)
                    ->timeout(30)
                    ->post($url, $payload);

                if ($response->status() === 401 && $idLembaga <= 2) {
                    $auth    = $this->auth->refreshAuth();
                    $url     = $auth['data_url'];
                    $headers = $auth['headers'];

                    $response = Http::withHeaders($headers)
                        ->withoutVerifying()
                        ->withOptions([
                            'curl' => [
                                CURLOPT_IPRESOLVE    => CURL_IPRESOLVE_V4,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            ],
                        ])
                        ->connectTimeout(10)
                        ->timeout(30)
                        ->post($url, $payload);
                }

                $data = $response->json('data') ?? [];

                foreach ($data as $item) {
                    $idPenduduk = $item['id_penduduk'] ?? null;
                    if ($idPenduduk && !isset($seen[$idPenduduk])) {
                        $seen[$idPenduduk] = true;
                        $allKaryawan[] = [
                            'id_penduduk'    => $idPenduduk,
                            'nama_penduduk'  => $item['nama_penduduk'] ?? '-',
                            'telegram_id'    => $item['telegram_id'] ?? null,
                            'lembaga'        => $item['lembaga'] ?? '-',
                            'struktur'       => $item['struktur'] ?? '-',
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning("[ClientSSO] Gagal fetch karyawan id_lembaga={$idLembaga}: {$e->getMessage()}");
                continue;
            }
        }
        usort($allKaryawan, fn($a, $b) => strcasecmp($a['nama_penduduk'], $b['nama_penduduk']));

        return $allKaryawan;
    }
}
