<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog_list()
    {
        return view('admin.blog.list');
    }

    public function blog_add()
    {   
        return view('admin.blog.add');
    }

    public function blog_store(Request $request)
    {
        dd($request->all());
    }
}
