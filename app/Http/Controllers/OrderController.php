<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_list(Request $request)
    {
       return view('admin.order.list');
    }

    public function order_add(Request $request)
    {
        $data['getProduct'] = Product::get();
        $data['getColor'] = Color::get();
        return view('admin.order.add', $data);
    }

    public function order_insert(Request $request)
    {
        dd($request->all());
    }
}
