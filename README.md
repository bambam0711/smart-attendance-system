# Smart Attendance Verification System

Sistem PHP/MySQL untuk pengurusan kehadiran Kelab Ping Pong SMK Tinggi Klang: pendaftaran ahli, pengurusan aktiviti, rekod kehadiran dan laporan.

**Oleh Irham Nursyafizan bin Ramli** · [Portfolio](https://bamdev.site)

![Project banner](img/Banner4.png)

## Modul

- Login dan session pengguna.
- Pendaftaran serta pengurusan ahli dan kelas.
- Pendaftaran serta pengurusan aktiviti.
- Rekod kehadiran dan laporan ahli/aktiviti.
- Import ahli daripada fail teks berformat pipe-separated.

## Jalankan secara lokal

1. Gunakan PHP dengan extension `mysqli`, MySQL/MariaDB dan web server. XAMPP ialah salah satu pilihan.
2. Letakkan folder projek dalam web root, contohnya `htdocs/smart-attendance-system`.
3. Cipta database `attendance_system` dan import `attendance_system.sql` melalui phpMyAdmin atau klien MySQL. Fail ini mengandungi schema sahaja.
4. Import `demo-data.sql` sekali untuk menyediakan kelas, aktiviti dan dua akaun rekaan.
5. Salin `config.example.php` kepada `config.local.php`. Isi host, username, password, database dan port MySQL setempat. Jika MySQL menggunakan port 3307, ubah nilai `port`.
6. Mulakan Apache/MySQL dan buka `http://localhost/smart-attendance-system/`.

### Akaun demo lokal

| Peranan | IC rekaan | Password demo |
|---|---|---|
| Admin | `000000000001` | `DemoAdmin123` |
| Ahli | `000000000002` | `DemoMember123` |

Data ini hanya untuk demo lokal. Semua baris data asal daripada SQL dan fail import telah dikeluarkan daripada salinan GitHub. Manual PDF asal tidak disertakan dalam salinan ini.

Format import: `ic_number|name|class_id|password|role`. Fail `ahli-upload-data.txt` menyediakan satu contoh rekaan; import selepas data demo kelas tersedia.

## Teknologi

PHP, MySQL/MariaDB, HTML, CSS, session dan operasi CRUD. Tiada dependency Composer diperlukan oleh kod yang disertakan.

## Skop dan batasan

Ini ialah projek pembelajaran yang dikekalkan hampir kepada kod asal, bukan aplikasi production yang telah diaudit. Kod asal menyimpan password sebagai teks biasa, menggunakan interpolasi input dalam SQL, menerima role daripada borang pendaftaran dan belum melaksanakan perlindungan CSRF secara menyeluruh. Gunakan hanya secara lokal dengan data rekaan; jangan deploy dengan data sebenar sebelum isu ini diperbaiki.

Perubahan penyediaan repo: konfigurasi database diasingkan, port dibuat eksplisit, data asal dibuang dan data demo ditambah. PHP lint, import database dan ujian aliran aplikasi belum dijalankan kerana runtime PHP/MySQL belum tersedia dalam persekitaran penyediaan.
