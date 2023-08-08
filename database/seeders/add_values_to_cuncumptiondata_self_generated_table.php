<?php

namespace Database\Seeders;

use App\Models\ConsumptionDataSelf;
use Illuminate\Database\Seeder;

class add_values_to_cuncumptiondata_self_generated_table extends Seeder
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
        for ($i = 1; $i < 20; $i++) {
            $rad1 = rand(10, 100000000);
            $rad2 = rand(10, 1000000);
            ConsumptionDataSelf::insert(
                [

                    'facility_id' => 1,
                    'form_id' => 1,
                    'uom_id' => 1,
                    'month_id' => $count,
                    'master_data_elec_id' => $elecid,
                    'consumption_value_generation' => $rad1,
                    'consumption_value_export' => $rad2,
                    'solar_consuption' => $rad1 - $rad2,
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
        $count = 1;
        $elecid = 1;
        for ($i = 1; $i < 20; $i++) {
            $rad1 = rand(10, 100000000);
            $rad2 = rand(10, 1000000);
            ConsumptionDataSelf::insert(
                [

                    'facility_id' => 1,
                    'form_id' => 1,
                    'uom_id' => 1,
                    'month_id' => $count,
                    'master_data_elec_id' => 1,
                    'consumption_value_generation' => $rad1*100,
                    'consumption_value_export' => $rad2,
                    'solar_consuption' => $rad1 - $rad2,
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
        $count = 1;
        $elecid = 1;
        for ($i = 1; $i < 20; $i++) {
            $rad1 = rand(10, 100000000);
            $rad2 = rand(10, 1000000);
            ConsumptionDataSelf::insert(
                [

                    'facility_id' => 1,
                    'form_id' => 1,
                    'uom_id' => 1,
                    'month_id' => $count,
                    'master_data_elec_id' => rand(1, 3),
                    'consumption_value_generation' => $rad1*1000,
                    'consumption_value_export' => $rad2,
                    'solar_consuption' => $rad1 - $rad2,
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
        $count = 1;
        $elecid = 1;
        for ($i = 1; $i < 20; $i++) {
            $rad1 = rand(10, 100000000);
            $rad2 = rand(10, 1000000);
            ConsumptionDataSelf::insert(
                [

                    'facility_id' => 1,
                    'form_id' => 1,
                    'uom_id' => 1,
                    'month_id' => $count,
                    'master_data_elec_id' => 3,
                    'consumption_value_generation' => $rad1*1100,
                    'consumption_value_export' => $rad2,
                    'solar_consuption' => $rad1 - $rad2,
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
