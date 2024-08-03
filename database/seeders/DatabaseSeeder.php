<?php

namespace Database\Seeders;

use App\Models\MahasiswaProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            [
                'nama_depan' => 'admin',
                'nama_belakang' => null,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 2
                'nama_depan' => 'itb',
                'nama_belakang' => null,
                'email' => 'itb@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                // 3
                'nama_depan' => 'its',
                'nama_belakang' => null,
                'email' => 'its@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 4
                'nama_depan' => 'PT GoTo Gojek Tokopedia Tbk',
                'nama_belakang' => null,
                'email' => 'goto@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 5
                'nama_depan' => 'PT. Pemasaran Digital Nusantara',
                'nama_belakang' => null,
                'email' => 'pemasaran@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 6
                'nama_depan' => 'Yazid',
                'nama_belakang' => '',
                'email' => 'yazid@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // 7
                'nama_depan' => 'Bustomi',
                'nama_belakang' => '',
                'email' => 'bustomi@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
        $this->call([
            JurusanKampusSeeder::class,
            AlamatSeeder::class,
            AkademikProfileSeeder::class,
            MahasiswaProfileSeeder::class,
            LowonganSeeder::class,
            PendaftarSeeder::class,
            SosmedSeeder::class,
        ]);
    }
}
