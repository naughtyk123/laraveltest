@extends('front.includes.default')
@section('content')

<div class="container">

    <div class="row">
        <div class="col-lg-12 mb-2 mt-2">
            <img class="w-100" src="{{url($blogs->cover)}}" alt="..." />
        </div>
        <!-- Side widgets-->
        <h1>{{$blogs->title}}</h1>
        <!-- Blog entries-->
        <div class="col-lg-12 mt-2 mb-2">
            <div class="card">

                <div class="card-body" style="overflow:hidden">
                    {!! $blogs->blog !!}
                </div>

            </div>
        </div>

    </div>
</div>
@stop
@section('script')

@stop