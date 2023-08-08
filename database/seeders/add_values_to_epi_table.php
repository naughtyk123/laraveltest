<?php

namespace Database\Seeders;

use App\Models\EpiGeneratedValues;
use Illuminate\Database\Seeder;

class add_values_to_epi_table extends Seeder
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
            

            EpiGeneratedValues::insert(
            [

                'master_data_quater'=>$count,
                'facility_id'=>1,
                'epi_value'=>rand(10,100),
                'year'=>'2023',
                'added_by'=>1,
   
            ]);

            if($count!=4){
                $count++;
            }else{
                $count=1;
            }
        }

    }
}
