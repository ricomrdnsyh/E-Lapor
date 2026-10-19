<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramOutboxLaporan extends Model
{
    protected $table = 'telegram_outbox_laporans';

    protected $fillable = [
        'outbox_id',
        'telegram_message_id',
        'chat_id',
        'user_id',
        'laporan_id',
        'history_id',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id', 'id_laporan');
    }

    public function historyLaporan()
    {
        return $this->belongsTo(HistoryLaporan::class, 'history_id', 'id_history');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
