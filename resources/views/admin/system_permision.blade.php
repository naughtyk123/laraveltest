@extends('includes.default')
@section('content')
<div class="container-fluid">
  
    @inject('groupid_function', 'App\CentralLogics\Uservalidation')
  

    <?php $group_id=$groupid_function->get_group_id(); ?>

    <section id="shopping-cart">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap bar-warning">
                           
                            @if($view_status=='user')

                            <h4 class="card-title">{{trans('messages.User Permissions')}}</h4>

                            @else

                            <h4 class="card-title">{{trans('messages.Group Permissions')}}</h4>



                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <div class="row">
                                @if($view_status=='group')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_group">{{trans('messages.USER GROUP')}}</label>
                                        <select onchange="getpermissions('group')" class="custom-select form-control" id="user_group" name="user_group">
                                            <option value="">Select User Group</option>
                                            @foreach($group_list as $group)

                                            <option @if($group->active_status==0)style="background:red;color:white"@endif value="{{$group->id}}">
                                                {{$group->group_name}}
                                            </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                                @if($view_status=='user')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_list">{{trans('messages.USERS')}}</label>
                                        <select onchange="getpermissions('user')" class="custom-select form-control" id="user_list" name="user_list">
                                            <option value="">Select User </option>
                                            @foreach($user_list as $user_lis)

                                            <option @if($user_lis->active_status==0)style="background:red;color:white"@endif value="{{$user_lis->id}}">
                                                {{$user_lis->first_name.' '.$user_lis->last_name}}

                                            </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <ul class="treeview">

                                @if($menu_list)
                                @foreach($menu_list as $menu)
                                @if($menu->menu_type==1)
                                <li id="li_{{$menu->id}}" class="contains-items">
                                    <div class="checkbox custom-control custom-checkbox m-0">
                                        <input id="{{$menu->id}}" class="custom-control-input checkbox_permission" type="checkbox" value="{{$menu->id}}" name="categories[]">
                                        <label class="custom-control-label" for="{{$menu->id}}">
                                            {{$menu->menu_name}} - {{$menu->description}}
                                        </label>
                                    </div>
                                    @if($menu->sub_functions!='')
                                    <ul class="ml-3">
                                        @foreach($menu->sub_functions as $menu_sub)

                                        <li class="li_{{$menu->id}}">
                                            <div class="checkbox custom-control custom-checkbox m-0">
                                                <input class="custom-control-input menu_item checkbox_permission" parent_value="{{$menu->id}}" from_group="0" id="menu{{$menu_sub->id}}" type="checkbox" value="{{$menu_sub->id}}" name="categories[]">
                                                <label class="custom-control-label" for="menu{{$menu_sub->id}}">
                                                    @if($menu_sub->menu_type==2)
                                                    {{$menu_sub->menu_name}} - {{$menu_sub->description}} <span class="badge badge-info">Sub Menu</span>
                                                    @endif
                                                    @if($menu_sub->menu_type==3)
                                                    {{$menu_sub->menu_name}} - {{$menu_sub->description}} <span class="badge badge-warning">Sub Function</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </li>

                                        @endforeach
                                    </ul>
                                    @endif
                                </li>

                                @endif
                                @endforeach
                                @endif

                            </ul>
                            <div class="col-md-12">
                                @if($view_status=='user')
                                <button onclick="check('user')" class="btn mr-1 btn-success float-right"><i class="ft-thumbs-up position-right"></i>  Submit</button>
                                @endif
                                @if($view_status=='group')
                                <button onclick="check('group')" class="btn mr-1 btn-success float-right"><i class="ft-thumbs-up position-right"></i>  Submit</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <input type="button" onclick="check()" value="ok"> -->
    </section>

</div>



@stop
@section('script')
<script>
    var add_group_permission = [];
    var removed_from_group = [];

    $('input[type=checkbox]').change(function() {
        // if is checked
        if (this.checked) {
            // check all children
            var lenchk = $(this).closest('ul').find(':checkbox');
            var lenchkChecked = $(this).closest('ul').find(':checkbox:checked');

            //if all siblings are checked, check its parent checkbox
            if (lenchk.length == lenchkChecked.length) {
                $(this).closest('ul').siblings().find(':checkbox').prop('checked', true);
            } else {
                $(this).closest('.checkbox').siblings().find(':checkbox').prop('checked', true);
            }
        } else {
            // uncheck all children
            $(this).closest('.checkbox').siblings().find(':checkbox').prop('checked', false);
            $(this).closest('ul').siblings().find(':checkbox').prop('checked', false);
        }
        add_group_permission = [];
        removed_from_group = [];
        var inputElements = document.getElementsByClassName('menu_item');
        for (var i = 0; inputElements[i]; ++i) {
            if (inputElements[i].checked) {
                checkedValue = inputElements[i].value;
                add_group_permission.push({
                    'parent': $('#menu' + checkedValue).attr('parent_value'),
                    'child': inputElements[i].value,
                    'from_group': $('#menu' + checkedValue).attr('from_group')
                })
            } else {

                checkedValue_remove = inputElements[i].value;
                removed_from_group.push({
                    'parent': $('#menu' + checkedValue_remove).attr('parent_value'),
                    'child': inputElements[i].value,
                    'from_group': $('#menu' + checkedValue_remove).attr('from_group')
                })

            }
        }
       
    });

    function check(type) {
        $.ajax({
            type: 'POST',
            url: '/add_group_permission',
            data: {
                "_token": "{{ csrf_token() }}",
                "permissions": add_group_permission,
                'removed_from_group': removed_from_group,
                'group_id': $('#user_group').val(),
                'user_id': $('#user_list').val(),
                'user_group': "{{session()->get('user')['user_id']}}",
                'status': type,
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {

                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, data.title, {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                }
                if (data.status == "false") {
                    toastr.error(data.message, 'ERROR', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                }
            }
        });
    }

    function getpermissions(type) {

        add_group_permission = [];
        $('.checkbox_permission').prop('checked', false);

        $.ajax({
            type: 'GET',
            url: '/getpermissions_to_show',
            data: {
                "_token": "{{ csrf_token() }}",
                'group_id': $('#user_group').val(),
                'user_group': "{{$group_id}}",
                'user_id': $('#user_list').val(),
                'status': '{{$view_status}}'

            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {

                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    $.each(data.details, function(key, val) {
                        // alert(val.permission_id);
                    
                        $('#menu' + val.permission_id).click();

                    });

                    $.each(data.group_details, function(key, val) {
                       console.log('{{$group_id}}');
                        if ($('#menu' + val.permission_id).is(':checked')) {

                            $('#menu' + val.permission_id).attr('from_group', 1);
                        } else {
                            $('#menu' + val.permission_id).attr('from_group', 1);

                            $('#menu' + val.permission_id).click();
                        }

                    });


                    $.each(data.result_group_remove, function(key, val) {
                        if ($('#menu' + val.permission_id).is(':checked')) {

                            $('#menu' + val.permission_id).click();
                        } else {



                        }

                    });

                }
                if (data.status == "false") {
                    toastr.error(data.message, 'ERROR', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                }
            }
        });
    }
</script>

@stop