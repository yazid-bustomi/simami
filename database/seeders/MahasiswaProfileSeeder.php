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
        DB::table('profiles')->insert([
            [
                'user_id' => '6',
                'no_hp' => '085',
                'tanggal_lahir' => '1995-01-20',
                'tempat_lahir' => 'Pasuruan',
                'jenis_kelamin' => 'laki-laki',
                'agama' => 'Islam',
            ],
            [
                'user_id' => '7',
                'no_hp' => '000',
                'tanggal_lahir' => '1990-01-20',
                'tempat_lahir' => 'Pasuruan',
                'jenis_kelamin' => 'laki-laki',
                'agama' => 'Islam',
            ],

        ]);
    }
}
