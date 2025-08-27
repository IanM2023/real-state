<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog_list(Request $request)
    {
        $search = $request->get('search');
        $data['getRecord'] = Blog::getAllRecord($search);
        return view('admin.blog.list',$data);
    }

    public function blog_add()
    {   
        return view('admin.blog.add');
    }

    public function blog_store(Request $request)
    {
        // validate inputs
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:blogs,slug',
            'description' => 'required|string',
        ]);
    
        // save to database
        $blog = new Blog();
        $blog->title       = trim($validated['title']);
        $blog->slug        = trim($validated['slug']);
        $blog->description = trim($validated['description']);
        $blog->save();
    
        // redirect with success message
        return redirect('admin/blog')->with('success', 'Blog created successfully!');

    }

    public function blog_edit(Request $request, $id)
    {
        $data['getRecord'] = Blog::findOrFail($id);

        return view('admin.blog.edit', $data);
    }

    public function blog_view($id)
    {
        $data['getRecord'] = Blog::findOrFail($id);

        return view('admin.blog.view', $data);
    }

    public function blog_update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title       = trim($validated['title']);
        $blog->slug        = trim($validated['slug']);
        $blog->description = trim($validated['description']);
        $blog->save();

        return redirect('admin/blog')->with('success', 'Blog updated successfully!');
    }

    public function blog_delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect('admin/blog')->with('success', 'Blog deleted successfully!');
    }

    
}
