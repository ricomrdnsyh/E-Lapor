<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSsoTracking extends Model
{
    protected $table = 'laporan_sso_trackings';

    protected $fillable = [
        'laporan_id',
        'sso_nim_nip',
        'sso_nama',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id_laporan');
    }
}
