<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function orders(){
        $orders = Order::where('status',0)->get();
        //echo $orders; die;
        return view('admin.orders.orders',compact('orders'));
    }

    public function viewOrders($id){
        $orders = Order::where('id',$id)->first();
        return view('admin.orders.view-orders',compact('orders'));
    }

    public function updateOrders(Request $request,$id){
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();
        return redirect('admin/orders')->with('success','Order is updated successfully');
    }

    public function orderHistory(){
        $orders = Order::where('status',1)->get();
        //echo $orders; die;
        return view('admin.orders.orders-history',compact('orders'));
    }
}
