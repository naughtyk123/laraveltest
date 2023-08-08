<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $sit_data = [
            'title' =>'Dashboard',
        ];


        return view('admin.dashboard', $sit_data);
    }

    public function company_register(){
        $sit_data = [
            'title' =>'Company Register',
        ];


        return view('admin.company_register', $sit_data);
    }

    public function icons(){
        $sit_data = [
            'title' =>'Icons',
        ];


        return view('admin.icons', $sit_data);
    }
    


}







