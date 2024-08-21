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
                'user_id' => '6',
                'nim' => '9874028',
                'semester' => '3',
                'jurusan_id' => '2',
                'admin_kampus_id' => '2'
            ],
            [
                'user_id' => '7',
                'nim' => '118228032',
                'semester' => '5',
                'jurusan_id' => '3',
                'admin_kampus_id' => '3'
            ],

        ]);
    }
}
