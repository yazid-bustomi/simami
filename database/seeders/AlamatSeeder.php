<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alamats')->insert([
            [
                'user_id' => '2',
                'provinsi' => 'jawa barat',
                'kab_kot' => 'Kota Bandung',
                'kecamatan' => 'coblong',
                'desa' => 'siliwangi',
                'alamat' => 'Jl. Ganesa No.10',
                'kode_pos' => '40132',
            ],
            [
                'user_id' => '3',
                'provinsi' => 'jawa timur',
                'kab_kot' => 'kota surabaya',
                'kecamatan' => 'sukolilo',
                'desa' => 'keputih',
                'alamat' => 'jl. its surabaya',
                'kode_pos' => '60111',
            ],
            [
                'user_id' => '4',
                'provinsi' => 'Jawa timur',
                'kab_kot' => 'Kota Malang',
                'kecamatan' => 'lowokwaru',
                'desa' => 'sumbersari',
                'alamat' => 'Jl. Sigura - Gura No.2',
                'kode_pos' => '65152'
            ],
            [
                'user_id' => '5',
                'provinsi' => 'jawa timur',
                'kab_kot' => 'pasuruan',
                'kecamatan' => 'bangil',
                'desa' => 'kersikan',
                'alamat' => 'Jl. Salem No.3',
                'kode_pos' => '67153'
            ],
            [
                'user_id' => '9',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '10',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '11',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '12',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '13',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '14',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '15',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '15',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Winongan',
                'desa' => 'Sidepan',
                'alamat' => 'Umbulan Sidepan',
                'kode_pos' => '67182',
            ],
        ]);
    }
}
