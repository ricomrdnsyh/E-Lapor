<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Laporan</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6fa; font-family:'Segoe UI',Roboto,Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
        style="background-color:#f4f6fa; padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px; width:100%; background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08);">

                    {{-- Header --}}
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #1F4788 0%, #2B5EA7 100%); padding:32px 40px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:22px; font-weight:700; letter-spacing:-0.02em;">
                                E-LAPOR UNUJA
                            </h1>
                            <p style="margin:8px 0 0; color:rgba(255,255,255,0.85); font-size:14px;">
                                Sistem Pengaduan & Aspirasi
                            </p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:32px 40px;">

                            @php
                                $statusConfig = match ($statusBaru) {
                                    'menunggu' => [
                                        'label' => 'Menunggu',
                                        'icon' => '⏳',
                                        'bg' => '#fff3cd',
                                        'color' => '#856404',
                                        'bannerBg' => '#fffbeb',
                                        'message' => 'Laporan Anda sedang menunggu untuk ditinjau.',
                                    ],
                                    'diproses' => [
                                        'label' => 'Sedang Diproses',
                                        'icon' => '🔄',
                                        'bg' => '#d1ecf1',
                                        'color' => '#0c5460',
                                        'bannerBg' => '#e8f4f8',
                                        'message' => 'Laporan Anda sedang ditindaklanjuti oleh unit terkait.',
                                    ],
                                    'selesai' => [
                                        'label' => 'Selesai',
                                        'icon' => '✅',
                                        'bg' => '#d4edda',
                                        'color' => '#155724',
                                        'bannerBg' => '#e8f5e9',
                                        'message' => 'Laporan Anda telah selesai ditangani. Terima kasih atas partisipasi Anda.',
                                    ],
                                    'ditolak' => [
                                        'label' => 'Ditolak',
                                        'icon' => '❌',
                                        'bg' => '#f8d7da',
                                        'color' => '#721c24',
                                        'bannerBg' => '#fdecea',
                                        'message' => 'Laporan Anda tidak dapat diproses lebih lanjut.',
                                    ],
                                    default => [
                                        'label' => ucfirst($statusBaru),
                                        'icon' => '📋',
                                        'bg' => '#e2e3e5',
                                        'color' => '#383d41',
                                        'bannerBg' => '#f0f0f0',
                                        'message' => 'Status laporan Anda telah diperbarui.',
                                    ],
                                };
                            @endphp

                            {{-- Status Banner --}}
                            <div
                                style="text-align:center; margin-bottom:24px; padding:20px; background-color:{{ $statusConfig['bannerBg'] }}; border-radius:8px;">
                                <div style="font-size:36px; margin-bottom:6px;">{{ $statusConfig['icon'] }}</div>
                                <div style="font-size:13px; color:#888; text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:6px;">
                                    Status Diperbarui
                                </div>
                                <div style="font-size:18px; font-weight:700; color:{{ $statusConfig['color'] }};">
                                    {{ $statusConfig['label'] }}
                                </div>
                            </div>

                            <p style="color:#333; font-size:15px; line-height:1.6; margin:0 0 20px;">
                                {{ $statusConfig['message'] }}
                            </p>

                            {{-- Kode Tiket --}}
                            <div
                                style="text-align:center; margin:20px 0; padding:16px; background-color:#e8f0fe; border-radius:10px; border:2px dashed #1F4788;">
                                <div style="color:#666; font-size:11px; text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:6px;">
                                    Kode Tiket
                                </div>
                                <div style="color:#1F4788; font-size:24px; font-weight:800; letter-spacing:1px;">
                                    {{ $laporan->kode_tiket }}
                                </div>
                            </div>

                            {{-- Detail Laporan --}}
                            <div
                                style="margin:24px 0; padding:20px; background-color:#fafbfd; border-radius:8px; border:1px solid #e8ecf1;">
                                <div
                                    style="font-size:14px; font-weight:700; color:#333; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e8ecf1;">
                                    📋 Detail Laporan
                                </div>
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Judul</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px; font-weight:600;">
                                            {{ $laporan->judul_laporan }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Kategori</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px;">
                                            {{ $laporan->kategori?->nama_kategori ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Status</td>
                                        <td style="padding:6px 0; font-size:13px;">
                                            <span
                                                style="display:inline-block; padding:3px 10px; background-color:{{ $statusConfig['bg'] }}; color:{{ $statusConfig['color'] }}; border-radius:4px; font-weight:600; font-size:12px;">
                                                {{ $statusConfig['label'] }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            {{-- Catatan --}}
                            @if ($catatan)
                                <div
                                    style="margin:0 0 24px; padding:16px 20px; background-color:#fff8e1; border-left:4px solid #ffc107; border-radius:0 8px 8px 0;">
                                    <div
                                        style="font-size:13px; font-weight:700; color:#333; margin-bottom:6px;">
                                        💬 Catatan dari Petugas
                                    </div>
                                    <div style="font-size:13px; color:#555; line-height:1.6;">
                                        {{ $catatan }}
                                    </div>
                                </div>
                            @endif

                            {{-- CTA Button --}}
                            <div style="text-align:center; margin:28px 0 16px;">
                                <a href="{{ route('lacak', ['kode' => $laporan->kode_tiket]) }}"
                                    style="display:inline-block; padding:14px 36px; background-color:#1F4788; color:#ffffff; text-decoration:none; border-radius:8px; font-weight:700; font-size:14px;">
                                    🔍 Lacak Laporan Saya
                                </a>
                            </div>

                            <p style="color:#999; font-size:12px; text-align:center; margin:0;">
                                Anda juga dapat melacak laporan melalui menu <strong>Lacak</strong> di website E-Lapor.
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td
                            style="padding:20px 40px; background-color:#f8f9fb; border-top:1px solid #e8ecf1; text-align:center;">
                            <p style="margin:0 0 4px; color:#999; font-size:11px;">
                                Email ini dikirim secara otomatis oleh sistem E-Lapor UNUJA.
                            </p>
                            <p style="margin:0; color:#bbb; font-size:11px;">
                                Jika Anda merasa tidak terkait dengan laporan ini, abaikan email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
