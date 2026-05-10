<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SsoController extends Controller
{
    public function sso(Request $request)
    {
        $responseData = $this->verifySsoToken($request);

        if ($responseData instanceof \Illuminate\Http\JsonResponse) {
            return $responseData;
        }

        $this->registerSsoCallback($request, $responseData);

        $identifier = $responseData['nim'] ?? $responseData['id_penduduk'] ?? null;
        $tipe = $this->determineTipe($responseData);

        $request->session()->put('sso_user', [
            'nama'    => $responseData['nama'] ?? $responseData['nama_penduduk'] ?? '',
            'email'   => $responseData['email'] ?? '',
            'no_telp' => $responseData['no_hp'] ?? $responseData['telepon'] ?? $responseData['no_telp'] ?? $responseData['hp'] ?? $responseData['phone'] ?? $responseData['nohp'] ?? '',
            'tipe'    => $tipe,
        ]);

        if ($identifier) {
            $user = User::where('username', $identifier)->first();

            if ($user && in_array($user->role, ['admin', 'unit'])) {
                $this->syncUserFromSso($user, $responseData);

                $request->session()->put('sso_pending_user_id', $user->id);
                $request->session()->put('sso_pending_role', $user->role);

                return redirect()->route('sso.pilih');
            }
        }

        return redirect()->route('lapor');
    }

    public function pilih(Request $request)
    {
        if (!$request->session()->has('sso_pending_user_id')) {
            return redirect()->route('lapor');
        }

        $ssoUser = $request->session()->get('sso_user', []);
        $role = $request->session()->get('sso_pending_role', 'unit');

        return view('landing.sso-pilih', compact('ssoUser', 'role'));
    }

    public function pilihDashboard(Request $request)
    {
        $userId = $request->session()->get('sso_pending_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        Auth::login($user);

        $request->session()->forget(['sso_pending_user_id', 'sso_pending_role']);

        // Refresh user instance to reflect any SSO-synced data
        $user->refresh();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard.index'),
            'unit'  => redirect()->route('unit.dashboard.index'),
            default => redirect()->route('beranda'),
        };
    }

    public function pilihLapor(Request $request)
    {
        $request->session()->forget(['sso_pending_user_id', 'sso_pending_role']);

        return redirect()->route('lapor');
    }

    public function lapor(Request $request)
    {
        $responseData = $this->verifySsoToken($request);

        if ($responseData instanceof \Illuminate\Http\JsonResponse) {
            return $responseData;
        }

        $tipe = $this->determineTipe($responseData);

        $request->session()->put('sso_user', [
            'nama'    => $responseData['nama'] ?? $responseData['nama_penduduk'] ?? '',
            'email'   => $responseData['email'] ?? '',
            'no_telp' => $responseData['no_hp'] ?? $responseData['telepon'] ?? $responseData['no_telp'] ?? $responseData['hp'] ?? $responseData['phone'] ?? $responseData['nohp'] ?? '',
            'tipe'    => $tipe,
        ]);

        $this->registerSsoCallback($request, $responseData);

        return redirect()->route('lapor');
    }

    public function admin(Request $request)
    {
        $responseData = $this->verifySsoToken($request);

        if ($responseData instanceof \Illuminate\Http\JsonResponse) {
            return $responseData;
        }

        $identifier = $responseData['nim'] ?? $responseData['id_penduduk'] ?? null;

        if (!$identifier) {
            return response()->json(['error' => 'Invalid user data'], 400);
        }

        $user = User::where('username', $identifier)->first();

        if (!$user) {
            abort(401, 'User belum terdaftar / tidak punya akses.');
        }

        $this->syncUserFromSso($user, $responseData);

        Auth::login($user);

        $this->registerSsoCallback($request, $responseData);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard.index'),
            'unit'  => redirect()->route('unit.dashboard.index'),
            default => redirect()->route('beranda'),
        };
    }

    private function determineTipe(array $responseData): string
    {
        if (isset($responseData['nim'])) {
            return 'Mahasiswa';
        }

        if (!empty($responseData['nidn'])) {
            return 'Dosen';
        }

        if (!empty($responseData['id_struktur'])) {
            return 'Tenaga Pendidik';
        }

        return 'Masyarakat/Umum';
    }

    /**
     * Sync/update local user data from SSO response.
     */
    private function syncUserFromSso(User $user, array $responseData): void
    {
        $nama       = $responseData['nama'] ?? $responseData['nama_penduduk'] ?? null;
        $username    = $responseData['nim'] ?? $responseData['id_penduduk'] ?? null;
        $telegramId = $responseData['telegram_id'] ?? null;

        $updateData = [];

        if ($nama && $nama !== $user->nama) {
            $updateData['nama'] = $nama;
        }

        if ($username && $username !== $user->username) {
            $updateData['username'] = $username;
        }

        if ($telegramId && $telegramId !== $user->telegram_id) {
            $updateData['telegram_id'] = $telegramId;
        }

        if (!empty($updateData)) {
            $user->update($updateData);
        }
    }

    private function verifySsoToken(Request $request)
    {
        $devId = env('SSO_LAPOR_DEV_ID', 'Ji5Rs5Vj2Kc2Wt0F');
        $url = env('SSO_ME_URL', 'http://sso.unuja.ac.id:8080/portal/me') . '/' . $devId;
        $access_token = $request->access_token;
        $xToken = env('SSO_LAPOR_X_TOKEN', 'pB6OpgW1L8XmnhV4');
        $UserAgent = $request->header('User-Agent');

        if (!$access_token) {
            return response()->json(['error' => 'Access token is missing'], 400);
        }

        $response = $this->makeCurlRequest($url, $access_token, $xToken, $UserAgent);

        if (is_string($response)) {
            return response()->json(['error' => $response], 500);
        }

        if (!isset($response['success']) || !$response['success'] || $response['data'] == null) {
            return response()->json([
                'error' => $response['message'] ?? 'SSO authentication failed',
            ], 401);
        }

        $request->attributes->set('sso_access_token', $access_token);
        $request->attributes->set('sso_x_token', $xToken);
        $request->attributes->set('sso_user_agent', $UserAgent);

        return $response['data'];
    }

    public function logout(string $sessionId)
    {
        Auth::logout();
        $sessionPath = config('session.files');
        $sessionFile = $sessionPath . '/' . $sessionId;

        if (file_exists($sessionFile)) {
            unlink($sessionFile);
        }

        session()->flush();
        session()->invalidate();
        session()->regenerateToken();

        return response()->json(['message' => 'Logout successful'], 200);
    }

    private function registerSsoCallback(Request $request, array $responseData): void
    {
        $accessToken = $request->attributes->get('sso_access_token');
        $xToken      = $request->attributes->get('sso_x_token');
        $UserAgent   = $request->attributes->get('sso_user_agent');

        $callbackUrl = str_replace("https://sso.unuja.ac.id", "http://sso.unuja.ac.id:8080", $responseData['callback_session']);
        $logoutUrl   = str_replace("https://sso.unuja.ac.id", "http://sso.unuja.ac.id:8080", $responseData['logout_session']);

        $phpSessionId = $request->session()->getId();

        $data = [
            "logout" => "http://lapor.unuja.ac.id:8080/sso/logout/" . $phpSessionId,
        ];

        $this->makeCurlRequest($callbackUrl, $accessToken, $xToken, $UserAgent, $data);
        $request->session()->put('logout_session', $logoutUrl);
    }

    private function makeCurlRequest($url, $authorizationToken, $xToken, $UserAgent, $data = null)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POST           => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => array_filter([
                "Authorization: Bearer $authorizationToken",
                "X-Token: $xToken",
                "User-Agent: $UserAgent",
                $data ? "Content-Type: application/json" : null,
            ]),
            CURLOPT_POSTFIELDS => $data ? json_encode($data) : null,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error: " . $err;
        }

        $decodedResponse = json_decode($response, true);

        return $decodedResponse;
    }
}
