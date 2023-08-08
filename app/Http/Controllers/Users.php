<?php

namespace App\Http\Controllers;

use App\Models\Blog_detail;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserGroupMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    // get user creation view add bykasun 2022/6/21
    public  function index()
    {

        // $locations = Locations::get();
        $sit_data = [
            'title' => 'Register User',
        ];
        return view('admin.create_user', $sit_data);
    }

    public  function create_blog()
    {

        // $locations = Locations::get();
        $sit_data = [
            'title' => 'Create Blog',
        ];
        return view('admin.create_blog', $sit_data);
    }

    public  function blog_update(Request $request)
    {
        $blogs = Blog_detail::where('id', '=', $request->id)->first();
        $sit_data = [
            'title' => 'update Blog',
            'blogs' => $blogs
        ];
        return view('admin.update_blog', $sit_data);
    }
    public  function delete_blog(Request $request)
    {
        $res=Blog_detail::where('id',$request->id)->delete();
        
        if ($res) {
            return response()->json([
                'status' => 'true',
                'message' => 'blog deleted',

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('Something Wrong'),

            ]);
        }
    }

    

    public  function blog_list(Request $request)
    {
        $blogs = Blog_detail::where('user','=', Auth::user()->id)->paginate(5);
        $sit_data = [
            'title' => 'blog list',
            'blogs' => $blogs
        ];
        return view('admin.blog_list', $sit_data);
    }

    public  function update_details(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'blog' => 'required',
            'title' => 'required',
            'summery' => 'required',


        ], [

    
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        if ($request->hasfile('cover')) {

            $file = $request->file('cover');
            $path = $file->store('public/vender/');
            $name = $file->getClientOriginalName();
            $upload_image_name = uniqid() . '-img.' . $file->extension();


            $file->move(public_path('blogs/' . Auth::user()->id . '/'), $upload_image_name);
            $name_withpath = 'blogs/' . Auth::user()->id . '/' . $upload_image_name;
            $data =
                [
                    'user' => Auth::user()->id,
                    'blog' =>  $request->blog,
                    'cover' =>  $name_withpath,
                    'title' =>  $request->title,
                    'summery' =>  $request->summery,
                    'updated_at' => date("Y-m-d"),

                ];
        } else {

            $data =
                [
                    'user' => Auth::user()->id,
                    'blog' =>  $request->blog,
                    'title' =>  $request->title,
                    'summery' =>  $request->summery,
                    'updated_at' => date("Y-m-d"),

                ];
        }


        $result = Blog_detail::where('id',   $request->blog_id)
            ->update($data);

            if ($result) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'blog updated',
    
                ]);
            } else {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('Something Wrong'),
    
                ]);
            }
    }



    public function add_blog(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cover' => 'required',
            'blog' => 'required',
            'title' => 'required',
            'summery' => 'required',


        ], [

    
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        if ($request->hasfile('cover')) {

            $file = $request->file('cover');
            $path = $file->store('public/vender/');
            $name = $file->getClientOriginalName();
            $upload_image_name = uniqid() . '-img.' . $file->extension();


            $file->move(public_path('blogs/' . Auth::user()->id . '/'), $upload_image_name);
            $name_withpath = 'blogs/' . Auth::user()->id . '/' . $upload_image_name;
        }



        $result = Blog_detail::create(
            [
                'user' => Auth::user()->id,
                'blog' =>  $request->blog,
                'cover' =>  $name_withpath,
                'title' =>  $request->title,
                'summery' =>  $request->summery,
                'created_at' => date("Y-m-d"),
            ]
        );
        if ($result) {
            return response()->json([
                'status' => 'true',
                'message' => 'blog added',

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('Something Wrong'),

            ]);
        }
    }


    // add user details to user table add by kasun 2022/621
    public function add_user(Request $request)
    {

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $emailAddress = $request->emailAddress;
        $phoneNumber = $request->phoneNumber;
        $second_mobile_number = $request->phoneNumber_second;


        $is_admin = 1;
        $active_status = 1;
        $address = $request->address;
        $password = $request->password;
        $user_group = $request->user_group;
        $gender = $request->gender;
        $second_emailAddress = $request->second_emailAddress;

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|alpha|without_spaces',
            'lastName' => 'required|alpha|without_spaces',
            'emailAddress' => 'required|email|without_spaces|unique:users,email',
            'phoneNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|without_spaces||unique:users,mobile',
            'phoneNumber_second' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|without_spaces|unique:users,second_mobile_number',
            'password'         => 'required',
            'password_confirm' => 'required|same:password'

        ], [

            'password.required' => 'Password Required',
            'password_confirm.required' => 'Password Required',



            'firstName.required' => trans('messages.First name required'),
            'firstName.alpha' => trans('messages.First name should be only letters'),
            'firstName.without_spaces' => trans('messages.First name cannot contain spacess'),


            'lastName.required' => trans('messages.Last name required'),
            'lastName.alpha' => trans('messages.Last name should be only letters'),

            'emailAddress.required' => trans('messages.Email address required'),
            'emailAddress.email' => trans('messages.Email address not valid'),
            'second_emailAddress.email' =>  trans('messages.Email address not valid'),


            'location.required' => trans('messages.Location required'),

            'phoneNumber.required' => trans('messages.Phone number required'),
            'phoneNumber.integer' => trans('messages.Phone number should contain only numbers'),
            'phoneNumber_second.integer' => trans('messages.Secondary phone number should contain only numbers'),

            'phoneNumber.without_spaces' => trans('messages.Primary phone number cannot contain spacess'),
            'firstName.without_spaces' => trans('messages.First name cannot contain spacess'),
            'emailAddress.without_spaces' => trans('messages.Email cannot contain spacess'),
            'location.without_spaces' => trans('messages.Locationcannot contain spacess'),
            'phoneNumber_second.without_spaces' => trans('messages.Secondary phone number cannot contain spacess'),

            'nic.required' => trans('messages.NIC number required'),
            'address.required' => trans('messages.Address required'),


            'nic.unique' => trans('messages.NIC already exiset'),
            'phoneNumber.unique' => trans('messages.Phone number already exiset'),
            'phoneNumber_second.unique' => trans('messages.Secondary phone number already exiset'),
            'emailAddress.unique' => trans('messages.Email address already exiset'),
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = User::create(
            [
                'first_name' => $firstName,
                'last_name' =>  $lastName,
                'email' =>  $emailAddress,
                'mobile' =>  $phoneNumber,
                'second_mobile_number' => $second_mobile_number,
                // 'location' =>  $location,
                'password' => bcrypt($password),
                'active_status' => $active_status,
                'is_admin' => $is_admin,
                'address' => $address,
                'gender' => $gender,
                'created_at' => date("Y-m-d"),
            ]
        );

        if ($result) {



            return response()->json([
                'status' => 'true',
                'message' => trans('messages.User Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }
    // function is to change the language added by kasun 2022/6/21
    public function change_language(Request $request)
    {
        Session::put('lang_code', $request->lang);
        return response()->json([
            'status' => 'true',
        ]);
    }

    // get user list add by kasun 2022/6/21
    public function user_list()
    {
        $user_list = User::paginate(10);
        $sit_data = [
            'title' => trans('messages.User List'),
            'user_list' => $user_list
        ];

        return view('admin.user_list', $sit_data);
    }

    // change active_status of user add by kasun 2022/6/21
    public function status_change(Request $request)
    {
        // var_dump($request->table);
        // var_dump($request->id);
        // var_dump($request->colom);
        // var_dump($request->status);
        $update = DB::table($request->table)
            ->where('id', $request->id)
            ->update([$request->colom => $request->status]);
        // var_dump(update);

        if ($update) {
            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Status changed'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }

    public function edit_user(Request $request)
    {

        $user_details = User::where('id',  $request->id)->first();
        $group_list = UserGroup::get();
        // $locations = Locations::get();

        $sit_data = [
            'title' => trans('messages.Edit User'),
            'user_details' => $user_details,
            'user_id' => $request->id,
            'group_list' => $group_list,
            'locations' => $locations = []
        ];
        return view('admin.edite_user', $sit_data);
    }

    public function edit_user_details(Request $request)
    {

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $emailAddress = $request->emailAddress;
        $phoneNumber = $request->phoneNumber;
        $second_mobile_number = $request->phoneNumber_second;
        // $location = $request->location;

        $is_admin = $request->is_admin;
        $active_status = $request->active_status;
        $address = $request->address;
        $nic = $request->nic;
        $user_group = $request->user_group;
        $gender = $request->gender;
        // $second_emailAddress = $request->second_emailAddress;

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });


        $validator = Validator::make($request->all(), [
            'firstName' => 'required|alpha|without_spaces',
            'lastName' => 'required|alpha|without_spaces',
            'emailAddress' => 'required|email|without_spaces',
            // 'location' => 'required|without_spaces',
            'phoneNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|without_spaces|',
            'phoneNumber_second' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|without_spaces',
            'nic' => 'required',
            'address' => 'required',

            'user_group' => 'required',
            // 'second_emailAddress' => 'email|nullable',

        ], [
            'firstName.required' => trans('messages.First name required'),
            'firstName.alpha' => trans('messages.First name should be only letters'),
            'firstName.without_spaces' => trans('messages.First name cannot contain spacess'),


            'lastName.required' => trans('messages.Last name required'),
            'lastName.alpha' => trans('messages.Last name should be only letters'),

            'emailAddress.required' => trans('messages.Email address required'),
            'emailAddress.email' => trans('messages.Email address not valid'),
            'second_emailAddress.email' => trans('messages.Email address not valid'),

            'location.required' => trans('messages.Location required'),

            'phoneNumber.required' => trans('messages.Phone number required'),
            'phoneNumber.integer' => trans('messages.Phone number should contain only numbers'),

            'phoneNumber_second.integer' => trans('messages.Secondary phone number should contain only numbers'),

            'phoneNumber.without_spaces' => trans('messages.Primary phone number cannot contain spacess'),
            'firstName.without_spaces' => trans('messages.First name cannot contain spacess'),
            'emailAddress.without_spaces' => trans('messages.Email cannot contain spacess'),
            'location.without_spaces' => trans('messages.Locationcannot contain spacess'),
            'phoneNumber_second.without_spaces' => trans('messages.Secondary phone number cannot contain spacess'),

            'nic.required' => trans('messages.NIC number required'),
            'address.required' => trans('messages.Address required'),


            'nic.unique' => trans('messages.NIC already exiset'),
            'phoneNumber.unique' => trans('messages.Phone number already exiset'),
            'phoneNumber_second.unique' => trans('messages.Secondary phone number already exiset'),
            'emailAddress.unique' => trans('messages.Email address already exiset'),

            'user_group.required' => trans('messages.User group required'),
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data =
            [
                'first_name' => $firstName,
                'last_name' =>  $lastName,
                'email' =>  $emailAddress,
                'mobile' =>  $phoneNumber,
                'second_mobile_number' => $second_mobile_number,
                // 'location' =>  $location,
                // 'password' => bcrypt(1234),
                'active_status' => $active_status,
                'is_admin' => $is_admin,
                'address' => $address,
                'nic' => $nic,
                // 'secondemailaddress' => $second_emailAddress,
                'gender' => $gender,

            ];

        $result = User::where('id',  $request->id)
            ->update($data);

        if ($result) {
            $user_group_details = UserGroupMap::where('user_id',  $request->id)->first();
            if ($user_group_details) {
                $data =  [
                    'group_id' =>   $user_group,
                    'updated_at' => date("Y-m-d"),
                ];
                $results = UserGroupMap::where('user_id', $request->id)
                    ->update($data);
            } else {

                $resul = UserGroupMap::create(
                    [
                        'user_id' => $request->id,
                        'group_id' =>   $user_group,
                        'created_at' => date("Y-m-d"),
                    ]
                );
            }


            if ($result) {
                return response()->json([
                    'status' => 'true',
                    'message' => trans('messages.Edit Success'),
                ]);
            } else {
                return response()->json([
                    'status' => 'false',
                    'message' => trans('messages.Something went wrong'),

                ]);
            }
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }
    public function get_users_list(Request $request)
    {

        // 'st_name':$('#st_name').val(),
        // 'st_email':$('#st_email').val(),
        // 'st_contact':$('#st_contact').val(),
        // 'st_group':$('#st_group').val(),
        // 'st_nic':$('#st_nic').val(),
        // 'st_address':$('#st_address').val(),
        // 'st_active_status':$('#st_active_status').val(),

        $query = User::query();
        $query = $query->leftjoin('user_group_map', 'users.id', '=', 'user_group_map.user_id');
        $query = $query->leftjoin('user_groups', 'user_group_map.group_id', '=', 'user_groups.id');

        if ($request->st_name != '') {
            $query = $query->where('first_name', 'LIKE', '%' . $request->st_name . '%');
        }

        if ($request->st_email != '') {
            $query = $query->where('email', 'LIKE', '%' . $request->st_email . '%');
        }

        if ($request->st_contact != '') {
            $query = $query->where('mobile', 'LIKE', '%' . $request->st_contact . '%');
        }

        if ($request->st_group != '') {
            $query = $query->where('user_group_map.group_id', '=', $request->st_group);
        }

        if ($request->st_nic != '') {
            $query = $query->where('nic', 'LIKE', '%' . $request->st_nic . '%');
        }

        if ($request->st_address != '') {
            $query = $query->where('address', 'LIKE', '%' . $request->st_address . '%');
        }

        if ($request->st_active_status != '') {
            $query = $query->where('users.active_status', 'LIKE', '%' . $request->st_active_status . '%');
        }

        $query = $query->orderBy('users.id', 'desc');
        $query = $query->select(['user_groups.group_name', 'users.*']);

        return datatables($query)

            ->addColumn('active_stat', function ($row) {

                if ($row->active_status == 1) {
                    $btn = 'Active';
                } else {
                    $btn = 'Inactive';
                }
                return $btn;
            })
            ->addColumn('create_at', function ($row) {

                // $btn = $row->created_at->format('Y-m-d');
                $btn = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('Y-M-d(D)');

                return $btn;
            })
            ->addColumn('groups', function ($row) {

                // $name=$row->group->group_detail->group_name;

                return $row->group_name;
            })

            ->addColumn('action', function ($row) {

                $btn = '<a data-toggle="tooltip" title="Edit" href="edit-user/' . $row->id . '" class="success p-0" data-original-title="" title="">
                <i class="fa fa-pencil font-medium-3 mr-2"></i>
                </a>
                <a data-toggle="tooltip" title="Delete" onclick="delete_user(' . $row->id . ')"><i class="fa fa-trash font-medium-3 mr-2"></i></a>
                ';
                // if ($row->active_status == 1) {
                //     $btn = $btn . ' <a onclick="status_change(' . $row->id . ',0)" class="danger p-0" >
                //     <i class="fa fa-times font-medium-3 mr-2"></i>
                // </a>';
                // } else {

                //     $btn = $btn . '<a onclick="status_change(' . $row->id . ',1)" class="info p-0" >
                //     <i class="fa fa-check font-medium-3 mr-2"></i>
                // </a>';
                // }
                return $btn;
            })
            // ->rawColumns(['action'])

            ->addColumn('status', function ($row) {

                $btn = "";
                if ($row->active_status == 1) {
                    $btn = $btn . '<h5><a data-toggle="tooltip" title="Change to Inactive" onclick="status_change(' . $row->id . ',0)"><span class="badge badge-success badge-pill">Active</span></a></h5>';
                } else {
                    $btn = $btn . '<h5><a data-toggle="tooltip" title="Active" onclick="status_change(' . $row->id . ',1)"><span class="badge badge-secondary badge-pill">Inactive</span></a></h5>';
                }
                return $btn;
            })
            ->addColumn('del', function ($row) {

                $btn = "";

                $btn = $btn . '<a data-toggle="tooltip" title="Delete" onclick="delete(' . $row->id . ')"><i class="fa fa-bin font-medium-3 mr-2"></i></a>';

                return $btn;
            })
            ->rawColumns(['status', 'action', 'del'])
            ->make(true);
    }

    public function delete_user(Request $request)
    {

        User::where('id', $request->id)->delete();


        return response()->json([
            'status' => 'true',
            'message' => trans('messages.Permission removed'),

        ]);
    }
}
