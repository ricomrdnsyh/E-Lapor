<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SsoAccessTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Deteksi jika menerima lemparan access_token dari SSO di URL
        if ($request->has('access_token')) {
            $accessToken = $request->query('access_token');
            
            // Masukkan app_secret aplikasi e-Lapor
            $appSecret = config('services.sso.x_token', env('SSO_X_TOKEN', ''));

            // 2. Pecah JWT token menjadi 3 bagian
            $parts = explode('.', $accessToken);
            if (count($parts) === 3) {
                $payloadBase64 = strtr($parts[1], '-_', '+/');
                $signatureBase64 = strtr($parts[2], '-_', '+/');
                $signatureRaw = base64_decode($signatureBase64);

                // 3. Verifikasi Tanda Tangan JWT menggunakan HMAC-SHA256 lokal
                $calculatedSignature = hash_hmac('sha256', $parts[0] . '.' . $parts[1], $appSecret, true);

                // Jika tanda tangan cocok (Token valid & diterbitkan oleh SSO Unuja)
                if (hash_equals($calculatedSignature, $signatureRaw)) {
                    $payload = json_decode(base64_decode($payloadBase64), true);

                    // 4. Periksa apakah token belum expired
                    if (isset($payload['exp']) && $payload['exp'] > time()) {
                        $clientId = $payload['client_id'] ?? null; // NIM / ID Penduduk user dari SSO
                        
                        if ($clientId) {
                            // EKSEKUSI SESI LOGIN DI e-LAPOR:
                            $user = \App\Models\User::where('username', $clientId)->first();
                            if ($user) {
                                \Illuminate\Support\Facades\Auth::login($user);
                            }
                        }

                        // 5. REDIRECT BERSIH: Buat ulang URL tanpa access_token agar bersih dari browser
                        $params = $request->query();
                        unset($params['access_token']);
                        unset($params['token_type']);

                        $cleanPath = $request->path();
                        $cleanUrl = $cleanPath === '/' ? '/' : '/' . $cleanPath;
                        if (!empty($params)) {
                            $cleanUrl .= '?' . http_build_query($params);
                        }

                        return redirect($cleanUrl);
                    }
                }
            }
        }

        return $next($request);
    }
}
