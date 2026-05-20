<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'kode_tiket',
        'kategori_id',
        'sub_kategori_id',
        'judul_laporan',
        'tgl_kejadian',
        'ruangan_id',
        'deskripsi_laporan',
        'lampiran_file',
        'is_anonymous',
        'nama_pelapor',
        'email_pelapor',
        'no_telp_pelapor',
        'tipe_pelapor',
        'status',
    ];

    protected $casts = [
        'tgl_kejadian' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class, 'sub_kategori_id', 'id_sub');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }

    public function historyLaporans()
    {
        return $this->hasMany(HistoryLaporan::class, 'laporan_id', 'id_laporan');
    }

    public function logStatusLaporans()
    {
        return $this->hasManyThrough(
            LogStatusLaporan::class,
            HistoryLaporan::class,
            'laporan_id',
            'history_id',
            'id_laporan',
            'id_history'
        );
    }

    // Generate kode tiket
    public static function generateTicket()
    {
        $date = date('Ymd');
        $randomNumber = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);

        return 'UNUJA-ELP-' . $date . '-' . $randomNumber;
    }
}
