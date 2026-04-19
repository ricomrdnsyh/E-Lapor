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
}
