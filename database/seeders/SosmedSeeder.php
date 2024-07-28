<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sosmeds')->insert([
            [
                'user_id' => 4,
                'instagram' => 'https://www.instagram.com/infogoto/',
                'twiter' => 'https://x.com/gojektech',
                'linkedin' => 'https://id.linkedin.com/company/gotogroup',
                'website' => 'https://www.gotocompany.com/'
            ],
            [
                'user_id' => 5,
                'instagram' => 'https://www.instagram.com/diginusantara/',
                'facebook' => 'https://web.facebook.com/diginusantara',
                'linkedin' => 'https://www.linkedin.com/company/diginusantara',
                'website' => 'https://www.diginusantara.com/'
            ]
        ]);
    }
}
