<?php

namespace App\Http\Controllers;

use App\Models\permission_remove;
use App\Models\PermissionMap;
use App\Models\SystemPermission;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;

class System extends Controller
{
    public function index()
    {

        $menu_list = SystemPermission::where('menu_type', '=', '1')->paginate(10);

        $sit_data = [
            'title' => trans('messages.System Menu'),
            'menu_list' => $menu_list,
        ];

        return view('admin.system_view', $sit_data);
    }
    public function system_permission(Request $request)
    {

        $id = $request->id;
        $menu_list = SystemPermission::where('menu_type', '=', '1')->get();
        $group_list = UserGroup::get();
        $user_list = User::get();
        if ($id == "group") {
            $title = "Group Permissions";
        } else {

            $title = "User Permissions";
        }

        $sit_data = [
            'title' => $title,
            'menu_list' => $menu_list,
            'group_list' => $group_list,
            'user_list' => $user_list,
            'view_status' => $id
        ];

        return view('admin.system_permision', $sit_data);
    }
    public function add_permission(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'menu_name' => 'required',
            'url' => 'required',
            'menu_type' => 'required',
            'icon' => 'required',

            
        ], [
            'menu_name.required' => trans('messages.Menu name required'),
            'url.required' => trans('messages.URL required'),
            'menu_type.required' => trans('messages.Menu type required'),
            'icon.required' => trans('messages.Menu icon required'),

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = SystemPermission::create(
            [
                'url' => $request->url,
                'menu_name' =>  $request->menu_name,
                'menu_type' => $request->menu_type,
                'icon' => $request->icon,
                'created_at' => date("Y-m-d"),
                'description' => $request->description,
                'active_status'=>1,
            ]
        );
    
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Menu Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }


    public function edit_parent_permission(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'menu_name_edit' => 'required',
            'url_edit' => 'required',
            'menu_type' => 'required',
        ], [
            'menu_name_edit.required' => trans('messages.Menu name required'),
            'url_edit.required' => trans('messages.URL required'),
            'menu_type.required' => trans('messages.Menu type required'),
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = SystemPermission::where('id', '=', $request->id)->update(
            [
                'url' => $request->url_edit,
                'menu_name' =>  $request->menu_name_edit,
                'menu_type' => $request->menu_type,
                'icon' => $request->icon,
                'updated_at' => date("Y-m-d"),
                'description' => $request->description,
            ]
        );
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Menu Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }

    public function get_maine_menus()
    {
        $result = SystemPermission::where('menu_type', '=', 1)->get();
        return response()->json([
            'status' => 'true',
            'details' => $result,

        ]);
    }

    public function add_sub_function(Request $request)
    {

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });


        $validator = Validator::make($request->all(), [

            'sub_menu_name' => 'required',
            'sub_url' => 'required',
            'menu_type' => 'required',
            'parent_menu' => 'required',
            'icon' => 'required',

        ], [
            'sub_menu_name.required' => trans('messages.Sub menu name required'),
            'sub_url.required' => trans('messages.URL required'),
            'menu_type.required' => trans('messages.Menu type required'),
            'parent_menu.required' => trans('messages.Parent menu required'),
            'icon.required' => trans('messages.Menu icon required'),

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = SystemPermission::create(
            [
                'url' => $request->sub_url,
                'menu_name' =>  $request->sub_menu_name,
                'menu_type' => $request->menu_type,
                'parent' => $request->parent_menu,
                'icon' => $request->icon,
                'created_at' => date("Y-m-d"),
                'description' => $request->description,
            ]
        );
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Menu Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }


    public function edit_sub_function(Request $request)
    {

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });


        $validator = Validator::make($request->all(), [

            'sub_menu_name_edit' => 'required',
            'sub_url_edit' => 'required',
            'menu_type' => 'required',
            'parent_menu_edit' => 'required',

        ], [
            'sub_menu_name_edit.required' => trans('messages.Sub menu name required'),
            'sub_url_edit.required' => trans('messages.URL required'),
            'menu_type.required' => trans('messages.Menu type required'),
            'parent_menu_edit.required' => trans('messages.Parent menu required'),

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = SystemPermission::where('id', '=', $request->id)->update(
            [
                'url' => $request->sub_url_edit,
                'menu_name' =>  $request->sub_menu_name_edit,
                'menu_type' => $request->menu_type,
                'icon' => $request->icon,
                'parent' => $request->parent_menu_edit,
                'updated_at' => date("Y-m-d"),
                'description' => $request->description,
            ]
        );
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Menu Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }


    public function getmenus()
    {
        $permissions = [];
        $user_id = session()->get('user')['user_id'];
        $user = User::where('id', '=',  $user_id)->first();
        $child_array = [];
        $group_menus = PermissionMap::select('parent_id', 'permission_id')->where('group_id', '=',  $user->group->group_id)->get();
        $count = 0;
        foreach ($group_menus as $group) {


            if (array_key_exists($group->parent_id, $child_array)) {

                if (in_array($group->permission_id, $child_array[$group->parent_id])) {
                } else {

                    array_push($child_array[$group->parent_id], $group->permission_id);
                }
            } else {

                $child_array[$group->parent_id] = array($group->permission_id);
            }

            if (array_key_exists($group->parent_id, $permissions)) {
                // $permissions[$group->parent_id]
                $permissions[$group->parent_id][$group->parent_id] = $child_array[$group->parent_id];
            } else {

                $permissions[$group->parent_id] = array($group->parent_id => [$group->permission_id]);
            }
        }

        $user_menus = PermissionMap::select('parent_id', 'permission_id')->where('user_id', '=',  $user_id)->get();
        foreach ($user_menus as $usermenu) {

            if (array_key_exists($usermenu->parent_id, $child_array)) {

                if (in_array($usermenu->permission_id, $child_array[$usermenu->parent_id])) {
                } else {
                    array_push($child_array[$usermenu->parent_id], $usermenu->permission_id);
                }
            } else {

                $child_array[$usermenu->parent_id] = array($usermenu->permission_id);
            }

            if (array_key_exists($usermenu->parent_id, $permissions)) {
                // $permissions[$group->parent_id]
                $permissions[$usermenu->parent_id][$usermenu->parent_id] = $child_array[$usermenu->parent_id];
            } else {

                $permissions[$usermenu->parent_id] = array($usermenu->parent_id => [$usermenu->permission_id]);
            }
        }

        // echo '<pre>';
        // var_dump($permissions);
        // echo '</pre>';





        // return $a ;
    }
    public function get_permission_table()
    {
        $menu_list = SystemPermission::where('menu_type', '=', '1')->paginate(10);

        $sit_data = [
            'title' => trans('messages.System Menu'),
            'menu_list' => $menu_list,
        ];

        return view('admin.permission_table', $sit_data);
    }
    public function add_group_permission(Request $request)
    {

        $status = $request->status;
        $group_id = $request->group_id;

        if ($status == 'group' && $group_id == '') {

            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Please select a group'),

            ]);
        }

        if ($status == 'user' && $request->user_id == '') {

            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Please select a user'),
            ]);
        }

        if ($request->permissions == '') {

            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Please select permission'),

            ]);
        }

        if ($status == 'group') {

            $group_menus = PermissionMap::select('parent_id', 'permission_id')
                ->where('group_id', '=', $request->group_id)
                ->get();
            if ($group_menus) {
                $model = PermissionMap::where('group_id', $request->group_id)->delete();
            }

            $error = array();
            $permissions = $request->permissions;
            // session()->get('user')['user_id']
            foreach ($permissions as $key) {
                $result = PermissionMap::create(
                    [
                        'permission_id' => $key['child'],
                        'parent_id' =>  $key['parent'],
                        'user_id' => 0,
                        'group_id' => $request->group_id,
                        'created_at' => date("Y-m-d"),
                    ]
                );
                if ($result) {
                    array_push($error, "1");
                } else {
                    array_push($error, "0");
                }
            }
        }

        if ($status == 'user') {

            $group_menus = PermissionMap::select('parent_id', 'permission_id')
                ->where('user_id', '=', $request->user_id)
                ->get();
            if ($group_menus) {
                $model = PermissionMap::where('user_id', $request->user_id)->delete();
            }


            $group_menus = permission_remove::select('parent_id', 'permission_id')
                ->where('user_id', '=', $request->user_id)
                ->get();
            if ($group_menus) {
                $model = permission_remove::where('user_id', $request->user_id)->delete();
            }

            $error = array();
            $permissions = $request->permissions;
            $remove = $request->removed_from_group;

            // session()->get('user')['user_id']
            foreach ($permissions as $key) {
                if ($key['from_group'] != 1) {
                    $result = PermissionMap::create(
                        [
                            'permission_id' => $key['child'],
                            'parent_id' =>  $key['parent'],
                            'user_id' => $request->user_id,
                            'group_id' => 0,
                            'created_at' => date("Y-m-d"),
                        ]
                    );
                    if ($result) {
                        array_push($error, "1");
                    } else {
                        array_push($error, "0");
                    }
                }
            }

            if ($remove != '') {
                foreach ($remove as $key) {


                    $result = permission_remove::create(
                        [
                            'permission_id' => $key['child'],
                            'parent_id' =>  $key['parent'],
                            'user_id' => $request->user_id,
                            'group_id' => '',
                            'created_at' => date("Y-m-d"),
                        ]
                    );



                    if ($result) {
                        array_push($error, "1");
                    } else {
                        array_push($error, "0");
                    }
                }
            }
        }


        if (in_array("0", $error)) {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        } else {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Permission set'),

            ]);
        }
    }
    public function getpermissions_to_show(Request $request)
    {

        $group_id = $request->group_id;
        $status = $request->status;



        if ($status == 'group') {
            $result = PermissionMap::select('parent_id', 'permission_id')
                ->where('group_id', '=', $group_id)
                ->get();
            $result_group = [];
            $result_group_remove = [];
        }
        if ($status == 'user') {

            $result = PermissionMap::select('parent_id', 'permission_id')
                ->where('user_id', '=', $request->user_id)
                ->get();


            $result_group_remove = permission_remove::select('permission_id')
                ->where('user_id', '=', $request->user_id)
                ->get();

            $result_group = PermissionMap::select('parent_id', 'permission_id')
                ->where('group_id', '=', $request->user_group)
                ->get();
        }

        if ($result) {
            return response()->json([
                'status' => 'true',
                'details' => $result,
                'group_details' => $result_group,
                'result_group_remove' => $result_group_remove,

            ]);
        }
    }
    public function delete_sub_function(Request $request)
    {

        PermissionMap::where('permission_id', $request->id)->delete();
        permission_remove::where('permission_id', $request->id)->delete();
        SystemPermission::where('id', $request->id)->delete();



        return response()->json([
            'status' => 'true',
            'message' => trans('messages.Permission removed'),

        ]);
    }
}
