<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkademikProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akademik_profiles')->insert([
            [
                'user_id' => '9',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '5',
                'admin_kampus_id' => '3'
            ],
            [
                'user_id' => '10',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '6',
                'admin_kampus_id' => '3'
            ],
            [
                'user_id' => '11',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '1',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '12',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '2',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '13',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '3',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '14',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '8',
                'admin_kampus_id' => '4'
            ],
            [
                'user_id' => '15',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '9',
                'admin_kampus_id' => '5'
            ],
            [
                'user_id' => '15',
                'perguruan_tinggi' => 'ITB',
                'jurusan_id' => '10',
                'admin_kampus_id' => '5'
            ],
        ]);
    }
}
