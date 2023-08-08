@extends('includes.default')
@section('content')
<style>
    .s_user_list {
        display: block !important;
        padding-bottom: 20px;
    }
</style>
<div class="container-fluid">

    <section id="shopping-cart">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap bar-warning">
                            <h4 class="card-title">User List</h4>
                            <a class="btn mr-1 btn-success float-right" href="{{url('create_user')}}"><i class="ft-plus-circle"></i> {{trans('messages.Add')}}</a>

                        </div>
                    </div>
                    <div class="card-body">



                        <div class="card-block">
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

                                            </div>

                                            <div class="form-actions right modalbtncss">

                                                <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">
                                                    <i class="fa fa-ban"></i> Cancel
                                                </button>
                                                <button type="button" onclick="filter()" class="btn btn-success">
                                                    <i class="fa fa-check"></i> Apply Filters
                                                </button>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Filter
                                </button>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration dataTable usertable" role="grid" aria-describedby="DataTables_Table_0_info" id="all-member-table" style="width: 1090px;">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">ID</th>

                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Contact</th>
                                            <th class="border-top-0">Group</th>
                                            <th class="border-top-0">NIC</th>
                                            <th class="border-top-0">Address</th>
                                            <th class="border-top-0">Active Status</th>

                                            <th class="border-top-0">Action</th>




                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    @stop
    @section('script')
    <script>
        function filter() {
            table.destroy();
            get_users_list();
        }
        $(document).ready(function() {
            $(".icons-tab-steps").steps({
                headerTag: "h6",
                bodyTag: "fieldset",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: 'Submit'
                },
                onFinished: function(event, currentIndex) {
                    // alert("Form submitted.");
                    create_user();
                }
            });

            // To select event date
            $('.pickadate').pickadate();
        });

        $(document).ready(function() {
            get_users_list()
        });
        var table = '';

        function get_users_list() {
            table = $('#all-member-table').DataTable({
                dom: 'Bflrtip',
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


                "ajax": {
                    "url": "{{ route('get_users_list') }}",
                    "type": "GET",
                    "data": {
                        'st_name': $('#st_name').val(),
                        'st_email': $('#st_email').val(),
                        'st_contact': $('#st_contact').val(),
                        'st_group': $('#st_group').val(),
                        'st_nic': $('#st_nic').val(),
                        'st_address': $('#st_address').val(),
                        'st_active_status': $('#st_active_status').val(),
                    },
                    "processing": true,
                    "serverSide": true,
                    "datetype": "json",
                    sortable: true
                },
                "columns": [{
                        "data": "id"
                    },
                    // {
                    //     "data": "active_stat"
                    // },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "mobile"
                    },
                    {
                        "data": "groups"
                    },
                    {
                        "data": "nic"
                    },
                    {
                        "data": "address"
                    },
                    // {
                    //     "data": "id",
                    //     "searchable": false,
                    //     "sortable": false,
                    //     "render": function(id, type, full, meta) {
                    //         return '<a href="/user/userdata/' + id + '"><i class="fa fa-pencil"></i></a>';
                    //     }
                    // },
                    {
                        "data": "status"
                    },
                    {
                        "data": "action"
                    },



                ]
            });


        }


        function status_change(id, status) {

            // swal({
            //     title: '{{trans("messages.Are you sure?")}}',
            //     text: "{{trans('You won\'t be able to revert this!')}}",
            //     type: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#0CC27E',
            //     cancelButtonColor: '#FF586B',
            //     confirmButtonText: '{{trans("Yes")}}',
            //     cancelButtonText: '{{trans("No")}}',
            //     confirmButtonClass: 'btn btn-success btn-raised mr-5',
            //     cancelButtonClass: 'btn btn-danger btn-raised',
            //     buttonsStyling: false
            // }).then(function() {
            $.ajax({
                type: 'POST',
                url: '/status_change',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": status,
                    'table': 'users',
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
                        table.destroy();
                        get_users_list();
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
            // }, function(dismiss) {

            // }).done();


        }

        function delete_user(id, status) {


            $.ajax({
                type: 'POST',
                url: '/delete_user',
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
                        table.destroy();
                        get_users_list();
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