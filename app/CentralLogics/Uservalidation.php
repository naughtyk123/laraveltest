<?php

namespace App\CentralLogics;

use App\Models\Measurement;
use App\Models\NotificationStatus;
use App\Models\PermissionMap;
use App\Models\SystemPermission;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\permission_remove;
use App\Models\Types;
use App\Models\UserGroup;
use App\Models\UserGroupMap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class Uservalidation
{

    public function get_group_id()
    {
        $group = UserGroupMap::where('user_id', '=',  Auth::user()->id)->first();
        if ($group){
            return $group->group_id;
        }else{
            return '';

        }
        
    }

    public function get_user_id()
    {
        return Auth::user()->id;
    }

    public function allusers()
    {
        return User::get();
    }
    public function allgroups()
    {
        return UserGroup::get();
    }
    public function allmarkettype()
    {
        return Types::get();
    }
    public function allmasur()
    {
        return Measurement::get();
    }

    public function check_user_permissions()
    {


        $group = UserGroupMap::where('user_id', '=',  Auth::user()->id)->first();
        $permissions = [];
        if(!$group){
            return $permissions;
        }
        $groupid = $group->group_id;

       

       
        $user_id = Auth::user()->id;
        $user = User::where('id', '=',  $user_id)->first();

        $child_array = [];
        $group_menus = PermissionMap::select('parent_id', 'permission_id')->where('group_id', '=',  $groupid)->get();
        $count = 0;
        $removed = [];

        // die();

        $group_menus_removed = permission_remove::select('parent_id', 'permission_id')->where('user_id', '=',  Auth::user()->id)->get();

        if ($group_menus_removed) {
            foreach ($group_menus_removed as $group) {

                array_push($removed, $group->permission_id);
            }
        }



        foreach ($group_menus as $group) {



            if ($group->permission_detail->active_status) {
                if (array_key_exists($group->parent_id, $child_array)) {

                    if (in_array($group->permission_id, $child_array[$group->parent_id])) {
                    } else if (in_array($group->permission_id, $removed)) {
                    } else {

                        array_push($child_array[$group->parent_id], $group->permission_id);
                    }
                } else {

                    $child_array[$group->parent_id] = array($group->permission_id);
                }

                if (array_key_exists($group->parent_id, $permissions)) {
                    // $permissions[$group->parent_id]
                    $permissions[$group->parent_id][$group->parent_id] = $child_array[$group->parent_id];
                } else if (in_array($group->permission_id, $removed)) {
                } else {

                    $permissions[$group->parent_id] = array($group->parent_id => [$group->permission_id]);
                }
            }
        }

        $user_menus = PermissionMap::select('parent_id', 'permission_id')->where('user_id', '=',  $user_id)->get();

        if ($user_menus) {

            foreach ($user_menus as $usermenu) {

                // var_dump($usermenu->parent_id);
                // die();
                if ($usermenu->permission_detail->active_status) {
                    if (array_key_exists($usermenu->parent_id, $child_array)) {

                        if (in_array($usermenu->permission_id, $child_array[$usermenu->parent_id])) {
                        } else if (in_array($usermenu->permission_id, $removed)) {
                        } else {
                            array_push($child_array[$usermenu->parent_id], $usermenu->permission_id);
                        }
                    } else {

                        $child_array[$usermenu->parent_id] = array($usermenu->permission_id);
                    }

                    if (array_key_exists($usermenu->parent_id, $permissions)) {
                        // $permissions[$group->parent_id]
                        $permissions[$usermenu->parent_id][$usermenu->parent_id] = $child_array[$usermenu->parent_id];
                    } else if (in_array($usermenu->permission_id, $removed)) {
                    } else {

                        $permissions[$usermenu->parent_id] = array($usermenu->parent_id => [$usermenu->permission_id]);
                    }
                }
            }
        }

        return $permissions;
    }




    public function get_urls($id)
    {


        $group_menus = SystemPermission::select('url', 'menu_name', 'icon')->where('id', '=',  $id)->where('active_status', '=',  1)
            ->where('menu_type', '!=',  3)
            ->first();

        return $group_menus;
    }

    public static function get_curent_url()
    {

        $group = UserGroupMap::where('user_id', '=',  Auth::user()->id)->first();

        $groupid = $group->group_id;

        $path = Route::currentRouteName();
        $path_two = URL::current();
        $sitepath = URL::to("/");

        $curent_url = str_replace($sitepath . '/', "", $path_two);

        if ($path != 'dashboard') {
            // if (session()->get('user')['is_admin'] == 1) {
            //     return true;
            // }

            $menus = SystemPermission::select('id')->where('url', '=',  $path)->first();
            $menus_two = SystemPermission::select('id')->where('url', '=',  $curent_url)->first();


            if (!$menus && !$menus_two) {

                return true;
            }

            $user_menus_remove = '';
            $user_menus_remove_two = '';


            if ($menus) {
                $user_menus_remove = permission_remove::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus->id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();
            }

            if ($menus_two) {
                $user_menus_remove_two = permission_remove::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus_two->id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();
            }


            if ($user_menus_remove && $menus) {
                //   var_dump('adasd');
                //   die();
                return false;
            }

            if ($user_menus_remove_two && $menus_two) {
                // var_dump('b');
                // die();
                return false;
            }

            $user_menus = '';
            $group_menus = '';
            $user_menus_two = '';
            $group_menus_two = '';

            if ($menus) {
                $user_menus = PermissionMap::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus->id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();

                $group_menus = PermissionMap::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus->id)
                    ->where('group_id', '=', $groupid)
                    ->first();

                if (!$user_menus && !$group_menus) {
                    return false;
                } else if ($user_menus && $user_menus->permission_detail->active_status == 0) {
                    return false;
                } else if ($group_menus && $group_menus->permission_detail->active_status == 0) {
                    // var_dump('asfsdfsdf');
                    // die();
                    return false;
                } else {
                    return true;
                }
            }

            if ($menus_two) {
                $user_menus_two = PermissionMap::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus_two->id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();

                $group_menus_two = PermissionMap::select('parent_id', 'permission_id')
                    ->where('permission_id', '=', $menus_two->id)
                    ->where('group_id', '=', $groupid)
                    ->first();

                if (!$user_menus_two && !$group_menus_two) {
                    return false;
                } else if ($user_menus_two && $user_menus_two->permission_detail->active_status == 0) {
                    return false;
                } else if ($group_menus_two && $group_menus_two->permission_detail->active_status == 0) {

                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return true;
        }
    }


    public function get_time_human($time)
    {

        return $time;
        // if($time!=''){
        //    $tim= Carbon::createFromFormat('Y-m-d H:i:s',$time)->diffForHumans();
        //    return $tim;
        // }


    }
    public static function get_date_human($date)
    {
        // $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-M-d(D)');
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-M-d');

        return $date;
    }

    public function get_noti_typs(){
        $notification_types = NotificationStatus::all();
        return $notification_types;
    }
    public function getRoleName($user)
    {
        $group = $user->group;
        $group_name = UserGroup::where('id', $group->group_id)->first()->group_name;
        return ($group_name);
    }

    public function contentcount($user)
    {
        $group = $user->group;
        $group_name = UserGroup::find($group->id)->first()->group_name;
        return ($group_name);
    }

    public function user_icon($id = '')
    {

        if ($id == '') {

            if (Auth::user()) {
                $stat = Cache::has('user_online_' . Auth::user()->id);

                if ($stat) {
                    $border = 'border-style:solid;border-color:#5af55a;';
                } else {
                    $border = 'border-style:solid;border-color:red;';
                }
                $icon = Auth::user()->first_name[0];


                $code = dechex(crc32($icon . '' . Auth::user()->last_name[0] . '' . Auth::user()->id));
                $color = substr($code, 0, 6);

                return '<div  class="userouter_border" style="' . $border . '"><div class="usericon"  style="background:#' . $color . ';" ><puser>' . $icon . '</puser></div></div>';
            }
        } else {
            $user = User::where('id', '=',  $id)->first();

            $stat = Cache::has('user_online_' . $id);

            if ($stat) {
                $border = 'border-style:solid;border-color:#5af55a;';
            } else {
                $border = 'border-style:solid;border-color:red;';
            }
            $icon = $user->first_name[0];

            $code = dechex(crc32($icon . '' . $user->last_name[0] . '' . $user->id));
            $color = substr($code, 0, 6);

            return '<div class="userouter_border"   style="' . $border . '" ><div class="usericon"  style="background:#' . $color . ';" ><puser>' . $icon . '</puser></div></div>';
        }
    }

    public function usertest($id = null)
    {
        // if ($id != null) {
        // // var_dump($id);
        $str = 'sdafasd' . $id;
        return $str;
        // }
    }
}
