<?php

namespace Database\Seeders;

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
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'itb',
                'email' => 'itb@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'created_at' => now(),
                'update_at' => now()

            ],
            [
                'name' => 'its',
                'email' => 'its@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'itn',
                'email' => 'itn@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'itby',
                'email' => 'itby@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'kampus',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'jai',
                'email' => 'jai@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'ati',
                'email' => 'ati@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'sai',
                'email' => 'sai@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'perusahaan',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa1',
                'email' => 'mahasiswa1@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa2',
                'email' => 'mahasiswa2@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa3',
                'email' => 'mahasiswa3@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa4',
                'email' => 'mahasiswa4@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa5',
                'email' => 'mahasiswa5@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa6',
                'email' => 'mahasiswa6@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa7',
                'email' => 'mahasiswa7@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa8',
                'email' => 'mahasiswa8@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa9',
                'email' => 'mahasiswa9@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],
            [
                'name' => 'mahasiswa10',
                'email' => 'mahasiswa10@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'update_at' => now(),
            ],

            ]);
            $this->call([
                JurusanKampusSeeder::class,
                AlamatSeeder::class,
                AkademikProfileSeeder::class
            ]);
    }
}
