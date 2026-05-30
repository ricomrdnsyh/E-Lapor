<?php
namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\SubKategori;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UnitDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $baseQuery = $this->laporanUnitQuery();

        $stats = [
            'total'     => (clone $baseQuery)->count(),
            'menunggu'  => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'diproses'  => (clone $baseQuery)->where('status', 'diproses')->count(),
            'selesai'   => (clone $baseQuery)->where('status', 'selesai')->count(),
            'ditolak'   => (clone $baseQuery)->where('status', 'ditolak')->count(),
        ];

        $scopeKategoriIds = $this->scopeKategoriIds();

        $kategoriCountsRaw = (clone $baseQuery)
            ->selectRaw('kategori_id, count(*) as total')
            ->whereNotNull('kategori_id')
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        $allKategoriIds = array_unique(array_merge(
            $scopeKategoriIds,
            array_keys($kategoriCountsRaw->toArray())
        ));

        $kategoriData = collect();
        if (!empty($allKategoriIds)) {
            $kategoriData = Kategori::whereIn('id_kategori', $allKategoriIds)
                ->get()
                ->map(function ($kat) use ($kategoriCountsRaw) {
                    return ['nama' => $kat->nama_kategori, 'total' => $kategoriCountsRaw[$kat->id_kategori] ?? 0];
                })
                ->groupBy('nama')
                ->map(function ($items) {
                    return ['nama' => $items->first()['nama'], 'total' => $items->sum('total')];
                })
                ->sortByDesc('total')
                ->values();
        }

        $subKategoriCountsRaw = (clone $baseQuery)
            ->selectRaw('sub_kategori_id, count(*) as total')
            ->whereNotNull('sub_kategori_id')
            ->groupBy('sub_kategori_id')
            ->pluck('total', 'sub_kategori_id');

        $subKategoriData = SubKategori::whereIn('kategori_id', $scopeKategoriIds)
            ->orWhere('unit_id', $user->unit_id)
            ->get()
            ->map(function ($sub) use ($subKategoriCountsRaw) {
                return ['nama' => $sub->nama_sub, 'total' => $subKategoriCountsRaw[$sub->id_sub] ?? 0];
            })
            ->groupBy('nama')
            ->map(function ($items) {
                return ['nama' => $items->first()['nama'], 'total' => $items->sum('total')];
            })
            ->sortByDesc('total')
            ->values();

        $tipePelaporRaw = (clone $baseQuery)
            ->selectRaw('tipe_pelapor, count(*) as total')
            ->whereNotNull('tipe_pelapor')
            ->groupBy('tipe_pelapor')
            ->pluck('total', 'tipe_pelapor');

        $semuaTipe = ['Dosen', 'Mahasiswa', 'Tenaga Pendidik', 'Masyarakat/Umum'];
        $tipePelapor = collect();
        foreach ($semuaTipe as $tipe) {
            $tipePelapor[$tipe] = $tipePelaporRaw[$tipe] ?? 0;
        }

        $privasiData = [
            'anonim'  => (clone $baseQuery)->where('is_anonymous', 'y')->count(),
            'rahasia' => (clone $baseQuery)->where('is_anonymous', 't')->count(),
        ];

        return view('unit.dashboard.index', compact('stats', 'user', 'kategoriData', 'subKategoriData', 'tipePelapor', 'privasiData'));
    }

    private function scopeKategoriIds(): array
    {
        $user = Auth::user();
        $kategoriIds = $user->kategoris()->pluck('kategori.id_kategori')->toArray();
        $unitKategoriIds = Kategori::where('unit_id', $user->unit_id)->pluck('id_kategori')->toArray();
        return array_unique(array_merge($kategoriIds, $unitKategoriIds));
    }

    private function laporanUnitQuery(): Builder
    {
        $user = Auth::user();
        $kategoriIds = $this->scopeKategoriIds();

        return Laporan::where(function ($q) use ($user, $kategoriIds) {
            $hasFilter = false;

            if ($user->unit_id) {
                $hasFilter = true;
                $q->whereHas('units', function ($q2) use ($user) {
                    $q2->where('unit_id', $user->unit_id);
                });
            }

            if (!empty($kategoriIds)) {
                $hasFilter = true;
                $q->orWhereIn('kategori_id', $kategoriIds);
            }

            if (!$hasFilter) {
                $q->whereRaw('0=1');
            }
        });
    }
}
