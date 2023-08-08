<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addmonth extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        
        DB::table('master_data_month')->insert([
            [
                'month' => 'January',
                'quater'=>1,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'February',
                'quater'=>1,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'March',
                'quater'=>1,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'April',
                'quater'=>2,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'May',
                'quater'=>2,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'June',
                'quater'=>2,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'July',
                'quater'=>3,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'August',
                'quater'=>3,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'September',
                'quater'=>3,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'October',
                'quater'=>4,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'November',
                'quater'=>4,
                'status'=>1,
                'added_by'=>1,
            ],
            [
                'month' => 'December',
                'quater'=>4,
                'status'=>1,
                'added_by'=>1,
            ],
          
        ]);
    }
}
