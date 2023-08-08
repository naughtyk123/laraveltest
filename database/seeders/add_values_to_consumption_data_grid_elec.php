<?php

namespace Database\Seeders;

use App\Models\ConsumptionDataElec;
use Illuminate\Database\Seeder;

class add_values_to_consumption_data_grid_elec extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count=1;
        for($i=1;$i<20;$i++){

            ConsumptionDataElec::insert(
            [

                'facility_id'=>1,
                'form_id'=>1,
                'uom_id'=>1,
                'month_id'=>$count,
                'master_data_grid_type_id'=>1,
                'consumption_value'=>rand(10,100),
                'peak'=>rand(10,10000),
                'off_peak'=>rand(10,10000),
                'day'=>rand(10,10000),
                'max_demand'=>rand(10,10000),
                'year'=>'2023',
                'added_by'=>1,

            ]);

            if($count!=12){
                $count++;
            }else{
                $count=1;
            }
        }
    }
}
