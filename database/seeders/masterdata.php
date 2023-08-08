<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class masterdata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_data_liquid')->insert([
            ['type' => 'Petrol'],
            ['type' => 'Diesel'],
            ['type' => 'Kerosene'],
        ]);

        DB::table('masterdata_gas')->insert([
            ['type' => 'Hydrogen'],
            ['type' => 'Nitrogen'],
            ['type' => 'Helium'],
        ]);

        DB::table('masterdata_solidfuel')->insert([
            ['type' => 'Wood'],
            ['type' => 'Charcoal'],
            ['type' => 'Coal'],
        ]);
        DB::table('masterdatawater')->insert([
            ['type' => 'Geothermal Energy'],
            ['type' => 'Hydropower'],
            ['type' => 'Tidal Energy'],
        ]);
    }
}
