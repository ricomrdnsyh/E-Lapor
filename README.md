# E-Lapor (Kanal Resmi Pengaduan & Aspirasi Civitas Akademika)

E-Lapor adalah aplikasi berbasis web yang dibangun menggunakan **Laravel** untuk memfasilitasi proses pelaporan, pengaduan, dan layanan terpadu dalam sebuah institusi. Aplikasi ini memungkinkan pengguna untuk membuat laporan dengan detail spesifik lokasi (Gedung, Lantai, Ruangan) dan kategori laporan, serta melacak status laporan mereka. Aplikasi ini juga terintegrasi dengan sistem **Single Sign-On (SSO)**.

## Fitur Utama

Aplikasi ini memiliki beberapa modul dan hak akses pengguna (Roles), yaitu:

### 1. Halaman Publik (Landing Page)

- **Beranda**: Halaman utama informasi E-Lapor.
- **Buat Laporan (Lapor)**: Form pengajuan laporan oleh pengguna, dilengkapi dengan pilihan lokasi (Gedung, Lantai, Ruangan) dan kategori laporan. Terintegrasi dengan Captcha.
- **Lacak Laporan (Lacak)**: Fitur bagi pengguna untuk melacak status laporan menggunakan nomor resi/tiket.
- **Statistik**: Menampilkan data statistik laporan yang masuk dan diselesaikan.
- **FAQ & Alur**: Informasi panduan dan alur penggunaan sistem.

### 2. Panel Admin (`role: admin`)

- **Dashboard**: Ringkasan data laporan, grafik, dan statistik unit.
- **Manajemen Master Data**:
    - Unit (Sinkronisasi data dari API tersedia)
    - Kategori & Sub-Kategori Laporan
    - Master Lokasi: Gedung, Lantai, Fungsi Ruangan, dan Ruangan
- **Manajemen Laporan**: Melihat laporan masuk, menugaskan ke unit terkait, dan memperbarui status laporan (History Laporan).
- **Manajemen Pengguna**: Mengelola pengguna sistem dan integrasi data karyawan via API.
- **Manajemen Panduan**: Mengelola konten panduan sistem.

### 3. Panel Unit (`role: unit`)

- **Dashboard**: Ringkasan laporan yang ditugaskan ke unit bersangkutan, beserta data sub-kategori laporan.
- **History Laporan**: Melihat dan menindaklanjuti laporan yang masuk ke unit.
- **Panduan**: Panduan operasional untuk unit pengguna.

### 4. Panel Pimpinan (`role: pimpinan`)

- **Dashboard**: Ringkasan eksekutif dan statistik pelaporan berdasarkan sub-kategori untuk pemantauan.
- **History Laporan**: Pemantauan semua laporan yang ada di dalam sistem (Read-only view).
- **Panduan**: Panduan penggunaan sistem untuk level pimpinan.

### 5. Integrasi SSO & Manajemen Sesi

Sistem telah terintegrasi dengan layanan Single Sign-On (SSO) untuk autentikasi pengguna terpusat:

- Mendukung pemisahan login untuk pengajuan laporan (`/sso/lapor`) dan akses admin/unit (`/sso/admin`).
- Terdapat fitur pilihan peran (Role Selection) jika satu akun memiliki banyak wewenang.
- **Session Timeout**: Otomatis mengalihkan (redirect) pengguna ke halaman SSO login jika sesi idle atau kedaluwarsa.
- **Logout Behavior**: Proses logout dirancang untuk menghapus sesi lokal terlebih dahulu sebelum melakukan redirect ke portal SSO agar sesi global tetap aman bila diperlukan.

---

## 🔔 Notifikasi Realtime (Telegram & Email)

Aplikasi E-Lapor dilengkapi dengan sistem notifikasi _realtime_ untuk memastikan setiap pihak terkait segera mendapatkan informasi saat terjadi pembaruan status laporan:

- **Notifikasi Bot Telegram**:
    - **Admin**: Akan menerima notifikasi Telegram untuk **semua** laporan baru yang masuk ke dalam sistem.
    - **Unit**: Akan menerima notifikasi Telegram khusus untuk laporan yang masuk ke unit bersangkutan (disesuaikan berdasarkan **kategori laporan** pengguna).
- **Notifikasi Email (Pelapor)**:
  Pengguna (pelapor) akan menerima notifikasi via Email yang berisi informasi detail laporan beserta **kode tiket/resi**. Pelapor juga akan otomatis menerima email notifikasi progres jika laporan mereka telah mulai **diproses** atau sudah **disetujui/diselesaikan**.

---

## 🔄 Alur Kerja Pelaporan (Workflow)

Aplikasi ini menggunakan alur kerja tiket pengaduan terpusat dengan langkah-langkah berikut:

1. **Pengajuan (User)**: Pengguna (Mahasiswa/Dosen/Tendik) mengajukan laporan melalui halaman `/lapor`, melampirkan foto bukti, dan memilih lokasi serta kategori. Laporan akan mendapatkan status **"Menunggu"**.
2. **Verifikasi & Penugasan (Admin)**: Admin memeriksa laporan masuk. Jika valid, admin akan meneruskan (assign) laporan tersebut ke **Unit** terkait (misal: Unit IT, Unit Sarpras). Status berubah menjadi **"Diproses"**.
3. **Tindak Lanjut (Unit)**: Unit yang ditugaskan akan menerima laporan, melakukan penanganan di lapangan, dan memberikan pembaruan (_update progress_) di sistem.
4. **Penyelesaian (Unit/Admin)**: Setelah masalah teratasi, Unit mengubah status laporan menjadi **"Selesai"**. Pengguna dapat melacak status penyelesaian menggunakan nomor tiket mereka di halaman `/lacak`.
5. **Pemantauan (Pimpinan)**: Pimpinan dapat melihat rekapitulasi data dan durasi penyelesaian laporan untuk evaluasi kinerja unit.

---

## 📜 Lisensi

Aplikasi E-Lapor ini dikembangkan untuk kebutuhan internal institusi (Proprietary). Segala bentuk distribusi atau komersialisasi di luar lingkup institusi dilarang tanpa izin resmi.
