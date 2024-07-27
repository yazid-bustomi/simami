<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendaftars')->insert([
            [
                'user_id' => '6',
                'lowongan_id' => '1',
                'status' => 'pending',
            ],
            [
                'user_id' => '7',
                'lowongan_id' => '2',
                'status' => 'pending',
            ],

        ]);
    }
}
