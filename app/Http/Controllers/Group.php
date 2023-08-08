<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\UserGroupMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class Group extends Controller
{
    public function index()
    {
        $group_list = UserGroupMap::paginate(10);
        $sit_data = [
            'title' => trans('messages.Group List'),
            'group_list' => $group_list
        ];
        return view('admin.create_group', $sit_data);
    }
    public function save_group(Request $request)
    {

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });


        $validator = Validator::make($request->all(), [
            'group_name' => 'required',
            'group_description' => 'required',
        ], [
            'group_name.required' => trans('messages.Group name is empty'),
            'group_description.required' => trans('messages.Group description is empty'),




        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $result = UserGroup::create(
            [
                'group_name' => $request->group_name,
                'description' =>  $request->group_description,
                'created_at' => date("Y-m-d"),
            ]
        );
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Group Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }


    public function edit_group(Request $request)
    {

        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });


        $validator = Validator::make($request->all(), [
            'group_name_edit' => 'required',
            'group_description_edit' => 'required',
        ], [
            'group_name_edit.required' => trans('messages.Group name is empty'),



        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'errors',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data =
            [
                'group_name' => $request->group_name_edit,
                'description' =>  $request->group_description_edit,
                'updated_at' => date("Y-m-d"),
            ];

        $result = UserGroup::where('id',  $request->id)
            ->update($data);
        if ($result) {

            return response()->json([
                'status' => 'true',
                'message' => trans('messages.Group Creation Success'),

            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => trans('messages.Something went wrong'),

            ]);
        }
    }

    public function get_user_groups(Request $request)
    {
        // $result = UserGroup::limit(1)->get();
        // 'st_active_status':$('#st_active_status').val(),
        // 'st_adddate':$('#st_adddate').val(),
        // 'st_group':$('#st_group').val(),
        // $query = UserGroup::select('*');
        $query = UserGroup::query();

        if ($request->st_active_status != '') {
            $query = $query->where('active_status', '=', $request->st_active_status);
        }

        if ($request->st_group != '') {
            $query = $query->where('id',  '=', $request->st_group);
        }

        if ($request->st_adddate != '') {
            // $query = $query->where('question', 'LIKE', '%' . $request->st_adddate . '%');
            $query = $query->whereDate('created_at', $request->st_adddate);
        }

        return datatables($query)
            // ->addIndexColumn()
            ->addColumn('active_stat', function ($row) {

                if ($row->active_status == 1) {
                    $btn = 'Active';
                } else {
                    $btn = 'Inactive';
                }
                return $btn;
            })
            ->addColumn('create_at', function ($row) {

                $btn = $row->created_at->format('Y-m-d');

                return $btn;
            })
            ->addColumn('action', function ($row) {

                $btn = '<a data-toggle="tooltip" title="Edit" onclick="editgroup(' . $row->id . ',\'' . $row->group_name . '\',\'' . $row->description . '\')" class="success p-0" data-original-title="" title="">
                <i class="fa fa-pencil font-medium-3 mr-2"></i>
                </a>';
                if ($row->active_status == 1) {
                    $btn = $btn . '<a data-toggle="tooltip" title="Change to Inactive" onclick="status_change(' . $row->id . ',0)" class="danger p-0" data-original-title="" title="">
                    <i class="fa fa-times font-medium-3 mr-2"></i>
                </a>';
                } else {

                    $btn = $btn . '<a data-toggle="tooltip" title="Change to Active" onclick="status_change(' . $row->id . ',1)" class="info p-0" data-original-title="" title="">
                    <i class="fa fa-check font-medium-3 mr-2"></i>
                </a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
