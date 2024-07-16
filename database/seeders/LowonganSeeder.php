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
                'rincian' => 'rincian untuk lowongan Produksi',
                'kriteria' => 'Kriteria untuk lowongan Produksi',
                'pemagang' => '2',
                'durasi_magang' => '3',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 6,
                'judul' => 'Administrasi',
                'rincian' => 'rincian untuk lowongan Administrasi',
                'kriteria' => 'kriteria untuk lowongan Administrasi',
                'pemagang' => 5,
                'durasi_magang' => '2',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => '7',
                'judul' => 'Pemasaran',
                'rincian' => 'rincian untuk lowongan Pemasaran',
                'kriteria' => 'kriteria untuk lowongan Pemasaran',
                'pemagang' => 9,
                'durasi_magang' => '1',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'Desain Grafis',
                'rincian' => 'rincian untuk lowongan Desain Grafis',
                'kriteria' => 'kriteria untuk lowongan Desain Grafis',
                'pemagang' => 3,
                'durasi_magang' => '6',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'Teknik Informatika',
                'rincian' => 'rincian untuk lowongan Teknik Informatika',
                'kriteria' => 'kriteria untuk lowongan Teknik Informatika',
                'pemagang' => 6,
                'durasi_magang' => '5',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Jurnalistik',
                'rincian' => 'rincian untuk lowongan Jurnalistik',
                'kriteria' => 'kriteria untuk lowongan Jurnalistik',
                'pemagang' => 2,
                'durasi_magang' => '3',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Fotografi',
                'rincian' => 'rincian untuk lowongan Fotografi',
                'kriteria' => 'kriteria untuk lowongan Fotografi',
                'pemagang' => 10,
                'durasi_magang' => '2',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 8,
                'judul' => 'Pengembangan Produk',
                'rincian' => 'rincian untuk lowongan Pengembangan Produk',
                'kriteria' => 'kriteria untuk lowongan Pengembangan Produk',
                'pemagang' => 14,
                'durasi_magang' => '5',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 6,
                'judul' => 'Keuangan',
                'rincian' => 'rincian untuk lowongan Keuangan',
                'kriteria' => 'kriteria untuk lowongan Keuangan',
                'pemagang' => 1,
                'durasi_magang' => '7',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
            [
                'user_id' => 7,
                'judul' => 'HRD',
                'rincian' => 'rincian untuk lowongan HRD',
                'kriteria' => 'kriteria untuk lowongan HRD',
                'pemagang' => 4,
                'durasi_magang' => '5',
                'open_lowongan' => Carbon::now(),
                'close_lowongan' => Carbon::now()->addDays(10),
            ],
        ]);
    }
}
