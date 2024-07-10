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
                'nama_depan' => 'itn',
                'nama_belakang' => null,
                'email' => 'itn@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'itby',
                'nama_belakang' => null,
                'email' => 'itby@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'jai',
                'nama_belakang' => null,
                'email' => 'jai@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'ati',
                'nama_belakang' => null,
                'email' => 'ati@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'sai',
                'nama_belakang' => null,
                'email' => 'sai@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '1',
                'email' => 'mahasiswa1@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '2',
                'email' => 'mahasiswa2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '3',
                'email' => 'mahasiswa3@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '4',
                'email' => 'mahasiswa4@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '5',
                'email' => 'mahasiswa5@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '6',
                'email' => 'mahasiswa6@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '7',
                'email' => 'mahasiswa7@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '8',
                'email' => 'mahasiswa8@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '9',
                'email' => 'mahasiswa9@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'remember_token' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_depan' => 'mahasiswa',
                'nama_belakang' => '10',
                'email' => 'mahasiswa10@gmail.com',
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
        ]);
    }
}
