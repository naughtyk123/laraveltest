@extends('includes.default')
@section('content')
<div class="container-fluid">
   
    <!-- Wizard Starts -->
 
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-success">
                        <h4 class="card-title" id="horz-layout-basic">{{trans('messages.Create User')}}</h4>
                    </div>

                </div>
                    <div class="card-body">
                        <div class="card-block">
                            <form class="icons-tab-steps wizard-circle">
                                <!-- Step 1 -->
                                <h6>{{trans('messages.User Details')}}</h6>
                                <!-- <fieldset> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">{{trans('messages.FIRST_NAME')}} *</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">{{trans('messages.LAST_NAME')}} *</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailAddress">{{trans('messages.EMAIL_ADDRESS')}} *</label>
                                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" />
                                            </div>
                                        </div>

                                

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nic">Password *</label>
                                                <input type="password" class="form-control" id="password" name="password" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nic">Confirm Password *</label>
                                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">{{trans('messages.PHONE_NUMBER')}} *</label>
                                                <input type="text" class="form-control phoneNumber" id="phoneNumber" name="phoneNumber" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">{{trans('messages.SECONDERY_PHONE_NUMBER')}}</label>
                                                <input type="text" class="form-control phoneNumber_second" id="phoneNumber_second" name="phoneNumber_second" />
                                            </div>
                                        </div>


                                       

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">{{trans('messages.ADDRESS')}} *</label>
                                                <input type="text" class="form-control" id="address" name="address" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address">{{trans('messages.Gender')}} *</label>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="male" value="1" checked name="gender" class="custom-control-input">
                                                <label class="custom-control-label" for="male">{{trans('Male')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="female" value="2" name="gender" class="custom-control-input">
                                                <label class="custom-control-label" for="female">{{trans('Female')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                <!-- </fieldset> -->
                                <!-- Step 2 -->
                                <!-- <fieldset> -->
                                    <div class="row d-none">

                                        <div class="col-md-6">
                                            <label for="user_role">{{trans('messages.User')}}</label>
                                            <div class="custom-control custom-checkbox m-0">
                                                <input type="radio" class="custom-control-input" checked id="isadmin">
                                                <label class="custom-control-label" for="isadmin">{{trans('messages.IS ADMIN')}}</label>
                                            </div>

                                            <div class="custom-control custom-checkbox m-0">
                                                <input type="radio" class="custom-control-input" checked id="isactive">
                                                <label class="custom-control-label" for="isactive">{{trans('messages.IS ACTIVE')}}</label>
                                            </div>
                                        </div>

                                    </div>
               
                            </form>
                            <div class="form-actions right mt-2">
                            <a href="{{url('create_user')}}" type="button" class="btn btn-danger mr-1">
                                <i class="fa fa-ban"></i> Cancel
</a>
                            <button type="submit" onclick="create_user()" class="btn btn-success">
                                <i class="ft-thumbs-up position-right"></i> Submit
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Wizard Ends -->
</div>



@stop
@section('script')
<script>


    function create_user() {

        $.ajax({
            type: 'POST',
            url: '/add_user',
            data: {
                "_token": "{{ csrf_token() }}",
                "firstName": $('#firstName').val(),
                "lastName": $('#lastName').val(),
                "emailAddress": $('#emailAddress').val(),
                "phoneNumber": $('.phoneNumber').val(),
                "phoneNumber_second": $('.phoneNumber_second').val(),
                'gender': $("input[name='gender']:checked").val(),
                'address': $('#address').val(),
                'password_confirm': $('#password_confirm').val(),
                'password': $('#password').val(),

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
                    window.location.href = '/login';
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