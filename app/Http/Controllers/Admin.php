<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin extends Controller
{
 
    public function login(Request $request)
    {

        if (cache()->has('user_online_')) {
            cache()->pull('user_online_' . Auth::user()->id);
        }

        Auth::logout();
     
        $sit_data = [
            'prev' =>'dashboard',
        ];
        // Auth::logout();
        session()->pull('user');
      
        if (request()->session()->has('user')) {
            request()->session()->pull('user');


            return view('admin.login', $sit_data);
        }


        return view('admin.login', $sit_data);
    }

    public function testforum(Request $request)
    {
        // if ($id != null) {
        // // var_dump($id);
        // $str='sdafasd'.$id;
        // return $str;
        // }
    }

    public function mailsend()
    {

        // return view('email.sendpassword');

        $message = [
            'title' => '',
            'message' => 'Your password is 1234',
            'name' => 'Hi kasun',
        ];
        $data = [
            'email' => 'kwijayarathnek@gmail.com'
        ];
        $data = $data + $message;
        dispatch(new \App\Jobs\SendPassword($data));
    }

    public function forget_password(){

        $sit_data = [
            'title' =>'Forget Password',
        ];


        return view('admin.forget', $sit_data);

    }
    public function chart(){

        $sit_data = [
            'title' =>'Forget Password',
        ];


        return view('charts.chart', $sit_data);

    }
}