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
                'nama_jurusan' => 'Kedokteran'
            ],
            [
                // jurusan itb user id 2
                'user_id' => '2',
                'nama_jurusan' => 'Multimedia'
            ],
            [
                // jurusan itb user id 2
                'user_id' => '2',
                'nama_jurusan' => 'Pertanian'
            ],
            [
                // jurusan its user id 3
                'user_id' => '3',
                'nama_jurusan' => 'Kimia'
            ],
            [
                // jurusan its user id 3
                'user_id' => '3',
                'nama_jurusan' => 'Industri'
            ],
            [
                // jurusan its user id 3
                'user_id' => '3',
                'nama_jurusan' => 'Pergudangan'
            ],
            [
                // jurusan itn user id 4
                'user_id' => '4',
                'nama_jurusan' => 'Pendidikan'
            ],
            [
                // jurusan itby user id 5
                'user_id' => '5',
                'nama_jurusan' => 'STI'
            ],
            [
                // jurusan itby user id 5
                'user_id' => '5',
                'nama_jurusan' => 'SI'
            ],
        ]);
    }
}
