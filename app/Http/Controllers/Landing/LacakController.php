<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $kode           = strtoupper(trim((string) $request->query('kode', '')));
        $laporan        = null;
        $history        = collect();
        $statusMeta     = null;
        $statusSteps    = [];

        if ($kode !== '') {
            $laporan = Laporan::with(['kategori.unit', 'historyLaporans.user.unit', 'historyLaporans.logStatusLaporans.user.unit'])
                ->whereRaw('UPPER(kode_tiket) = ?', [$kode])
                ->first();

            if ($laporan) {
                $history = $laporan->historyLaporans
                    ->flatMap(function ($historyItem) {
                        return $historyItem->logStatusLaporans->map(function ($log) use ($historyItem) {
                            $log->setRelation('historyLaporan', $historyItem);
                            return $log;
                        });
                    })
                    ->sortBy('created_at')
                    ->values();

                $statusMeta  = $this->statusMeta($laporan->status);
                $statusSteps = $this->buildSteps($laporan->status);
            }
        }

        return view('landing.lacak', compact('laporan', 'history', 'statusMeta', 'statusSteps', 'kode'));
    }

    private function statusMeta(?string $status): array
    {
        return match ($status) {
            'menunggu' => [
                'label'             => 'Menunggu',
                'title'             => 'Laporan sudah diterima',
                'summary'           => 'Laporan Anda sudah masuk ke sistem dan sedang menunggu tindak lanjut awal.',
                'badge_class'       => 'light-warning',
                'track_class'       => '',
                'timeline_title'    => 'Laporan diterima',
                'timeline_note'     => 'Laporan telah masuk dan sedang menunggu tindak lanjut.',
                'icon_bg'           => 'bg-light-warning',
                'icon_color'        => 'text-warning',
                'icon'              => 'ki-time',
                'progress'          => 25,
            ],
            'diproses' => [
                'label'             => 'Diproses',
                'title'             => 'Laporan sedang diproses',
                'summary'           => 'Unit terkait sedang menangani laporan dan pembaruan akan muncul pada riwayat.',
                'badge_class'       => 'light-info',
                'track_class'       => 'is-info',
                'timeline_title'    => 'Diproses unit terkait',
                'timeline_note'     => 'Laporan sedang ditangani oleh unit terkait.',
                'icon_bg'           => 'bg-light-info',
                'icon_color'        => 'text-info',
                'icon'              => 'ki-setting-2',
                'progress'          => 65,
            ],
            'selesai' => [
                'label'             => 'Selesai',
                'title'             => 'Laporan telah diselesaikan',
                'summary'           => 'Penanganan laporan sudah selesai. Anda dapat melihat detail akhir pada riwayat.',
                'badge_class'       => 'light-success',
                'track_class'       => '',
                'timeline_title'    => 'Laporan selesai',
                'timeline_note'     => 'Penanganan laporan telah diselesaikan.',
                'icon_bg'           => 'bg-light-success',
                'icon_color'        => 'text-success',
                'icon'              => 'ki-check-circle',
                'progress'          => 100,
            ],
            'ditolak' => [
                'label'             => 'Ditolak',
                'title'             => 'Laporan tidak dapat diproses',
                'summary'           => 'Laporan ditutup dengan status ditolak. Silakan lihat catatan penolakan jika tersedia.',
                'badge_class'       => 'light-danger',
                'track_class'       => 'is-danger',
                'timeline_title'    => 'Laporan ditolak',
                'timeline_note'     => 'Laporan tidak dapat diproses lebih lanjut.',
                'icon_bg'           => 'bg-light-danger',
                'icon_color'        => 'text-danger',
                'icon'              => 'ki-cross-circle',
                'progress'          => 0,
            ],
            default => [
                'label'             => 'Tidak Diketahui',
                'title'             => 'Status laporan belum tersedia',
                'summary'           => 'Sistem belum memiliki informasi status yang bisa ditampilkan untuk laporan ini.',
                'badge_class'       => 'light-secondary',
                'track_class'       => '',
                'timeline_title'    => 'Status belum tersedia',
                'timeline_note'     => 'Belum ada informasi status untuk laporan ini.',
                'icon_bg'           => 'bg-light-secondary',
                'icon_color'        => 'text-secondary',
                'icon'              => 'ki-information-5',
                'progress'          => 0,
            ],
        };
    }

    private function buildSteps(?string $status): array
    {
        $steps = [
            ['label' => 'Menunggu', 'class' => ''],
            ['label' => 'Diproses', 'class' => ''],
            ['label' => 'Selesai', 'class'  => ''],
            ['label' => 'Ditolak', 'class'  => ''],
        ];

        return match ($status) {
            'menunggu' => [
                ['label' => 'Menunggu', 'class' => 'is-active'],
                $steps[1],
                $steps[2],
                $steps[3],
            ],
            'diproses' => [
                ['label' => 'Menunggu', 'class' => 'is-done'],
                ['label' => 'Diproses', 'class' => 'is-active'],
                $steps[2],
                $steps[3],
            ],
            'selesai' => [
                ['label' => 'Menunggu', 'class' => 'is-done'],
                ['label' => 'Diproses', 'class' => 'is-done'],
                ['label' => 'Selesai', 'class'  => 'is-done'],
                $steps[3],
            ],
            'ditolak' => [
                ['label' => 'Menunggu', 'class' => 'is-done'],
                ['label' => 'Diproses', 'class' => 'is-done'],
                $steps[2],
                ['label' => 'Ditolak', 'class'  => 'is-danger'],
            ],
            default => $steps,
        };
    }
}
