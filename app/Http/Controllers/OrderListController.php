<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{

    public function orderDetail($order_code){
//        dd($order_code);
        $total = Order::where('order_code',$order_code)->pluck('total_price')->first();
//        dd($total);
        $data = OrderList::where('order_code',$order_code)->get();
        return view('admin.order.detail',compact('data','total'));
    }
}
