<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiRouteController extends Controller
{
    public function list(){
        $product = Product::get();
        $category = Category::get();
        $contact = Contact::get();
        $data = [
            'product' => $product,
            'category' => $category,
            'contact' => $contact,
        ];
        return response()->json($data,200);
    }
    public function categoryCreate(Request $request){
//        dd($request->all());
        $category = Category::create([
            'name' => $request->name,
        ]);
        return response()->json($category,200);

    }
    public function categoryList(){
        $category = Category::orderBy('id','desc')->get();
        $data = [
            'category' => $category,
        ];
//        return response()->json($data['category'][0]->name,200);
        return response()->json($data,200);
    }
//    public function categoryDelete($id){
//        $category_id = Category::where('id',$id)->pluck('id')->first();
//        if (isset($category_id)){
//            Category::where('id',$id)->delete();
//            return response()->json([
//                'message' => 'delete success',
//                'status' => 200,
//            ],200);
//        }
//
//    }
    public function categoryDelete(Request $request){
        $category_id = Category::where('id',$request->id)->pluck('id')->first();
        if (isset($category_id)){
            Category::where('id',$request->id)->delete();
            return response()->json([
                'message' => 'delete success',
                'status' => 200,
            ],200);
        }

    }
    public function categoryUpdate(Request $request,$id){
//        return $request;
        $category = Category::where('id',$id)->update([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => "update successfully",
            'status' => 200,
            'category' => $category,
        ],200);

    }

}
