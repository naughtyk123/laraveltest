@extends('includes.default')
@section('content')
<style>

.s_groupl{
    display:block!important;
}

</style>
<div class="container-fluid">

 
    <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">{{trans('messages.Add Group')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="group_name">{{trans('Group Name')}} *</label>
                                <input type="text" id="group_name" class="form-control border-primary" name="group_name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="group_description">{{trans('Group Description')}}</label>
                                <textarea id="group_description" rows="5" class="form-control border-primary group_description" name="group_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-actions right  modalbtncss">
                        <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">
                            <i class="fa fa-ban"></i> Close</button>
                        <button type="button" onclick="save_group()" class="btn btn-success">
                        <i class="fa fa-check"></i> Save Changes</button>
                </div>
                      


            </div>
        </div>
    </div>

    <!-- edit model -->
    <div class="modal fade text-left" id="edit_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">{{trans('messages.Edit Group')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="group_name">{{trans('Group Name')}} *</label>
                                <input type="text" id="group_name_edit" class="form-control border-primary" name="group_name_edit">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="group_description_edit">{{trans('Group Description')}}</label>
                                <textarea id="group_description_edit" rows="5" class="form-control border-primary" name="group_description_edit"></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-1" data-dismiss="modal"> 
                        <i class="fa fa-ban"></i> Close</button>
                    <button type="button" onclick="edit_new_group()" class="btn btn-success">
                    <i class="fa fa-check"></i> Save changes</button>
                </div>
                
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-success">
                        <h4 class="card-title" id="basic-layout-form">{{trans('messages.User Groups')}}</h4>
                    </div>
                    <!-- <p class="mb-0">This is the most basic and cost estimation form is the default position.</p> -->
                    <a class="btn mr-1 btn-success float-right" data-toggle="modal" data-target="#large"><i class="ft-plus-circle"></i> {{trans('messages.Add')}}</a>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <form class="form">
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="group_name_search">{{trans('messages.Group Name')}}</label>
                                                <input type="text" class="form-control" id="group_name_search" name="group_name_search" />
                                            </div>
                                        </div> -->
                                        <!-- globale search -->
                                        <div class="col-md-13">
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @include('includes.search_include')
                                                            <!-- ->whereDate('created_at',$date) -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">
                                                                <i class="fa fa-ban"></i>  Close</button>
                                                            <button type="button" onclick="filter()" class="btn btn-success">
                                                            <i class="fa fa-check"></i> Apply Filters</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                                Filter
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration dataTable" role="grid" aria-describedby="DataTables_Table_0_info" id="all-member-table">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">ID</th>
                                                        <th class="border-top-0">Active Status</th>
                                                        <th class="border-top-0">Name</th>
                                                        <th class="border-top-0">Description</th>
                                                        <th class="border-top-0">Create Date</th>
                                                        <th class="border-top-0">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                            {{-- <table id="recent-orders" class="table table-hover table-xl mb-0">

                                                <thead>
                                                    <tr>
                                                        <th class="border-top-0">@sortablelink('id','ID')</th>
                                                        <th class="border-top-0">Active Status</th>
                                                        <th class="border-top-0">@sortablelink('group_name','Name')</th>
                                                        <th class="border-top-0">Description</th>
                                                        <th class="border-top-0">@sortablelink('created_at','Create Date')</th>

                                                        <th class="border-top-0">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($group_list)
                                                    @foreach($group_list as $group)
                                                    <tr>
                                                        <td>
                                                            {{$group->id}}
                                            </td>
                                            <td>
                                                @if($group->active_status==1)
                                                <i class="fa fa-dot-circle-o success font-medium-1 mr-1"></i> Active
                                                @else
                                                <i class="fa fa-dot-circle-o danger font-medium-1 mr-1"></i> Inactive
                                                @endif
                                            </td>
                                            <td>
                                                {{$group->group_name}}
                                            </td>
                                            <td>
                                                {{$group->description}}
                                            </td>
                                            <td>
                                                {{$group->created_at->format('Y-m-d')}}
                                            </td>

                                            <td>
                                                <a onclick="editgroup('{{$group->id}}',' {{$group->group_name}}','{{$group->description}}')" class="success p-0" data-original-title="" title="">
                                                    <i class="fa fa-pencil font-medium-3 mr-2"></i>
                                                </a>
                                                @if($group->active_status==1)
                                                <a onclick="status_change( {{$group->id}},0)" class="danger p-0" data-original-title="" title="">
                                                    <i class="fa fa-times font-medium-3 mr-2"></i>
                                                </a>
                                                @else
                                                <a onclick="status_change({{$group->id}},1)" class="info p-0" data-original-title="" title="">
                                                    <i class="fa fa-check font-medium-3 mr-2"></i>
                                                </a>
                                                @endif

                                            </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            @endif
                                            </tbody>
                                            </table>
                                            <div class="pagi">
                                                {{$group_list->links('pagination::bootstrap-4')}}
                                            </div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop
@section('script')
<script>
    function save_group() {

        $.ajax({
            type: 'POST',
            url: '/save_group',
            data: {
                "_token": "{{ csrf_token() }}",
                "group_name": $('#group_name').val(),
                "group_description": $('.group_description').val(),


            },
            beforeSend: function() {},
            success: function(data) {
                $(".validationMessage").remove();
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

                    toastr.success(data.message, data.title, {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    window.location.reload();

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
                    'table': 'user_groups',
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
                        window.location.reload();
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

    function editgroup(id, name, description) {
        // alert('wer');
        $('#group_description_edit').val(description);
        $('#group_name_edit').val(name);
        $('#edit_group').modal('show');
        $('#edit_id').val(id);
    }

    function edit_new_group() {
        $.ajax({
            type: 'POST',
            url: '/edit_group',
            data: {
                "_token": "{{ csrf_token() }}",
                "group_name_edit": $('#group_name_edit').val(),
                "group_description_edit": $('#group_description_edit').val(),
                'id': $('#edit_id').val(),

            },
            beforeSend: function() {},
            success: function(data) {
                $(".validationMessage").remove();
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

                    toastr.success(data.message, data.title, {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 2000
                    });
                    $('#edit_group').modal('hide');
                    table.ajax.reload();
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


    function filter() {
            table.destroy();
            get_user_groups();
    }

    $(document).ready(function() {
        get_user_groups()
    });
    var table = '';

    function get_user_groups() {
        table = $('#all-member-table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    charset: 'utf-8',
                    extension: '.csv',
                    bom: true
                },
                {
                    extend: 'excel',
                    charset: 'utf-8',
                    extension: '.xlsx',
                    bom: true
                },
                {
                    extend: 'pdf',
                    charset: 'utf-8',
                    extension: '.pdf',
                    bom: true
                },
                {
                    extend: 'print',
                    charset: 'utf-8',
                    bom: true
                }
            ],
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "{{ route('get_user_groups') }}",
                "type": "GET",
                "data": {
                    'st_active_status':$('#st_active_status').val(),
                    'st_adddate':$('#st_adddate').val(),
                    'st_group':$('#st_group').val(),

                },
                "processing": true,
                "serverSide": true,
                "datetype": "json",
                sortable: true
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "active_stat"
                },
                {
                    "data": "group_name"
                },
                {
                    "data": "description"
                },
                {
                    "data": "create_at"
                },
                {
                    "data": "action"
                }


            ]
        });


    }

    $('#group_name_search').on('keyup', function() {
        table
            .columns(2)
            .search(this.value)
            .draw();
    });

    $('#active_status').on('change', function() {
        console.log(table
            .columns(0));

        table
            .columns('active_stat')
            .search(this.value)
            .draw();



    });
</script>

@stop