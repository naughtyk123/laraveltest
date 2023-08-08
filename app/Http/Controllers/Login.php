<?php

namespace App\Http\Controllers;

use App\CentralLogics\Uservalidation;
use App\Mail\Reset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            session()->pull('user');
            $user = User::where('email', $request->email)->first();


            $sit_data = [
                'title' => trans('messages.dashboard_title'),
            ];            // broadcast(new OnlineCheck(Auth::user()->id));            // return view('admin.dashboard', $sit_data);
            $logic = new Uservalidation();



            if ($user->active_status == 1) {
                session()->put('user', $user);
                // date_default_timezone_set("Indian/Maldives");
                $result_up = User::where('id',  $user->id)
                    ->update(['last_login_time' => date("Y-m-d h:i:s")]);
                session()->put('user', $user);
                $prev = $request->prev;
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('login')->with('error', 'User is not active');
            }
        } else {
            return redirect()->route('login')->with('error', 'Login Failed');
        }
    }
    public function farmerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            session()->pull('user');
            $user = User::where('email', $request->email)->first();

            if ($user->active_status == 1) {
                session()->put('user', $user);
                $sit_data = [
                    'title' => trans('messages.dashboard_title'),
                ];
                return redirect()->route('login')->with('success', 'Login Successfull');
            } else {
                return redirect()->route('login')->with('error', 'User is not active');
            }
        } else {
            return redirect()->back()->with('error', 'Login Failed');
        }
    }
    public function logout()
    {

        User::where('id', Auth::user()->id)
            ->update(['last_login_time' => date("Y-m-d h:i:s")]);

        Auth::logout();
        session()->pull('user');

        return redirect()->route('login');
    }
    public function farmerLogout(Request $request)
    {
        Auth::logout();
        session()->pull('user');

        return redirect()->back();
    }

    public function resetemail(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',


        ], [


            'email.required' => trans('messages.Email address required'),
            'email.email' => trans('messages.Email address not valid'),

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $user = User::where('email', $request->email)->first();
        // var_dump($user->first_name);
        $token = md5(rand(1, 10) . microtime());

        if ($user) {
            $data =
                [
                    'reset_token' => $token,
                ];

            $result = User::where('email',  $request->email)
                ->update($data);
            $data = [
                'name' => $user->first_name,
                'token' => $token
            ];

            Mail::to($request->email)->send(new Reset($data));

            return response()->json([
                'status' => 'true',
                'message' => 'We sent a mail to you please check',

            ]);
        } else {

            return response()->json([
                'status' => 'false',
                'message' => 'User not found',

            ]);
        }
    }
    public function change_password_view(Request $request)
    {

        $sit_data = [
            'title' => 'Reset Password',
            'token' => $request->id
        ];


        return view('admin.reset_password', $sit_data);
    }
    public function resetpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'primary_password' => 'required|same:password',
            'password' => 'required'


        ], [


            'primary_password.required' => 'Please enter password',
            'primary_password.same' => 'Password dont match',
            'primary_password.required_with' => 'Please enter password',
            'password.required' => 'Please confirme password',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data =
            [
                'reset_token' => '',
                'password' => bcrypt($request->password),

            ];
        $result = User::where('reset_token',  $request->token)
            ->update($data);
        // return redirect()->route('login');
        // return redirect()->route('login')->with('success', 'Password Resting Successfull');
        return response()->json([
            'status' => 'true',
            'message' => 'login',

        ]);
    }
}
