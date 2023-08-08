<?php

namespace Database\Seeders;

use App\Models\ConsumptionDataSolid;
use Illuminate\Database\Seeder;

class addsolid_data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $count = 1;
        $elecid = 1;
        for ($i = 1; $i < 40; $i++) {
            $rad1 = rand(10, 100000);
            $rad2 = rand(10,10000);
            ConsumptionDataSolid::insert(
                [
                    'facility_id' => 1,
                    'form_id' => 1,
                    'uom_id' => 1,
                    'month_id' => rand(1, 12),
                    'master_data_solid_fules_id' => rand(1, 3),
                    'consumption_value' => $rad1,
                    'year' => '2023',
                    'added_by' => 1,
             

                ]
            );

            if ($count != 12) {
                $count++;
            } else {
                $count = 1;
            }
            if ($elecid != 3) {
                $elecid++;
            } else {
                $elecid = 1;
            }
        }
    }
}
