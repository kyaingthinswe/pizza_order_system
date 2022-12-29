<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        $categories = Category::get();
        $products  = Product::get();
        $carts = Cart::where('user_id',Auth::id())->get();
        $orders = Order::where('user_id',Auth::id())->paginate(3);

//        dd(count($carts));
        return view('user.home',compact(['categories','products','carts','orders']));
    }
    //sorting ascending & descending
    public function sorting(Request $request){
        logger($request->all());
        if ($request->status == 'desc'){
            $products = Product::orderBy('id','desc')->get();
        }else{
            $products = Product::get();
        }
//        return $products;
        return response()->json($products,200);
    }
    //category select
    public function filterCategory($id){

        $products = Product::where('category_id',$id)->orderBy('id','desc')->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::id())->get();
        $orders = Order::where('user_id',Auth::id())->paginate(3);

//        return view('user.home',compact(['products','categories']));
        return view('user.home',compact('products','categories','carts','orders'));
    }
    //product detail
    public function detail($id){
        $product = Product::where('id',$id)->first();
        $products = Product::get();
        return view('user.detail',compact('product','products'));
    }
    //increase view count
    public function viewCount(Request $request){
        logger($request->all());
        $product = Product::where('id',$request->productId)->first();
        Product::where('id',$request->productId)->update([
           'view_count' => $product->view_count +1
        ]);
        return redirect()->back();
    }

}
