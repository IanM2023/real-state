<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Traits\ColorMap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use OzdemirBurak\Iris\Color\Hex;
use OzdemirBurak\Iris\Color\Rgb;
use OzdemirBurak\Iris\Color\Named;

class ColorController extends Controller
{
    use ColorMap;

    public function color_list(Request $request)
    {
        $data['getRecord'] = Color::getColorList();
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

    public function color_pdf_demo()
    {
        $data = [
            'title' => 'Welcome New PDF Solution',
            'date' => date('m-d-Y')
        ];
      
        $pdf = PDF::loadView('pdf.myPDFDemo', $data);

        return $pdf->download('SolutionPDF.pdf');
    }

    public function color_pdf_color()
    {
        // Full list of CSS colors (you can expand this list as needed)
        $colorMap = $this->getColorMap();
    
        // Attach hex to each record
        $getRecord = Color::get()->map(function($c) use ($colorMap) {
            $name = strtolower(trim($c->color_name));
            $c->hex = $colorMap[$name] ?? '#000000'; // fallback if not found
            return $c;
        });
    
        $data = [
            'title' => 'All Color Show',
            'date'  => date('m-d-Y'),
            'color' => $getRecord,
        ];
    
        $pdf = PDF::loadView('pdf.PDFColor', $data);
        return $pdf->download('color.pdf');
    }
    

}
