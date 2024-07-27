<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanKampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('jurusan_kampuses')->insert([
            [
                // jurusan itb user id 2
                'user_id' => '2',
                'nama_jurusan' => 'Informatika'
            ],
            [
                // jurusan itb user id 2
                'user_id' => '2',
                'nama_jurusan' => 'Multimedia'
            ],
            [
                // jurusan its user id 3
                'user_id' => '3',
                'nama_jurusan' => 'Kimia'
            ],
            [
                // jurusan its user id 3
                'user_id' => '3',
                'nama_jurusan' => 'Fisika'
            ],
        ]);
    }
}
