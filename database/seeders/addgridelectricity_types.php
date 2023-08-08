<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addgridelectricity_types extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_data_electricity')->insert([
            ['type' => 'Grid Electricity'],
            ['type' => 'Solar Power'],
            ['type' => 'Wind Power'],
        ]);
    }
}
