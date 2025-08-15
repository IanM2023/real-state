<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function color_list(Request $request)
    {
        $data['getRecord'] = Color::latest()->get();
        return view('admin.color.list', $data);
    }

    public function add_color(Request $request)
    {
        return view('admin.color.add');
    }

    public function insert_color(Request $request)
    {
        $save = new Color;
        $save->color_name = trim($request->color_name);
        $save->save();
        return redirect('admin/color')->with('success', 'New Color Successfully added');
    }

    public function edit_color(Request $request, $id)
    {
        $data['getRecord'] = Color::findorFail($id);
        return view('admin.color.edit', $data);
    }

    public function update_color(Request $request, $id)
    {
        $color = Color::findorFail($id);
        $color->color_name = trim($request->color_name);
        $color->save();
        return redirect('admin/color')->with('success', 'Color updated successfully');
    }

    public function delete_color(Request $request, $id)
    {
        $color = Color::findorFail($id);
        $color->delete();
        return redirect('admin/color')->with('success', 'Color deleted successfully');
    }

}
