<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $categories = Category::when(isset(request()->searchKey),function ($q){
            $key = request()->searchKey;
            $q->where("name","like","%$key%");
        })->orderBy('id','desc')->paginate(4);
//        dd($categories);
        return view('admin.category.list',compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }
//    public function store(Request $request){
//        $request->validate([
//            'categoryName' => 'required|unique:categories,name',
//        ]);
//        $category = new Category();
//        $category->name = $request->categoryName;
//        $category->save();
//        return redirect()->route('category_list');
//    }
    public function store(Request $request){
        Validator::make($request->all(),[
           'categoryName' => 'required|unique:categories,name',
        ])->validate();
        $data = $this->categoryData($request);
        Category::create($data);
        return redirect()->route('category_list')->with('status','Create Successfully...');
    }
    public function edit($id){
//        dd($id);
        $category = Category::where('id',$id)->first();
//        dd($category);
        return view('admin.category.update',compact('category'));
    }
    public function update(Request $request){
//        return $request;
        $request->validate([
            'categoryName'=> 'required|unique:categories,name,'.$request->id,
        ]);
//        dd($request->toArray());
        $data = $this->categoryData($request);
        Category::where('id',$request->id)->update($data);
        return redirect()->route('category_list')->with('status','Update Successfully ...');
    }
    public function delete($id){
//        dd($id);
        Category::where('id',$id)->delete();
        return redirect()->back()->with('status','Category Deleted ...');
    }

    //private
    private function categoryData($request){
        return [
            'name' => $request->categoryName,
        ];
    }
}
