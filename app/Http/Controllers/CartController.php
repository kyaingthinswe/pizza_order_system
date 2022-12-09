<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
