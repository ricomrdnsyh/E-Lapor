<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Berhasil Dikirim</title>
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
                            {{-- Success Badge --}}
                            <div
                                style="text-align:center; margin-bottom:24px; padding:16px; background-color:#e8f5e9; border-radius:8px;">
                                <div style="font-size:32px; margin-bottom:4px;">✅</div>
                                <div style="color:#2e7d32; font-size:16px; font-weight:700;">Laporan Berhasil Dikirim!
                                </div>
                            </div>

                            <p style="color:#333; font-size:15px; line-height:1.6; margin:0 0 20px;">
                                Terima kasih telah mengirimkan laporan melalui E-Lapor UNUJA. Laporan Anda telah kami
                                terima dan akan segera diproses oleh tim terkait.
                            </p>

                            {{-- Kode Tiket --}}
                            <div
                                style="text-align:center; margin:24px 0; padding:20px; background-color:#e8f0fe; border-radius:10px; border:2px dashed #1F4788;">
                                <div style="color:#666; font-size:12px; text-transform:uppercase; font-weight:600; letter-spacing:1px; margin-bottom:8px;">
                                    Kode Tiket Anda
                                </div>
                                <div style="color:#1F4788; font-size:28px; font-weight:800; letter-spacing:1px;">
                                    {{ $laporan->kode_tiket }}
                                </div>
                                <div style="color:#888; font-size:12px; margin-top:8px;">
                                    Simpan kode ini untuk melacak status laporan
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
                                            Unit Tujuan</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px;">
                                            {{ $laporan->kategori?->unit?->nama_unit ?? '-' }}</td>
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
                                            Sub Kategori</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px;">
                                            {{ $laporan->subKategori?->nama_sub ?? '-' }}</td>
                                    </tr>                                    
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Lokasi Kejadian</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px;">
                                            @if($laporan->ruangan)
                                                {{ $laporan->ruangan->lantai->gedung->nama_gedung ?? '' }} - {{ $laporan->ruangan->lantai->nama_lantai ?? '' }} - {{ $laporan->ruangan->nama_ruangan }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Tanggal Kejadian</td>
                                        <td style="padding:6px 0; color:#333; font-size:13px;">
                                            {{ $laporan->tgl_kejadian ? $laporan->tgl_kejadian->locale('id')->isoFormat('DD MMMM YYYY, HH:mm') : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="padding:6px 0; color:#888; font-size:13px; width:140px; vertical-align:top;">
                                            Status</td>
                                        <td style="padding:6px 0; font-size:13px;">
                                            <span
                                                style="display:inline-block; padding:3px 10px; background-color:#fff3cd; color:#856404; border-radius:4px; font-weight:600; font-size:12px;">
                                                Menunggu
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

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
                                Jika Anda tidak merasa membuat laporan, abaikan email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
