<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    @include('includes.header')
</head>

<body data-col="2-columns" class=" 2-columns ">

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <div data-active-color="black" data-background-color="white" data-image="" class="app-sidebar">
            @if(session()->get('user'))
            @include('includes.sidebar')
            @endif
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-faded">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a class="open-navbar-container"><i class="ft-more-vertical"></i></a></span>
                    <!-- <p class="d-none">fullscreen</p></a><a class="ml-2 display-inline-block"><i class="ft-shopping-cart blue-grey darken-4"></i>              -->
                    <div class="dropdown ml-2 display-inline-block">
                        <a id="apps" href="#" data-toggle="dropdown"><span class="mx-1 blue-grey darken-4 text-bold-400"></span></a>
                        <!-- <div class="apps dropdown-menu">
                <div class="arrow_box"><a href="chat.html" class="dropdown-item py-1"><span>Chat</span></a><a href="taskboard.html" class="dropdown-item py-1"><span>TaskBoard</span></a><a href="calendar.html" class="dropdown-item py-1"><span>Calendar</span></a></div>
              </div> -->
                    </div>
                </div>
                <div class="navbar-container">
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <!-- <li class="nav-item mt-1 navbar-search text-left dropdown"><a id="search" href="#" data-toggle="dropdown" class="nav-link dropdown-toggle"><i class="ft-search blue-grey darken-4"></i></a>
                  <div aria-labelledby="search" class="search dropdown-menu dropdown-menu-right">
                    <div class="arrow_box_right">
                      <form role="search" class="navbar-form navbar-right">
                        <div class="position-relative has-icon-right mb-0">
                          <input id="navbar-search" type="text" placeholder="Search" class="form-control"/>
                          <div class="form-control-position navbar-search-close"><i class="ft-x"></i></div>
                        </div>
                      </form>
                    </div>
                  </div>
                </li> -->
                            <!-- <li class="dropdown nav-item mt-1"><a id="dropdownBasic" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-flag blue-grey darken-4"></i><span class="selected-language d-none"></span></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="arrow_box_right"><a href="javascript:;" class="dropdown-item py-1"><img src="app-assets/img/flags/us.png" alt="English Flag" class="langimg"/><span> English</span></a><a href="javascript:;" class="dropdown-item py-1"><img src="app-assets/img/flags/es.png" alt="Spanish Flag" class="langimg"/><span> Spanish</span></a><a href="javascript:;" class="dropdown-item py-1"><img src="app-assets/img/flags/br.png" alt="Portuguese Flag" class="langimg"/><span> Portuguese</span></a><a href="javascript:;" class="dropdown-item"><img src="app-assets/img/flags/de.png" alt="French Flag" class="langimg"/><span> French</span></a></div>
                  </div>
                </li> -->
                            <!-- <li class="dropdown nav-item mt-1"><a id="dropdownBasic2" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-bell blue-grey darken-4"></i><span class="notification badge badge-pill badge-danger">4</span>
                                    <p class="d-none">Notifications</p>
                                </a>
                                <div class="notification-dropdown dropdown-menu dropdown-menu-right">
                                    <div class="arrow_box_right">
                                        <div class="noti-list"><a class="dropdown-item noti-container py-2"><i class="ft-share info float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 info">New Order Received</span><span class="noti-text">Lorem ipsum dolor sit ametitaque in, et!</span></span></a><a class="dropdown-item noti-container py-2"><i class="ft-save warning float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 warning">New User Registered</span><span class="noti-text">Lorem ipsum dolor sit ametitaque in </span></span></a><a class="dropdown-item noti-container py-2"><i class="ft-repeat danger float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 danger">New Order Received</span><span class="noti-text">Lorem ipsum dolor sit ametest?</span></span></a><a class="dropdown-item noti-container py-2"><i class="ft-shopping-cart success float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 success">New Item In Your Cart</span><span class="noti-text">Lorem ipsum dolor sit ametnatus aut.</span></span></a><a class="dropdown-item noti-container py-2"><i class="ft-heart info float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 info">New Sale</span><span class="noti-text">Lorem ipsum dolor sit ametnatus aut.</span></span></a><a class="dropdown-item noti-container py-2"><i class="ft-box warning float-left d-block font-medium-4 mt-2 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 warning">Order Delivered</span><span class="noti-text">Lorem ipsum dolor sit ametnatus aut.</span></span></a></div><a class="noti-footer primary text-center d-block border-top border-top-blue-grey border-top-lighten-4 text-bold-400 py-1">Read All Notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item mt-1 d-none d-lg-block">
                                    <p class="d-none">Notifications Sidebar</p>
                                </li> -->
                            <li class="dropdown nav-item mr-0"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-user-link dropdown-toggle"><span class="avatar avatar-online">
                                        <!-- <img id="navbar-avatar" src="{{url('assets/app-assets/img/portrait/small/avatar-s-3.jpg')}}" alt="avatar" /></span> -->
                                        @inject('central', 'App\CentralLogics\Uservalidation')

                                        {!!$central->user_icon()!!}

                                        <p class="d-none">User Settings</p>
                                </a>
                                <div aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                                    <div class="arrow_box_right">
                                        <!-- <a href="user-profile-page.html" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>My Profile</span></a> -->
                                        <div class="dropdown-divider"></div>
                                        <a href="{{url('logout')}}" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                                        <a href="{{url('front')}}" class="dropdown-item"><i class="ft-power mr-2"></i><span>Front</span></a>

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-panel">
            <div class="main-content">
                <div class="content-wrapper">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>
            </div>

            <footer class="footer footer-static footer-light">
                @include('includes.footer')
            </footer>

        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{url('assets/app-assets/vendors/js/core/popper.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/core/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/prism.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/datatable/datatables.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/screenfull.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/pace/pace.min.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/sweetalert2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{url('assets/app-assets/vendors/js/chartist.min.js')}}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CONVEX JS-->
    <script src="{{url('assets/app-assets/js/app-sidebar.js')}}"></script>
    <script src="{{url('assets/app-assets/js/notification-sidebar.js')}}"></script>
    <!-- END CONVEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('assets/app-assets/js/dashboard-ecommerce.js')}}"></script>
    <script src="{{url('assets/app-assets/vendors/js/toastr.min.js')}}"></script>

    <!-- END PAGE LEVEL JS-->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    @yield('script')
    <script>

    </script>



</body>

</html>