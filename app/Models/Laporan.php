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
        'judul_laporan',
        'tgl_kejadian',
        'lokasi_kejadian',
        'deskripsi_laporan',
        'lampiran_file',
        'is_anonymous',
        'nama_pelapor',
        'email_pelapor',
        'no_telp_pelapor',
        'tipe_pelapor',
        'status'
    ];

    protected $casts = [
        'tgl_kejadian' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    // Generate kode tiket
    public static function generateTicket()
    {
        $date = date('Ymd');
        $randomNumber = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        return 'UNUJA-ELP-' . $date . '-' . $randomNumber;
    }
}
