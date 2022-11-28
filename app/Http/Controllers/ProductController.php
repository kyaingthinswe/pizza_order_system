<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function list(){
        //table join => innerjoin,leftjoin,rightjoin
        //now use table relationship => belongsTo
//        $products = Product::select('products.*','categories.name as category_name')
//                        ->leftjoin('categories','products.category_id','categories.id')
//                        ->when(request('searchKey'),function ($query){
//                            $key = request('searchKey');
//                            $query->orwhere("products.name","like","%$key%")->orwhere("products.description","like","%$key%");
//                        })->orderBy('id','desc')->paginate(3);


        $products = Product::when(request('searchKey'),function ($query){
                        $key = request('searchKey');
                        $query->orwhere("products.name","like","%$key%")->orwhere("products.description","like","%$key%");
                    })->orderBy('id','desc')->paginate(3);
        $products->appends(request()->all());
        return view('admin.product.list',compact('products'));

        return view('admin.product.list',compact('products'));
    }
    public function create(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            "productName" => 'required|unique:products,name',
            "categoryId" => 'required',
            "productDescription" => 'required|',
            "productPrice" => 'required|integer',
            "waitingTime" => 'required|integer',
            'productImage' => 'required|mimes:jpg,png|file',
        ]);
//        dd($request->all());
        $product = new Product();
        $product->name = $request->productName;
        $product->category_id = $request->categoryId;
        $product->description = $request->productDescription;
        $product->price = $request->productPrice;
        $product->waiting_time = $request->waitingTime;
        if ($request->hasFile('productImage')){
            $dir = 'public/product/';
            $file = $request->file('productImage');
            $newName = uniqid().'_product.'.$file->getClientOriginalExtension();
            $file->storeAs($dir,$newName); //store in storage
            $product->image = $newName;
        }
        $product->save();
        return redirect()->route('product_list')->with('status','Product create successfully ....');
    }
    public function detail($id){
        $product = Product::where('id',$id)->first();
//        dd($product);
        return view('admin.product.detail',compact('product'));
    }
    public function edit($id){
        $product = Product::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.product.update',compact('product','categories'));
    }
    public function update(Request $request){
//        dd($request->all());
        $request->validate([
           'productName'  => 'required|unique:products,name,'.$request->productId,
            'productDescription' => 'required|min:10',
            'productImage' => 'file|mimes:jpg,png',
            'productPrice' => 'required|integer',
            'waitingTime' => 'required|integer',
        ]);
//        dd($request);
        $updateData = [
            'name' => $request->productName,
            'description' =>  $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->waitingTime,
        ];
        if ($request->hasFile('productImage')){
            $dir = 'public/product/';
            $file = $request->file('productImage');
            $oldImage = Product::where('id',$request->productId)->pluck('image')->first();
//            dd($oldImage);
            Storage::delete($dir.$oldImage);
            $newName = uniqid().'_product.'.$file->getClientOriginalExtension();
            $file->storeAs($dir,$newName);
            $updateData['image'] = $newName;
        }
        Product::where('id',$request->productId)->update($updateData);
        return redirect()->route('product_list')->with('status','Product is updated ...');
    }
    public function delete($id){
        $product = Product::find($id);
        Storage::delete('public/product/'.$product->image);
//        dd($product);
        $product->delete();
        return redirect()->route('product_list')->with('status','Product is deleted');
    }
}
