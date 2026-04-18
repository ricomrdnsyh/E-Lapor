<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStatusLaporan extends Model
{
    protected $table = 'log_status_laporan';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'history_id',
        'user_id',
        'status',
        'catatan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function historyLaporan()
    {
        return $this->belongsTo(HistoryLaporan::class, 'history_id', 'id_history');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
