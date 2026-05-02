<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\HistoryLaporan;
use App\Models\LogStatusLaporan;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Services\TelegramNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LaporController extends Controller
{
    public function index(Request $request)
    {
        return view('landing.lapor');
    }

    public function getCategories()
    {
        $categories = Kategori::with('unit')
            ->select('id_kategori', 'nama_kategori', 'unit_id')
            ->get()
            ->map(function ($item) {
                return [
                    'id'        => $item->id_kategori,
                    'nama'      => $item->nama_kategori,
                    'unit_id'   => $item->unit_id,
                    'unit_name' => $item->unit?->nama_unit ?? 'N/A'
                ];
            });

        return response()->json($categories);
    }

    public function generateCaptcha()
    {
        $operators = ['+', '-', 'x'];
        $operator = $operators[array_rand($operators)];

        if ($operator === '+') {
            $a = rand(1, 20);
            $b = rand(1, 20);
            $answer = $a + $b;
        } elseif ($operator === '-') {
            $a = rand(5, 30);
            $b = rand(1, $a);
            $answer = $a - $b;
        } else {
            $a = rand(1, 10);
            $b = rand(1, 10);
            $answer = $a * $b;
        }

        $question = "{$a} {$operator} {$b} = ?";
        Session::put('captcha_answer', $answer);

        return response()->json(['question' => $question]);
    }

    public function store(Request $request)
    {
        $captchaInput = $request->input('captcha');
        $captchaAnswer = Session::get('captcha_answer');

        if (is_null($captchaAnswer) || (int) $captchaInput !== (int) $captchaAnswer) {
            return response()->json([
                'success' => false,
                'message' => 'Jawaban captcha salah. Silakan coba lagi.'
            ], 422);
        }

        Session::forget('captcha_answer');
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategori,id_kategori',
            'unit_id'           => 'required|exists:unit,id_unit',
            'judul_laporan'     => 'required|string|max:255',
            'lokasi_kejadian'   => 'required|string|max:150',
            'tgl_kejadian'      => 'required|date_format:Y-m-d H:i',
            'deskripsi_laporan' => 'required|string|max:2000',
            'lampiran_file'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'is_anonymous'      => 'required|in:t,y',
            'nama_pelapor'      => 'required_if:is_anonymous,t|nullable|string|max:100',
            'email_pelapor'     => 'required_if:is_anonymous,t|nullable|email|max:100',
            'no_telp_pelapor'   => 'required_if:is_anonymous,t|nullable|string|max:15',
            'tipe_pelapor'      => 'required_if:is_anonymous,t|nullable|string|in:Dosen,Mahasiswa,Tenaga Pendidik,Lainnya',
            'email_anonim'      => 'nullable|email|max:100',
            'agreement'         => 'required|accepted',
        ], [
            'kategori_id.required'        => 'Kategori laporan harus dipilih',
            'kategori_id.exists'          => 'Kategori tidak valid',
            'unit_id.required'            => 'Unit tujuan harus diisi',
            'unit_id.exists'              => 'Unit tidak valid',
            'judul_laporan.required'      => 'Judul laporan harus diisi',
            'lokasi_kejadian.required'    => 'Lokasi kejadian harus diisi',
            'tgl_kejadian.required'       => 'Tanggal dan waktu kejadian harus diisi',
            'deskripsi_laporan.required'  => 'Deskripsi laporan harus diisi',
            'lampiran_file.required'      => 'File harus diisi dan berupa jpg,jpeg,png,pdf dengan ukuran maksimal 5MB',
            'nama_pelapor.required_if'    => 'Nama pelapor harus diisi jika tidak anonim',
            'email_pelapor.required_if'   => 'Email pelapor harus diisi jika tidak anonim',
            'no_telp_pelapor.required_if' => 'Email pelapor harus diisi jika tidak anonim',
            'tipe_pelapor.required_if'    => 'Tipe pelapor harus diisi jika tidak anonim',
            'agreement.required'          => 'Anda harus menyetujui pernyataan',
        ]);

        try {
            $kode_tiket = Laporan::generateTicket();

            $lampiran_file = null;
            if ($request->hasFile('lampiran_file')) {
                $file = $request->file('lampiran_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/laporan'), $filename);
                $lampiran_file = $filename;
            }

            $nama_pelapor       = $validated['nama_pelapor'] ?? null;
            $email_pelapor      = $validated['email_pelapor'] ?? null;
            $no_telp_pelapor    = $validated['no_telp_pelapor'] ?? null;
            $tipe_pelapor       = $validated['tipe_pelapor'] ?? null;

            if ($validated['is_anonymous'] === 'y') {
                $nama_pelapor       = 'Anonymous';
                $email_pelapor      = !empty($validated['email_anonim']) ? $validated['email_anonim'] : 'Anonymous';
                $no_telp_pelapor    = 'Anonymous';
                $tipe_pelapor       = null;
            }

            $laporan = DB::transaction(function () use (
                $validated,
                $kode_tiket,
                $lampiran_file,
                $nama_pelapor,
                $email_pelapor,
                $no_telp_pelapor,
                $tipe_pelapor
            ) {
                $laporan = Laporan::create([
                    'kode_tiket'        => $kode_tiket,
                    'kategori_id'       => $validated['kategori_id'],
                    'judul_laporan'     => $validated['judul_laporan'],
                    'tgl_kejadian'      => $validated['tgl_kejadian'],
                    'lokasi_kejadian'   => $validated['lokasi_kejadian'],
                    'deskripsi_laporan' => $validated['deskripsi_laporan'],
                    'lampiran_file'     => $lampiran_file,
                    'is_anonymous'      => $validated['is_anonymous'],
                    'nama_pelapor'      => $nama_pelapor,
                    'email_pelapor'     => $email_pelapor,
                    'no_telp_pelapor'   => $no_telp_pelapor,
                    'tipe_pelapor'      => $tipe_pelapor,
                    'status'            => 'menunggu'
                ]);

                $history = HistoryLaporan::create([
                    'laporan_id'        => $laporan->id_laporan,
                    'user_id'           => null,
                    'status'            => 'menunggu',
                    'lampiran_file'     => null,
                    'catatan'           => null,
                ]);

                LogStatusLaporan::create([
                    'history_id'    => $history->id_history,
                    'user_id'       => null,
                    'status'        => 'menunggu',
                    'catatan'       => 'Laporan berhasil dikirim dengan judul ' . $laporan->judul_laporan . '.',
                ]);

                return $laporan;
            });

            // Kirim notifikasi Telegram
            try {
                app(TelegramNotificationService::class)->notifyNewLaporan($laporan);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('[TelegramNotif] Error: ' . $e->getMessage());
            }

            return response()->json([
                'success'    => true,
                'message'    => 'Laporan berhasil dibuat',
                'kode_tiket' => $kode_tiket,
                'redirect'   => route('lacak', ['kode' => $kode_tiket])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
