<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog_detail;
use Illuminate\Http\Request;

class Front extends Controller
{
    public  function index()
    {

      $blogs = Blog_detail::paginate(5);
        $sit_data = [
            'title' => 'Front',
            'blogs' => $blogs,

        ];
        return view('front.index', $sit_data);
    }

    public  function blog(Request $request)
    {

      $blogs = Blog_detail::where('id','=',$request->id)->first();
        $sit_data = [
            'title' => 'Front',
            'blogs' => $blogs,

        ];
        return view('front.single_blog', $sit_data);
    }
}
