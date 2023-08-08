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
                        <div class="card px-4 py-2 box-shadow-2 width-400">
                            <div class="card-header text-center">
                                <!-- <img src="app-assets/img/logos/logo-color-big.png" alt="company-logo" class="mb-3" width="80"> -->
                                <h4 class="text-bold-400 grey darken-1">Login</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-block">
                                    
                                    
                                    <form method="POST" action="{{url('attempt_login')}}">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <div class="col-md-12">
                                            <label>Username </label>
                                            <!-- form-control-lg  removed from the class size is too big-->
                                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email Address" required email>
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?= $prev ?>" name="prev">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                            <label>Password </label>
                                            <!-- form-control-lg  removed from the class size is too big-->
                                                <input type="password" class="form-control" name="password" id="inputPass" placeholder="Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0 ml-5">
                                                        <input type="checkbox" class="custom-control-input" checked id="rememberme">
                                                        <label class="custom-control-label float-left" for="rememberme">Remember Me</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <div class="text-center col-md-12">
                                                <button type="submit" class="btn btn-success px-4 py-2  white font-small-4 box-shadow-2 border-0"> Login </button>
                                                <hr>
                                               <center> OR<br>
                                                <a href="{{url('create_user')}}">Register</a>
                                               </center>
                                                <hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="  mb-2 mr-sm-2 mb-sm-0 ml-6">
                                                    
                                                        <a href="{{url('forget-password')}}" class=" float-left" for="rememberme">Forgotten Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                     

                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-2 mr-sm-2 mb-sm-0 ml-8">
                                                        <label class="float-left" for="rememberme">Cancel</label>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>


                                    </form>
                                </div>
                            </div>
                            <!-- <div class="card-footer grey darken-1"> -->
                                <!-- <div class="text-center mb-1">Forgot Password? <a><b>Reset</b></a></div> -->
                                <!-- <div class="text-center">Don't have an account? <a><b>Signup</b></a></div> -->
                            <!-- </div> -->
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
    
        @if (!empty(session('error')))
            toastr.error('{{ session('error') }}', 'ERROR', {
                "showMethod": "slideDown",
                "hideMethod": "slideUp",
                timeOut: 2000
            });
            // alert('asdasdasd');
        @endif
        window.Echo.channel('chat').listen('forwebsocket', (data) => {

            console.log(data);



        });

        function login() {
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
        }
    </script>
</body>

</html>