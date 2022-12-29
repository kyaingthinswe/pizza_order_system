<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\length;

class CartController extends Controller
{
    public function addToCart(Request $request){
        logger($request->all());
        $data = [
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'qty' => $request->productItem,
        ];
        Cart::create($data);
        $response = [
            'status' => 200,
            'message' => 'add to card is completed...',
        ];
//        return response($response,200);
        return response()->json($response,200);
    }


    public function cartList(){
        $carts = Cart::where('user_id',Auth::id())->get();
        $total = 0;
        foreach ($carts as $c){
//            dd(var_dump($c->product->price) - var_dump($c->qty));
//            dd(var_dump($c->product->price*$c->qty));
            $total += $c->product->price*$c->qty;
//            dd(var_dump($total));
        }
        return view('user.cart',compact('carts','total'));
    }

    //Cart Row Remove
    public function cartRowRemove(Request $request){
        logger($request->all());
//        logger(Cart::first());
        Cart::where('user_id',Auth::id())->where('id',$request->cart_id)->delete();


    }
    public function cartRowsRemove(Request $request){
//        logger($request->all());
        Cart::where('user_id',Auth::id())->delete();
    }

    public function orderList(Request $request){
//        logger($request->all());
        $total = 0;
        foreach ($request->all() as $item){
//            logger($item);
            $data = OrderList::create($item);
            $total += $data->total;
        }
//        logger($data->product_id);
        Cart::where('user_id',Auth::id())->delete();
        Order::create([
           'user_id' =>  Auth::id(),
            'order_code' => $data->order_code,
            'total_price' => $total +3000,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'order list success',
        ],200);
    }
    public function order(){
        $orders = Order::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(3);
        // dd($orders->toArray());
        return view('user.order',compact('orders'));
    }
}
