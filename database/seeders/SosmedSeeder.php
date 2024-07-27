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
                'instagram' => 'fintechid',
                'facebook' => 'fintechID',
                'twiter' => 'Ffintechid',
                'linkedin' => 'asosiasi-fintech-indonesia',
                'website' => 'fintech.id'
            ],
            [
                'user_id' => 5,
                'instagram' => 'emerhub.id',
                'facebook' => 'emerhub',
                'twiter' => 'Femerhub',
                'linkedin' => 'companies-house-group',
                'website' => 'companieshouse.id'
            ]
        ]);
    }
}
