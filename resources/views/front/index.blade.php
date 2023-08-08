@extends('front.includes.default')
@section('content')

<div class="container">

    <div class="row">
        <div class="col-lg-12 mb-2 mt-2">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://e0.pxfuel.com/wallpapers/532/572/desktop-wallpaper-nature-minimalist-style.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://e0.pxfuel.com/wallpapers/532/572/desktop-wallpaper-nature-minimalist-style.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://e0.pxfuel.com/wallpapers/532/572/desktop-wallpaper-nature-minimalist-style.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-12">
            @include('front.includes.sidebar')
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">

            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @if($blogs)
                @foreach($blogs as $blog)
                <div class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card card_hover mb-4">

                        <a href="{{url('blog',$blog->id)}}"><img class="card-img-top" src="{{url($blog->cover)}}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->diffForhumans() }}</div>
                            <h2 class="card-title h4">{{$blog->title}}</h2>
                            <p class="card-text">{{$blog->summery}}</p>

                        </div>
                    </div>

                </div>
                @endforeach
                {{ $blogs->links('pagination::bootstrap-4') }}
                @else

                    <h1>No blogs to show</h1>

                @endif
            </div>

        </div>

    </div>
</div>
@stop
@section('script')

@stop