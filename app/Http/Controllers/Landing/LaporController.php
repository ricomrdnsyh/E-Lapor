<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\HistoryLaporan;
use App\Models\Kategori;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                    'unit_name' => $item->unit->nama_unit ?? 'N/A'
                ];
            });

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'       => 'required|exists:kategori,id_kategori',
            'unit_id'           => 'required|exists:unit,id_unit',
            'judul_laporan'     => 'required|string|max:255',
            'lokasi_kejadian'   => 'required|string|max:150',
            'tgl_kejadian'      => 'required|date_format:Y-m-d H:i',
            'deskripsi_laporan' => 'required|string|max:2000',
            'lampiran_file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'is_anonymous'      => 'required|in:t,y',
            'nama_pelapor'      => 'required_if:is_anonymous,t|nullable|string|max:100',
            'email_pelapor'     => 'required_if:is_anonymous,t|nullable|email|max:100',
            'no_telp_pelapor'   => 'required_if:is_anonymous,t|nullable|string|max:15',
            'tipe_pelapor'      => 'required_if:is_anonymous,t|nullable|string|in:Dosen,Mahasiswa,Karyawan,Lainnya',
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
                $email_pelapor      = 'Anonymous';
                $no_telp_pelapor    = 'Anonymous';
                $tipe_pelapor       = null;
            }

            DB::transaction(function () use (
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

                HistoryLaporan::create([
                    'laporan_id'    => $laporan->id_laporan,
                    'user_id'       => null,
                    'status'        => 'menunggu',
                    'catatan'       => null,
                ]);
            });

            return response()->json([
                'success'    => true,
                'message'    => 'Laporan berhasil dibuat',
                'kode_tiket' => $kode_tiket,
                'redirect'   => route('lacak')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
