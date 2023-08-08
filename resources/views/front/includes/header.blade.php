<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{url('assets/front/favicon.ico')}}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/custom.css')}}">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('front')}}">Blog</a></li>
                        @if(session()->get('user'))
                        <li class="nav-item mr-0"><a id="dropdownBasic3" href="#" class="nav-link position-relative"><span class="avatar avatar-online">
                                        <!-- <img id="navbar-avatar" src="{{url('assets/app-assets/img/portrait/small/avatar-s-3.jpg')}}" alt="avatar" /></span> -->
                                        @inject('central', 'App\CentralLogics\Uservalidation')

                                        {!!$central->user_icon()!!}

                                       
                                </a>
                            
                            </li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('logout')}}">logout</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('dashboard')}}">dashboard</a></li>


                            @else
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('login')}}">login</a></li>
                            @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <!-- <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header> -->