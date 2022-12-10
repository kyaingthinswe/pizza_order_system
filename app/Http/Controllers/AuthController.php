<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function login(){
        return view('loginPage');
    }
    public function register(){
        return view('registerPage');
    }
    public function dashboard(){
        if(auth()->user()->role == 'user'){
            return redirect()->route('user_home');
        }else{
            return redirect()->route('profile',auth()->id());
        }
    }

    //password change
    public function passwordChange(){
        return view('admin.account.passwordChange');
    }
    public function passwordUpdate(Request $request){
//        $request->validate([
//            "oldPassword"=> "required|min:4",
//            "newPassword"=> "required|min:4",
//            "confirmPassword"=> "required|min:4|same:newPassword",
//        ]);
        $this->validatePasswordUpdate($request);
        $hashPassword = User::where('id',Auth::user()->id)->pluck('password')->first();
//        return $hashPassword;
//        password_verify() == Hash::check()
        if (Hash::check($request->oldPassword,$hashPassword)){

            $data = [
                'password' => Hash::make($request->newPassword),
            ];

            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('loginPage');
        }

        return redirect()->back()->with('status','The old password not match. Try Again!');
    }
    //profile change
    public function profile($id){
        $user = User::where('id',$id)->first();
    //    dd($user->toArray());
        return view('admin.account.profile',compact('user'));
    }
    public function profileChange($id){
        $user = User::where('id',$id)->first();
//        dd($user);
        return view('admin.account.profileChange',$user);
    }
    // public function profileChange(){
    //     return view('admin.account.profileChange');
    // }
    public function profileUpdate(Request $request,$id){
//        dd($id,$request->all());
        $this->validateProfileUpdate($request);
        $data = [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'phone' => $request->userPhone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
        //file store
        if($request->hasFile('userProfile')){

            $dir = 'public/profile/';
            $file = $request->file('userProfile');

            $dbProfile = User::where('id',$id)->pluck('profile')->first();
//            dd($dbProfile);
            if($dbProfile != 'default_profile.png'){
                Storage::delete('$dir'.$dbProfile);
            }

            $newName = uniqid().'_profile.'.$file->getClientOriginalExtension();
            $file->storeAs($dir,$newName); //store in storage
            $data['profile'] = $newName; // store in database
        }
        User::where('id',$id)->update($data);
        return redirect()->route('profile',Auth::id())->with('status','Profile is updated ...');

    }
    //Account List
    public function accountList(){
        $users = User::when(\request('searchKey'),function ($q){
            $key = \request('searchKey');
            $q->where("name","like","%$key%");
        })->paginate(3);
        $users->appends(\request()->all());
        return view('admin.account.accountList',compact('users'));
    }
    //Account Change Role
    public function accountChangeRole(Request $request,$id){
        User::where('id',$id)->update([
            'role' => 'admin',
        ]);
        return redirect()->back()->with('status','Admin change success...');


    }
    //Account Delete
    public function accountDelete($id){
        $user = User::find($id);
//        dd($user);
        if ($user->profile != 'default_profile.png'){
            Storage::delete('public/profile/.$user->profile');
        }
        $user->delete();
        return redirect()->route('account_list')->with('status','Account is deleted');

    }

    //private
    private function validatePasswordUpdate($request){
        Validator::make($request->all(),[
            "oldPassword"=> "required|min:4",
            "newPassword"=> "required|min:4",
            "confirmPassword"=> "required|min:4|same:newPassword"
        ])->validate();
    }
    private function validateProfileUpdate($request){
        Validator::make($request->all(),[
            "userName" => " required",
            "userEmail" => "required|unique:users,email,".Auth::user()->id,
            "userPhone" => "required | max:15",
            "address" => "required",
            "gender" => "required",
            "userProfile" => "mimes:jpg,png|file",
        ]);
    }
}
