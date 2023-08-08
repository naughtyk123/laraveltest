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
                            <h4 class="card-title" id="horz-layout-basic">{{trans('messages.Edit User')}} - {{$user_details->email}}</h4>

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
                                                <input type="text" class="form-control" id="firstName" name="firstName" value="{{$user_details->first_name}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastName">{{trans('messages.LAST_NAME')}} *</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName" value="{{$user_details->last_name}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailAddress">{{trans('messages.EMAIL_ADDRESS')}} *</label>
                                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" value="{{$user_details->email}}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nic">{{trans('messages.NIC')}} *</label>
                                                <input type="text" class="form-control" id="nic" name="nic" value="{{$user_details->nic}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">{{trans('messages.PHONE_NUMBER')}} *</label>
                                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="{{$user_details->mobile}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">{{trans('messages.SECONDERY_PHONE_NUMBER')}}</label>
                                                <input type="tel" class="form-control" id="phoneNumber_second" name="phoneNumber_second" value="{{$user_details->second_mobile_number}}" />
                                            </div>
                                        </div>


                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="location">{{trans('messages.SELECT_CITY')}} *</label>
                                                <select class="custom-select form-control" id="location" name="location">

                                                <option value="">Select City</option>
                                                    @foreach($locations as $loc)
                                                    <option @if($user_details -> location == $loc->location) selected @endif value="{{$loc->location}}">
                                                        {{$loc->location}}
                                                    </option>
                                                    @endforeach
                                                   
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">{{trans('messages.ADDRESS')}} *</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{$user_details->address}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address">{{trans('messages.Gender')}}</label>

                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="male" value="1" @if($user_details->gender==1) checked @endif name="gender" class="custom-control-input">
                                                <label class="custom-control-label" for="male">{{trans('Male')}}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="female" value="2" name="gender" @if($user_details->gender==2) checked @endif class="custom-control-input">
                                                <label class="custom-control-label" for="female">{{trans('Female')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <!-- Step 2 -->
                                <h6>{{trans('messages.User Configuration')}}</h6>
                                <!-- <fieldset> -->
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_role">{{trans('User Group')}} *</label>

                                                <select class="custom-select form-control" id="user_group" name="user_group">
                                                    <option value="">Select User Group</option>
                                                    @foreach($group_list as $group)
                                                   
                                                    @if($user_details->group!='' &&  $user_details->group->group_detail!='')


                                                    @if($user_details->group->group_detail->id == $group->id )
                                                    <?php
                                                    $select = 'selected';
                                                    ?>
                                                    @else
                                                    <?php
                                                    $select = '';
                                                    ?>
                                                    @endif

                                                    @else
                                                    <?php
                                                    $select = '';
                                                    ?>
                                                    @endif

                                                    <option <?= $select ?> value="{{$group->id}}">
                                                        {{$group->group_name}}
                                                    </option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="user_role">{{trans('messages.User')}} *</label>
                                            <div class="custom-control custom-checkbox m-0">
                                                <input @if($user_details -> is_admin == 1) checked @endif type="checkbox" class="custom-control-input" id="isadmin">
                                                <label class="custom-control-label" for="isadmin">{{trans('messages.IS ADMIN')}}</label>
                                            </div>

                                            <div class="custom-control custom-checkbox m-0">
                                                <input @if($user_details -> active_status == 1) checked @endif type="checkbox" class="custom-control-input" id="isactive">
                                                <label class="custom-control-label" for="isactive">{{trans('messages.IS ACTIVE')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- Step 3 -->
                                <!-- <h6>Step 3</h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="eventName2">Event Name</label>
                                                <input type="text" class="form-control" id="eventName2" name="eventName2" />
                                            </div>
                                            <div class="form-group">
                                                <label for="eventType2">Event Type</label>
                                                <select class="custom-select form-control" id="eventType2" data-placeholder="Type to search cities" name="eventType2">
                                                    <option value="Banquet">Banquet</option>
                                                    <option value="Fund Raiser">
                                                        Fund Raiser
                                                    </option>
                                                    <option value="Dinner Party">
                                                        Dinner Party
                                                    </option>
                                                    <option value="Wedding">Wedding</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="eventLocation2">Event Location</label>
                                                <select class="custom-select form-control" id="eventLocation2" name="eventLocation2">
                                                    <option value="">Select City</option>
                                                    <option value="Amsterdam">
                                                        Amsterdam
                                                    </option>
                                                    <option value="Berlin">Berlin</option>
                                                    <option value="Frankfurt">
                                                        Frankfurt
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Event Date</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control pickadate" placeholder="Select Date" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <span class="fa fa-calendar-o"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="eventStatus2">Event Status</label>
                                                <select class="custom-select form-control" id="eventStatus2" name="eventStatus2">
                                                    <option value="Planning">Planning</option>
                                                    <option value="In Progress">
                                                        In Progress
                                                    </option>
                                                    <option value="Finished">Finished</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <span>Requirements</span>
                                                <div class="checkbox">
                                                    <div class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input" id="staffing" />
                                                        <label class="custom-control-label" for="staffing">Staffing</label>
                                                    </div>
                                                </div>
                                                <div class="checkbox">
                                                    <div class="custom-control custom-checkbox m-0">
                                                        <input type="checkbox" class="custom-control-input" id="catering" />
                                                        <label class="custom-control-label" for="catering">Catering</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset> -->
                                <!-- Step 4 -->
                                <!-- <h6>Step 4</h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meetingName2">Name of Meeting</label>
                                                <input type="text" class="form-control" id="meetingName2" name="meetingName2" />
                                            </div>
                                            <div class="form-group">
                                                <label for="meetingLocation2">Location</label>
                                                <input type="text" class="form-control" id="meetingLocation2" name="meetingLocation2" />
                                            </div>
                                            <div class="form-group">
                                                <label for="participants2">Names of Participants</label>
                                                <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="decisions2">Decisions Reached</label>
                                                <textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Agenda Items</label>
                                                <div class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="1st-item" />
                                                    <label class="custom-control-label" for="1st-item">1st item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="2nd-item" />
                                                    <label class="custom-control-label" for="2nd-item">2nd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="3rd-item" />
                                                    <label class="custom-control-label" for="3rd-item">3rd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="4th-item" />
                                                    <label class="custom-control-label" for="4th-item">4th item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox m-0">
                                                    <input type="checkbox" class="custom-control-input" id="5th-item" />
                                                    <label class="custom-control-label" for="5th-item">5th item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset> -->
                            </form>
                            <div class="form-actions right">
                                <button type="button" class="btn btn-danger mr-1">
                                    <i class="fa fa-ban"></i> <a href="{{url('user-list')}}"> Cancel <a>
                                </button>
                                <button type="submit" onclick="edit_user()" class="btn btn-success">
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
                edit_user();
            }
        });

        // To select event date
        $('.pickadate').pickadate();
        $('.steps  .disabled').removeClass('disabled');
    });

    function edit_user() {

        $.ajax({
            type: 'POST',
            url: '/edit_user_details',
            data: {
                "_token": "{{ csrf_token() }}",
                "firstName": $('#firstName').val(),
                "lastName": $('#lastName').val(),
                "emailAddress": $('#emailAddress').val(),
                "phoneNumber": $('#phoneNumber').val(),
                "phoneNumber_second": $('#phoneNumber_second').val(),
                // "location": $('#location').val(),
                'user_group': $('#user_group').val(),

                'gender': $("input[name='gender']:checked").val(),
                // 'second_emailAddress': $('#second_emailAddress').val(),
                'is_admin': $('#isadmin').is(':checked') ? 1 : 0,
                'active_status': $('#isactive').is(':checked') ? 1 : 0,
                'address': $('#address').val(),
                'nic': $('#nic').val(),
                'id': '{{$user_id}}'
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
                    window.location.href = '/user-list';
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