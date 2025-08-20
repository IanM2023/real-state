<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_list(Request $request)
    {
        $search = $request->get('search'); // or just: request('search')
        $startDate = $request->get('start_date'); // or just: request('search')
        $endDate = $request->get('end_date'); // or just: request('search')
        $data['getRecordOrder'] = Order::getRecord($search, $startDate, $endDate);
        return view('admin.order.list' , $data);
    }

    public function order_add(Request $request)
    {
        $data['getProduct'] = Product::get();
        $data['getColor'] = Color::get();
        return view('admin.order.add', $data);
    }

    public function order_insert(Request $request)
    {
        $save = new Order;
        $save->product_id = trim($request->product_id);
        $save->qty = trim($request->qty);
        $save->save();

        if(!empty($request->color_id))
        {
            foreach($request->color_id as $color_id) {
                $order = new OrderDetail;
                $order->order_id = $save->id;
                $order->color_id = $color_id;
                $order->save();
            }
        }

        return redirect('admin/order')->with('success', 'Order successfully created');
    }

    public function order_edit($id)
    {
        $data['getRecord'] = Order::findOrFail($id);
        $data['getProduct'] = Product::get();
        $data['getColor'] = Color::get();
        $data['getOrderDetail'] = OrderDetail::where('order_id', '=', $id)->get();

        return view('admin.order.edit', $data);
    }

    public function order_update(Request $request, $id)
    {
        $save = Order::findOrFail($id);
        $save->product_id = trim($request->product_id);
        $save->qty = trim($request->qty);
        $save->save();

        OrderDetail::where('order_id', '=', $save->id)->delete();

        if(!empty($request->color_id))
        {
            foreach($request->color_id as $color_id) {
                $order = new OrderDetail;
                $order->order_id = $save->id;
                $order->color_id = $color_id;
                $order->save();
            }
        }

        return redirect('admin/order')->with('success', 'Order successfully updated');
    }

    public function order_delete($id)
    {
        $deleteRecord = Order::findOrFail($id);
        $deleteRecord->delete();

        OrderDetail::where('order_id', '=', $id)->delete();

        return redirect('admin/order')->with('success', 'Record Successfully deleted');
    }
}
