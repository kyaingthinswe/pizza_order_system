<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->route('category_list');
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
        if (password_verify($request->oldPassword,$hashPassword)){
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
    public function profile(){
        return view('admin.account.profile');
    }
    public function profileChange(){
        return view('admin.account.profileChange');
    }


    //private
    private function validatePasswordUpdate($request){
        Validator::make($request->all(),[
            "oldPassword"=> "required|min:4",
            "newPassword"=> "required|min:4",
            "confirmPassword"=> "required|min:4|same:newPassword"
        ])->validate();
    }
}
