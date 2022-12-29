<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(){
        $orders = Order::orderBy('created_at','desc')->get();
//        dd($orders);
        return view('admin.order.list',compact('orders'));
    }
    public function statusChange(Request $request){
        logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'status change success',
            'status' => 200,
        ],200);
    }
    public function statusList(Request $request){
//        dd($request->all());
//        $orders = Order::select('orders.*','users.name as user_name')
//                    ->leftJoin('users','users.id','orders.user_id')
//                    ->orderBy('created_at','desc');
//                    ->where('status',$request->status)->get();

        $orders = Order::orderBy('created_at','desc');
        if($request->orderStatus == null){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('orders'));

    }
}
