<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_create extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
            'first_name' =>'admin',
            'last_name' =>  'admin',
            'email' =>  'admin@gmail.com',
            'mobile' =>  '0',
            'second_mobile_number' => '',
          
            'password' => bcrypt(1234),
            'active_status' => 1,
            'is_admin' => 1,
            'address' => '0',
            'nic' => '0',
    
            'gender' => 1,
            'created_at' => date("Y-m-d"),
        ]);
    }
}
