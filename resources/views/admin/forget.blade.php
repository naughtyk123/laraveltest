<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="UNFAO">
    <meta name="keywords" content="UNFAO">
    <meta name="author" content="PROCONS">
    <title>Login Page - NEB</title>
    <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/toastr.css')}}">


</head>
<style>
    .btn-efaas {
        background: #033655 !important;
        color: #ffffff !important;
    }
</style>

<body data-col="1-column" class=" 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <!--Login Page Starts-->
        <section id="login">

            <example-component></example-component>
            <div class="container-fluid">


                <div class="row full-height-vh">
                    <div class="col-12 d-flex align-items-center justify-content-center gradient-aqua-marine">
                        <div class="card px-4 py-2 box-shadow-2 ">


                            <a href="login" class="previous round "> <span style='font-size:25px;'>&#8592;</span> </a>

                            <div class="card-header text-center">
                                <!-- <img src="app-assets/img/logos/logo-color-big.png" alt="company-logo" class="mb-3" width="80"> -->



                                <h4 class="text-bold-400 grey darken-1">Forgot your Password ?</h4>
                                <center>Enter the email address associated with your account.</center>
                            </div>
                            <div class="card-body">
                                <div class="card-block">


                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Email</label>
                                            <!-- form-control-lg  removed from the class size is too big-->
                                            <input type="email" class="form-control " name="email" id="email" placeholder="Email Address" required email>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <div class="text-center col-md-12">
                                            <button onclick="resetemail()" type="button" class="btn btn-success px-4 py-2 white font-small-4 box-shadow-2 border-0">Continue</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer grey darken-1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Login Page Ends-->
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{url('assets/app-assets/vendors/js/core/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/core/popper.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/core/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/prism.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/screenfull.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/pace/pace.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CONVEX JS-->
    <script src="{{url('assets/app-assets/js/app-sidebar.js')}}"></script>
    <script src="{{url('assets/app-assets/js/notification-sidebar.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/toastr.min.js')}}"></script>
    <!-- END CONVEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script src="{{url('js/app.js')}}"></script>
    <script>
        @if(!empty(session('error')))
        toastr.error('{{ session('
            error ') }}', 'ERROR', {
                "showMethod": "slideDown",
                "hideMethod": "slideUp",
                timeOut: 2000
            });
        // alert('asdasdasd');
        @endif
    

        function resetemail() {
            $.ajax({
                type: 'POST',
                url: '/resetemail',
                data: {

                    "_token": "{{ csrf_token() }}",
                    "email": $('#email').val(),

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

                        toastr.success(data.message, 'SUCCESS', {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                        // window.location.reload();
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
</body>

</html>