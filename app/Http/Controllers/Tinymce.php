<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Tinymce extends Controller
{
    public function uploads(Request $request)
    {

        //     var_dump($request->all);
        //    $mainimage=$request->file('file');
        //    $filename=uniqid().'.'.$mainimage->extension();
        //    Image::make($mainimage)->save(public_path('faq/'.$filename));

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->extension();
        $file->move(public_path('service'), $filename);
        $data['image'] = $filename;

        return json_encode(['location' => public_path('service/' . $filename)]);
    }

    public function remove_tiny_image(Request $request)
    {
      
        $file = explode("/", $request->imageSrc);


        @unlink('service/' . $file[count($file) - 1]);
    }
}
