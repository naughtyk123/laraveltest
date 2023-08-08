

<div data-active-color="white" data-background-color="crystal-clear" data-image="{{url('assets/app-assets/img/sidebar-bg/08.jpg')}}" class="app-sidebar">
    <div class="sidebar-header">
        <div class="logo clearfix">
                <div class="logo-img"></div><span class="text align-middle">Test</span>
            <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-disc toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-circle"></i></a></div>
    </div>
    <div class="sidebar-content">
        <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
         

                @if(session()->get('user'))
                <li class="has-sub nav-item"><a href="{{url('dashboard')}}" class="menu-item"><i class="icon-layers"></i>Dashboard</a>
                </li>
                @endif

                @if(session()->get('user') && session()->get('user')['is_admin']==1)
               
             


                <li class="has-sub nav-item">
                    <a href="#"><i class="icon-users"></i><span data-i18n="" class="menu-title">Blog</span></a>
                    <ul class="menu-content">
                        <li class="@if(Request::is('create_blog')) active @endif">
                            <a href="{{url('create_blog')}}" class="menu-item"><i class="icon-layers"></i>Create</a>
                        </li>
                        <li class="@if(Request::is('blog_list')) active @endif">
                            <a href="{{url('blog_list')}}" class="menu-item"><i class="icon-layers"></i>list</a>
                        </li>
                    </ul>
                </li>
           
                @endif
                @if(session()->get('user'))
                @inject('permissions', 'App\CentralLogics\Uservalidation')
                <?php

                $user_menus_ids = $permissions->check_user_permissions();


                ?>
                @foreach($user_menus_ids as $key=>$val)
                @php($menu_details=$permissions->get_urls($key))
                <li class="has-sub nav-item">
                    <a href="#"><?= $menu_details->icon ?><span data-i18n="" class="menu-title">{{$menu_details->menu_name}}</span></a>
                    <ul class="menu-content">
                        @if($val)
                        @foreach($val as $key_two=>$val_two)


                        @if($val_two)
                        @foreach($val_two as $key_three=>$val_three)
                        @if($val_three)
                        @php($menu_details=$permissions->get_urls($val_three))
                        @if($menu_details)
                        <li class="@if(Request::is($menu_details->url)) active @endif">
                            <a href="{{url($menu_details->url)}}" class="menu-item"><?= $menu_details->icon ?>{{$menu_details->menu_name}}</a>
                        </li>
                        @endif

                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                    </ul>
                </li>
                @endforeach
                @endif
                <!-- end -->
            </ul>
        </div>

    </div>
    <div class="sidebar-background"></div>
</div>
<script>
    // 1
    // let container1 = document.querySelector("#one");
    // let text1 = document.querySelector("#one span");

    // if (container1.clientWidth < text1.clientWidth) {
    //   text1.classList.add("animate");
    // }

    // 2
    let container2 = document.querySelector(".menu-item");
    let text2 = document.querySelector(".menu-item a");

    if (container2.clientWidth < text2.clientWidth) {
        text2.classList.add("animate");
    }
</script>