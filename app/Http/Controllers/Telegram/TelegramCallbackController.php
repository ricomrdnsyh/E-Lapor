<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\HistoryLaporan;
use App\Models\Laporan;
use App\Models\LogStatusLaporan;
use App\Models\TelegramOutboxLaporan;
use App\Models\User;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramCallbackController extends Controller
{
    /**
     * Menerima webhook balasan pesan dari SSO UNUJA Telegram.
     */
    public function handle(Request $request)
    {
        $rawPayload = json_encode($request->all());
        $event = $request->input('event');
        Log::warning('[TelegramCallback] Webhook diterima | event: ' . ($event ?? 'null') . ' | payload: ' . $rawPayload);

        if ($event !== 'telegram.message_replied') {
            return response()->json([
                'success' => false,
                'message' => 'Event tidak dikenali atau diabaikan: ' . $event,
            ], 200);
        }

        // Ambil identifier outbox dari berbagai kemungkinan format SSO/Telegram
        $outboxId = $request->input('outbox_id')
            ?? $request->input('outboxId')
            ?? $request->input('original_outbox_id')
            ?? $request->input('reply.outbox_id')
            ?? $request->input('reply.original_outbox_id');

        $origMsgId = $request->input('original_telegram_message_id')
            ?? $request->input('reply_to_message_id')
            ?? $request->input('original_message_id')
            ?? $request->input('reply_to_message.message_id')
            ?? $request->input('reply.original_telegram_message_id')
            ?? $request->input('reply.reply_to_message_id')
            ?? $request->input('reply.reply_to_message.message_id')
            ?? $request->input('reply.telegram_message_id')
            ?? $request->input('message.reply_to_message.message_id')
            ?? $request->input('reply_to.message_id');

        $originalMessage = $request->input('original_message')
            ?? $request->input('reply_to_message.text')
            ?? $request->input('message.reply_to_message.text')
            ?? '';

        $senderUserId = $request->input('sender.user_id')
            ?? $request->input('user_id')
            ?? $request->input('sender.username');

        $chatId = $request->input('chat_id')
            ?? $request->input('sender.chat_id')
            ?? $request->input('message.chat.id')
            ?? $request->input('reply.chat_id');

        $replyInput = $request->input('reply');
        $rawReply   = trim((string) (
            $request->input('reply.catatan') 
            ?? $request->input('reply.text') 
            ?? (is_string($replyInput) ? $replyInput : '')
            ?? $request->input('text')
            ?? $request->input('catatan')
            ?? $request->input('message.text')
            ?? ''
        ));

        // Tentukan status dan ekstrak catatan berdasarkan kata kunci
        $targetStatus = 'diproses';
        $catatan      = $rawReply;

        // Cek apakah ada kata kunci TOLAK
        if (preg_match('/^\s*(?:\[\s*(?:tolak|menolak)\s*\]|#\s*(?:tolak|menolak)|tolak|menolak)\s*[:\-\s]\s*(.*)$/iu', $rawReply, $matches)) {
            $targetStatus = 'ditolak';
            $catatan      = trim($matches[1]);
        } elseif (preg_match('/^\s*(?:\[\s*(?:tolak|menolak)\s*\]|#\s*(?:tolak|menolak)|tolak|menolak)\s*$/iu', $rawReply)) {
            $targetStatus = 'ditolak';
            $catatan      = '';
        } elseif (preg_match('/^\s*(?:\[\s*(?:proses|memproses)\s*\]|#\s*(?:proses|memproses)|proses|memproses)\s*[:\-\s]\s*(.*)$/iu', $rawReply, $matches)) {
            $targetStatus = 'diproses';
            $catatan      = trim($matches[1]);
        } elseif (preg_match('/^\s*(?:\[\s*(?:proses|memproses)\s*\]|#\s*(?:proses|memproses)|proses|memproses)\s*$/iu', $rawReply)) {
            $targetStatus = 'diproses';
            $catatan      = '';
        } elseif (preg_match('/\b(?:tolak|menolak)\b/i', $rawReply) && !preg_match('/\b(?:proses|memproses|terima)\b/i', $rawReply)) {
            $targetStatus = 'ditolak';
        }

        if (empty($catatan)) {
            $catatan = $targetStatus === 'ditolak'
                ? 'Laporan ditolak via balasan chat Telegram'
                : 'Laporan diproses via balasan chat Telegram';
        }

        // 1. Cari data Outbox di database
        $outbox = null;
        if ($outboxId || $origMsgId) {
            try {
                $outbox = TelegramOutboxLaporan::where(function ($query) use ($outboxId, $origMsgId) {
                    if ($outboxId) {
                        $query->where('outbox_id', $outboxId);
                    }
                    if ($origMsgId) {
                        $query->orWhere('telegram_message_id', $origMsgId);
                    }
                })->latest()->first();
            } catch (\Exception $e) {
                Log::warning('[TelegramCallback] Gagal query outbox: ' . $e->getMessage());
            }
        }

        // Failsafe 1: Cari UUID dari payload jika outbox belum cocok
        if (!$outbox && preg_match_all('/[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/i', $rawPayload, $uuidMatches)) {
            try {
                $outbox = TelegramOutboxLaporan::whereIn('outbox_id', $uuidMatches[0])->latest()->first();
            } catch (\Exception $e) {}
        }

        // Failsafe 2: Cari angka ID pesan Telegram (5-15 digit) dari payload jika belum cocok
        if (!$outbox && preg_match_all('/\b\d{5,15}\b/', $rawPayload, $intMatches)) {
            try {
                $outbox = TelegramOutboxLaporan::whereIn('telegram_message_id', $intMatches[0])->latest()->first();
            } catch (\Exception $e) {}
        }

        $laporan = null;
        $history = null;

        if ($outbox) {
            $laporan = $outbox->laporan ?? Laporan::find($outbox->laporan_id);
            $history = $outbox->historyLaporan ?? HistoryLaporan::find($outbox->history_id) ?? $laporan?->historyLaporans()->latest()->first();
        }

        // Fallback 1: ekstrak kode tiket dari teks pesan asli
        if (!$laporan && !empty($originalMessage)) {
            $msgString = is_string($originalMessage) ? $originalMessage : json_encode($originalMessage);
            if (preg_match('/(?:UNUJA-ELP-[0-9]+-[0-9]+|[A-Z0-9]+-ELP-[0-9]+-[0-9]+)/i', $msgString, $matches)) {
                $laporan = Laporan::where('kode_tiket', trim($matches[0]))->first();
                if ($laporan) {
                    $history = $laporan->historyLaporans()->latest()->first();
                }
            }
        }

        // Fallback 2: cari kode tiket di SELURUH isi payload JSON yang dikirimkan SSO
        if (!$laporan) {
            if (preg_match('/(?:UNUJA-ELP-[0-9]+-[0-9]+|[A-Z0-9]+-ELP-[0-9]+-[0-9]+)/i', $rawPayload, $matches)) {
                $laporan = Laporan::where('kode_tiket', trim($matches[0]))->first();
                if ($laporan) {
                    $history = $laporan->historyLaporans()->latest()->first();
                }
            }
        }

        // Pastikan HistoryLaporan ada jika Laporan ditemukan
        if (!$history && $laporan) {
            $history = $laporan->historyLaporans()->latest()->first();
            if (!$history) {
                $history = HistoryLaporan::create([
                    'laporan_id' => $laporan->id_laporan,
                    'status'     => 'menunggu',
                ]);
            }
        }

        if (!$laporan || !$history) {
            Log::warning('[TelegramCallback] Laporan atau History tidak ditemukan | outbox_id: ' . $outboxId . ' | orig_msg_id: ' . $origMsgId . ' | payload: ' . $rawPayload);
            return response()->json([
                'success' => false,
                'message' => 'Laporan terkait tidak ditemukan di sistem E-Lapor.',
            ], 404);
        }

        // 2. Cari data User yang membalas pesan
        $user = null;
        if ($senderUserId) {
            $user = User::where('username', $senderUserId)->first();
        }
        if (!$user && $chatId) {
            $user = User::where('telegram_id', (string) $chatId)->first();
        }
        if (!$user && $outbox && $outbox->user) {
            $user = $outbox->user;
        }

        $userId = $user?->id ?? null;

        // Update telegram_id jika belum ada di database
        if ($user && $chatId && empty($user->telegram_id)) {
            $user->update(['telegram_id' => (string) $chatId]);
        }

        // 3. Cek apakah laporan sudah selesai atau ditolak
        if (in_array($history->status, ['selesai', 'ditolak'])) {
            return response()->json([
                'success' => true,
                'message' => "Laporan #{$laporan->kode_tiket} sudah ditutup sebelumnya dengan status: {$history->status}.",
            ]);
        }

        // 4. Update status dan simpan catatan tindak lanjut secara atomic
        \Illuminate\Support\Facades\DB::transaction(function () use ($history, $laporan, $userId, $catatan, $targetStatus) {
            $history->update([
                'user_id' => $userId ?? $history->user_id,
                'status'  => $targetStatus,
                'catatan' => $catatan,
            ]);

            LogStatusLaporan::create([
                'history_id' => $history->id_history,
                'user_id'    => $userId ?? $history->user_id,
                'status'     => $targetStatus,
                'catatan'    => $catatan,
            ]);

            $laporan->update([
                'status' => $targetStatus,
            ]);
        });

        // 5. Kirim notifikasi email ke pelapor
        try {
            app(EmailNotificationService::class)->notifyLaporanUpdate(
                $laporan,
                $targetStatus,
                $catatan
            );
        } catch (\Exception $e) {
            Log::error('[TelegramCallback] Gagal kirim email: ' . $e->getMessage());
        }

        $statusUpper = strtoupper($targetStatus);

        return response()->json([
            'success' => true,
            'message' => "Laporan #{$laporan->kode_tiket} berhasil diubah ke status {$statusUpper}.",
            'data'    => [
                'kode_tiket' => $laporan->kode_tiket,
                'status'     => $targetStatus,
                'catatan'    => $catatan,
            ],
        ]);
    }
}
