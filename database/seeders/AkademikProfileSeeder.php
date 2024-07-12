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
                'nim' => '120020',
                'semester' => '3',
                'jurusan_id' => '5',
                'admin_kampus_id' => '3'
            ],
            [
                'user_id' => '10',
                'nim' => '120021',
                'semester' => '5',
                'jurusan_id' => '6',
                'admin_kampus_id' => '3'
            ],
            [
                'user_id' => '11',
                'nim' => '100010',
                'semester' => '6',
                'jurusan_id' => '1',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '12',
                'nim' => '100011',
                'semester' => '6',
                'jurusan_id' => '2',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '13',
                'nim' => '100012',
                'semester' => '1',
                'jurusan_id' => '3',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '14',
                'nim' => '500201',
                'semester' => '3',
                'jurusan_id' => '8',
                'admin_kampus_id' => '4'
            ],
            [
                'user_id' => '15',
                'nim' => '90129',
                'semester' => '8',
                'jurusan_id' => '9',
                'admin_kampus_id' => '5'
            ],
            [
                'user_id' => '16',
                'nim' => '90128',
                'semester' => '6',
                'jurusan_id' => '10',
                'admin_kampus_id' => '5'
            ],
            [
                'user_id' => '17',
                'nim' => '2362',
                'semester' => '3',
                'jurusan_id' => '10',
                'admin_kampus_id' => '5'
            ],
            [
                'user_id' => '18',
                'nim' => '946294',
                'semester' => '1',
                'jurusan_id' => '10',
                'admin_kampus_id' => '4'
            ],
        ]);
    }
}
