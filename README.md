# Sistem Manajemen Magang Industri

Sistem ini dirancang untuk memfasilitasi manajemen program magang industri antara kampus, perusahaan, dan mahasiswa. Terdapat beberapa jenis pengguna dengan fungsionalitas yang berbeda sesuai peran mereka.

## Fitur Utama

### 1. Admin
- **CRUD Kampus**: Admin dapat menambah, mengubah, menghapus, dan melihat daftar kampus.
- **CRUD Perusahaan**: Admin dapat menambah, mengubah, menghapus, dan melihat daftar perusahaan yang berpartisipasi dalam program magang.

### 2. Kampus
- **CRUD Mahasiswa**: Kampus dapat menambah, mengubah, menghapus, dan melihat data mahasiswa yang terdaftar.
- **Approve Mahasiswa**: Kampus memiliki wewenang untuk menyetujui mahasiswa yang layak mengikuti program magang.

### 3. Perusahaan
- **CRUD Lowongan**: Perusahaan dapat menambah, mengubah, menghapus, dan melihat lowongan magang yang tersedia.
- **Terima Mahasiswa**: Perusahaan dapat menerima mahasiswa yang telah di-approve oleh kampus untuk mengikuti program magang.

### 4. Mahasiswa
- **Melamar Magang**: Mahasiswa dapat mencari dan melamar lowongan magang yang tersedia di perusahaan setelah mendapatkan persetujuan dari kampus.

## Teknologi yang Digunakan
- **Bahasa**: PHP V.8
- **Database**: MySQL
- **Framework**: Laravel

## Cara Menjalankan Proyek
1. Clone repositori ini: `git clone https://github.com/yazid-bustomi/simami.git`
2. Copy File .env.example. `cp .env.example .env`
3. Jalankan perintah: `php artisan key:generate`
4. Jalankan migrasi database: `php artisan migrate`
5. Jalankan Seeders: `php artisan db:seed`
6. Jalankan server: `php artisan serve`

## Kontribusi
Jika ingin berkontribusi, silakan fork repositori ini dan ajukan pull request.

## Tampilan Aplikasi

Berikut adalah beberapa tampilan utama dari sistem manajemen magang industri:

### 1. Admin

Admin dapat melihat, menambah, mengubah, dan menghapus data kampus serta perusahaan.
![CRUD Kampus](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Admin/2%20NavTab%20Kampus.png)
![CRUD Perusahaan](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Admin/6%20NavTab%20Perusahaan.png)

### 2. Kampus

Kampus dapat mengelola data mahasiswa dan memberikan persetujuan kepada mahasiswa untuk melamar magang.
![CRUD Mahasiswa](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Kampus/11%20NavTab%20Mahasiswa.png)
![Approve Mahasiswa](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Kampus/20%20NavTab%20Pendaftar.png)

### 3. Perusahaan

Perusahaan dapat menambah lowongan magang dan menerima mahasiswa yang telah disetujui oleh kampus.
![CRUD Lowongan](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Perusahaan/4%20success%20input%20lowongan.png)
![Terima Mahasiswa](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Perusahaan/5%20seleksi%20perusahaan.png)

### 4. Mahasiswa

Mahasiswa dapat melihat dan melamar lowongan magang yang tersedia.
![Lamar Lowongan Magang](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Mahasiswa/2%20navtab%20lowonga.png)
![Status Pendaftaran](https://raw.githubusercontent.com/yazid-bustomi/simami/main/Tampilan%20Aplikasi/Mahasiswa/7%20status%20pendaftaran.png)

