@extends('includes.default')
@section('content')
<div class="container-fluid">

    <!-- edit model for sub
     permission -->
    <div class="modal fade text-left" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="" id="edit_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_menu_edit">{{trans('messages.SELECT PARENT')}}</label>
                                <select class="form-control" id="parent_menu_edit" name="parent_menu_edit">

                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_menu_name_edit">{{trans('messages.SUB MENU NAME')}}</label>
                                <input type="text" class="form-control" id="sub_menu_name_edit" name="sub_menu_name_edit" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_url_edit">{{trans('messages.MENU URL')}}</label>
                                <input type="text" class="form-control" id="sub_url_edit" name="sub_url_edit" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="submenu_edit" value="2" checked name="menutype_edit" class="custom-control-input">
                                <label class="custom-control-label" for="submenu_edit">{{trans('Sub Menu')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="subfunction_edit" value="3" name="menutype_edit" class="custom-control-input">
                                <label class="custom-control-label" for="subfunction_edit">{{trans('Sub Function')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_per">Description</label>
                                <textarea class="form-control" name="" id="sub_per" cols="30" rows="10">

                               </textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @include('icon.icon')
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-1" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                    <button type="button" class="btn btn-success" onclick="edit_sub_function()"><i class="fa fa-check"></i> Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit model for parent permission -->
    <div class="modal fade text-left" id="edit_model_parent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="" id="edit_id_parent">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_name_edit">{{trans('messages.MENU NAME')}}</label>
                                <input type="text" class="form-control" id="menu_name_edit" name="menu_name_edit" value="" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url_edit">{{trans('messages.MENU URL')}}</label>
                                <input type="text" class="form-control" id="url_edit" name="url" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_per">Description</label>
                                <textarea class="form-control" name="" id="parent_per" cols="30" rows="10">

                               </textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @include('icon.icon')
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">
                        <i class="fa fa-ban"></i> Close</button>
                    <button type="button" class="btn btn-success" onclick="edit_parent_permission()">
                        <i class="fa fa-check"></i> Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <section id="shopping-cart">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap bar-warning">
                            <h4 class="card-title">{{trans('messages.System Menu')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-block">



                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tabX1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Main Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tabX2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Sub Functions</a>
                                </li>

                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tabX1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">{{trans('messages.MENU NAME')}} *</label>
                                                <input type="text" class="form-control" id="menu_name" name="menu_name" value="" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="url">{{trans('messages.MENU URL')}} *</label>
                                                <input type="text" class="form-control" id="url" name="url" value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="parent_per_save">Description</label>
                                                <textarea class="form-control" name="" id="parent_per_save" cols="30" rows="10">

                                            </textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            @include('icon.icon')
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn mr-1 btn-success float-right" onclick="add()"><i class="ft-thumbs-up position-right"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" aria-labelledby="base-tabX2">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="parent_menu">{{trans('messages.SELECT PARENT')}}</label>
                                                <select class="form-control" id="parent_menu" name="parent_menu">

                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_menu_name">{{trans('messages.SUB MENU NAME')}}</label>
                                                <input type="text" class="form-control" id="sub_menu_name" name="sub_menu_name" value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_url">{{trans('messages.MENU URL')}}</label>
                                                <input type="text" class="form-control" id="sub_url" name="sub_url" value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="submenu" value="2" checked name="menutype" class="custom-control-input">
                                                <label class="custom-control-label" for="submenu">{{trans('Sub Menu')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="subfunction" value="3" name="menutype" class="custom-control-input">
                                                <label class="custom-control-label" for="subfunction">{{trans('Sub Function')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_per_save">Description</label>
                                                <textarea class="form-control" name="" id="sub_per_save" cols="30" rows="10">

                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @include('icon.icon')
                                        </div>

                                        <div class="col-md-12">
                                            <button class="btn mr-1 btn-success float-right" onclick="add_sub_function()"><i class="ft-thumbs-up position-right"></i> Submit</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="tab-pane" id="tab3" aria-labelledby="base-tabX3">
                                    <p>Biscuit ice cream halvah candy canes bear claw ice cream cake chocolate bar donut. Toffee cotton candy liquorice. Oat cake lemon drops gingerbread dessert caramels. Sweet dessert jujubes powder sweet sesame snaps.</p>
                                </div> -->
                            </div>

                            <div class="permission_table">
                                @include('admin.permission_table')
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>



@stop
@section('script')
<script>
    $(function() {
        get_maine_menus();
    });


    function get_icon(thisthis) {
        // var icon = $('.fonticon-wrap').html();
        // $('.fa').css('color', 'grey');
        // $(this).css('color', 'blue');
    }
    var icon;
    $('.fonticon-wrap').on('click', function() {
        // Now the div itself as an object is $(this)

        icon = $(this).html();
        $('.fonticon-wrap').css('color', '');
        $(this).css('color', '#2196f3');
        // $(this).text('Saved').css('background', 'yellow');
    });

    function add() {
     
        $.ajax({
            type: 'POST',
            url: '/add_permission',
            data: {
                "_token": "{{ csrf_token() }}",
                'url': $('#url').val(),
                'menu_name': $('#menu_name').val(),
                'menu_type': 1,
                'description': $('#parent_per_save').val(),
                'icon': icon

            },
            beforeSend: function() {},
            success: function(data) {
                $('.validationMessage').remove();
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {
                        $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');
                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, 'SUCCESS', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    get_maine_menus();
                    get_permission_table();
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

    function get_maine_menus() {
        $.ajax({
            type: 'GET',
            url: '/get_maine_menus',
            data: {


            },
            beforeSend: function() {},
            success: function(data) {

                if (data.status == "true") {
                    $('#parent_menu').html('');
                    $('#parent_menu_edit').html('');

                    $('#parent_menu').append('<option value="">{{trans("messages.SELECT PARENT")}}</option>');
                    $('#parent_menu_edit').append('<option value="">{{trans("messages.SELECT PARENT")}}</option>');



                    $.each(data.details, function(key, val) {
                        $('#parent_menu_edit').append(`<option value="${val.id}">${val.menu_name}</option>`);
                        $('#parent_menu').append(`<option value="${val.id}">${val.menu_name}</option>`);

                    });
                }
            }

        });
    }


    function add_sub_function() {

        $.ajax({
            type: 'POST',
            url: '/add_sub_function',
            data: {
                "_token": "{{ csrf_token() }}",
                'sub_url': $('#sub_url').val(),
                'sub_menu_name': $('#sub_menu_name').val(),
                'parent_menu': $("#parent_menu").val(),
                'icon': icon,
                'menu_type': $("input[name='menutype']:checked").val(),
                'description': $('#sub_per_save').val(),
            },
            beforeSend: function() {},
            success: function(data) {
                $('.validationMessage').remove();
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {

                        $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');
                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, 'SUCCESS', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    get_maine_menus();
                    get_permission_table();
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

    function get_permission_table() {
        $.ajax({
            type: 'GET',
            url: '/get_permission_table',
            data: {
                "_token": "{{ csrf_token() }}",
                'sub_url': $('#sub_url').val(),
                'sub_menu_name': $('#sub_menu_name').val(),
                'parent_menu': $("#parent_menu").val(),
                'menu_type': $("input[name='menutype']:checked").val(),

            },
            beforeSend: function() {},
            success: function(data) {

                // $('.permission_table').html(data);
                // $('.permission_table').load('.permission_table > *');
                window.location.reload();
            }
        });
    }

    function status_change(id, status) {
        swal({
            title: '{{trans("messages.Are you sure?")}}',
            text: "{{trans('You won\'t be able to revert this!')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{trans("Yes")}}',
            cancelButtonText: '{{trans("No")}}',
            confirmButtonClass: 'btn btn-success btn-raised mr-5',
            cancelButtonClass: 'btn btn-danger btn-raised',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type: 'POST',
                url: '/status_change',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": status,
                    'table': 'system_permission',
                    'colom': 'active_status'
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

                        toastr.success(data.message, 'SUCCESS', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                        get_permission_table();
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
        }, function(dismiss) {

        }).done();


    }

    function update(sub_id, parent_id, menu_type) {

        $('#sub_url_edit').val($('#tsurl'+sub_id).val());
        $('#sub_menu_name_edit').val($('#tsname'+sub_id).val());
        $('#edit_model').modal('show');
        $('#edit_id').val(sub_id);
        $('#sub_per').val($('#tsdesc'+sub_id).val());


        if (menu_type == 2) {
            $("#submenu_edit").prop("checked", true);
        }
        if (menu_type == 3) {

            $("#subfunction_edit").prop("checked", true);

        }
        $('#parent_menu_edit').val(parent_id).trigger('change');

    }

    function edit_sub_function() {

        $.ajax({
            type: 'POST',
            url: '/edit_sub_function',
            data: {
                "_token": "{{ csrf_token() }}",
                'sub_url_edit': $('#sub_url_edit').val(),
                'sub_menu_name_edit': $('#sub_menu_name_edit').val(),
                'parent_menu_edit': $("#parent_menu_edit").val(),
                'menu_type': $("input[name='menutype_edit']:checked").val(),
                'icon': icon,
                'description': $('#sub_per').val(),
                'id': $('#edit_id').val()
            },
            beforeSend: function() {},
            success: function(data) {
                $('.validationMessage').remove();
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {
                        $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');

                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, 'SUCCESS', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    get_maine_menus();
                    get_permission_table();
                    $('#edit_model').modal('hide');
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

    function update_parent(id) {
        $('#url_edit').val($('#tpurl'+id).val());
        $('#menu_name_edit').val($('#tpname'+id).val());
        $('#edit_model_parent').modal('show');
        $('#edit_id_parent').val(id);
        $('#parent_per').val($('#tpdesc'+id).val());


    }

    function edit_parent_permission() {
        $.ajax({
            type: 'POST',
            url: '/edit_parent_permission',
            data: {
                "_token": "{{ csrf_token() }}",
                'url_edit': $('#url_edit').val(),
                'menu_name_edit': $('#menu_name_edit').val(),
                'menu_type': 1,
                'icon': icon,
                'description': $('#parent_per').val(),
                'id': $('#edit_id_parent').val()
            },
            beforeSend: function() {},
            success: function(data) {
                $('.validationMessage').remove();
                if (data.status == "errors") {
                    $.each(data.error, function(key, val) {
                        $('#' + key).after('<p class="validationMessage">' + val[0] + '</p>');
                        toastr.error(val[0], 'ERROR', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });

                    });
                }
                if (data.status == "true") {

                    toastr.success(data.message, 'SUCCESS', {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    get_maine_menus();
                    get_permission_table();
                    $('#edit_model_parent').modal('hide');
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

    function delete_sub_function(id) {
        swal({
            title: '{{trans("messages.Are you sure?")}}',
            text: "{{trans('You won\'t be able to revert this!')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: '{{trans("Yes")}}',
            cancelButtonText: '{{trans("No")}}',
            confirmButtonClass: 'btn btn-success btn-raised mr-5',
            cancelButtonClass: 'btn btn-danger btn-raised',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                type: 'POST',
                url: '/delete_sub_function',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
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

                        toastr.success(data.message, 'SUCCESS', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                        get_permission_table();
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
        }, function(dismiss) {

        }).done();
    }
</script>
@stop