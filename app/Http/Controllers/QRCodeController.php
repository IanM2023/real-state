<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    
    public function list(Request $request)
    {
        $data['getRecord'] = Product::latest()->get(); // orders by created_at desc
        return view('admin.qrcode.list', $data);
    }

    public function add_qrcode(Request $request)
    {
        return view('admin.qrcode.add');
    }

    public function store_qrcode(Request $request)
    {
        $number = mt_rand(1111111111, 9999999999);
        $product = new Product();
        $product->title = trim($request->title);
        $product->price = trim($request->price);
        $product->product_code = $number;
        $product->description = trim($request->description);
        $product->save();

        return redirect('admin/qrcode')->with('success', 'QRCode successfully');
    }

    public function edit_qrcode($id)
    {
        $data['getRecord'] = Product::findorFail($id);
        return view('admin.qrcode.edit', $data);
    }

    public function update_qrcode(Request $request, $id)
    {
        $number = mt_rand(1111111111, 9999999999);
        $product = Product::findOrFail($id);
        $product->title = trim($request->title);
        $product->price = trim($request->price);
        $product->product_code = $number;
        $product->description = trim($request->description);
        $product->save();
    
        return redirect('admin/qrcode')->with('success', 'QRCode updated successfully');
    }

    public function delete_qrcode($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('admin/qrcode')->with('success', 'QRCode deleted Successfully');
    }
    
}
