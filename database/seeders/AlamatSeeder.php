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
                'provinsi' => ' DKI Jakarta ',
                'kab_kot' => 'Jakarta Selatan',
                'kecamatan' => '',
                'desa' => '',
                'alamat' => 'Jl. Gatot Subroto No. 123',
                'kode_pos' => '12930'
            ],
            [
                'user_id' => '5',
                'provinsi' => 'Jawa Barat',
                'kab_kot' => 'Bandung',
                'kecamatan' => '',
                'desa' => '',
                'alamat' => 'Jl. Braga No. 45',
                'kode_pos' => '40111'
            ],
            [
                'user_id' => '6',
                'provinsi' => 'Jawa Timur',
                'kab_kot' => 'Pasuruan',
                'kecamatan' => 'Bangil',
                'desa' => 'Kersikan',
                'alamat' => '',
                'kode_pos' => '67182',
            ],
            [
                'user_id' => '7',
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
