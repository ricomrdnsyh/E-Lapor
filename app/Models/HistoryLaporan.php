<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryLaporan extends Model
{
    protected $table = 'history_laporan';

    protected $primaryKey = 'id_history';

    protected $fillable = [
        'laporan_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'lampiran_file',
        'catatan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id_laporan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
