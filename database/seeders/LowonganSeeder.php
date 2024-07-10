<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lowongans')->insert([
            [
                'user_id' => '6',
                'judul' => 'Produksi',
                'deskripsi' => 'Deskripsi untuk lowongan Produksi',
                'pemagang' => '2',
                'durasi_magang' => '3 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 6,
                'judul' => 'Administrasi',
                'deskripsi' => 'Deskripsi untuk lowongan Administrasi',
                'pemagang' => 2,
                'durasi_magang' => '2 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => '7',
                'judul' => 'Pemasaran',
                'deskripsi' => 'Deskripsi untuk lowongan Pemasaran',
                'pemagang' => 2,
                'durasi_magang' => '1 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'Desain Grafis',
                'deskripsi' => 'Deskripsi untuk lowongan Desain Grafis',
                'pemagang' => 2,
                'durasi_magang' => '6 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'Teknik Informatika',
                'deskripsi' => 'Deskripsi untuk lowongan Teknik Informatika',
                'pemagang' => 2,
                'durasi_magang' => '5 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Jurnalistik',
                'deskripsi' => 'Deskripsi untuk lowongan Jurnalistik',
                'pemagang' => 2,
                'durasi_magang' => '3 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Fotografi',
                'deskripsi' => 'Deskripsi untuk lowongan Fotografi',
                'pemagang' => 2,
                'durasi_magang' => '2 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Pengembangan Produk',
                'deskripsi' => 'Deskripsi untuk lowongan Pengembangan Produk',
                'pemagang' => 2,
                'durasi_magang' => '5 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 6,
                'judul' => 'Keuangan',
                'deskripsi' => 'Deskripsi untuk lowongan Keuangan',
                'pemagang' => 2,
                'durasi_magang' => '7 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'HRD',
                'deskripsi' => 'Deskripsi untuk lowongan HRD',
                'pemagang' => 2,
                'durasi_magang' => '5 bulan',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
        ]);
    }
}
