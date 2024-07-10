<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mahasiswa_profiles')->insert([
            [
                'user_id' => '9',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '10',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '11',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '12',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '13',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '14',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '15',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '16',
                'no_hp' => '085000000000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '17',
                'no_hp' => '0000',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'agama' => 'Islam',
            ],

        ]);
    }
}
