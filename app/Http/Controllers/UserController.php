<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(){
        return view('user.account.profile');
    }
    public function profileChange(){
        return view('user.account.profileChange');
    }
    public function profileUpdate(Request $request,$id ){
        Validator::make($request->all(),[
            "userName" => " required",
            "userEmail" => "required|unique:users,email,".Auth::user()->id,
            "userPhone" => "required | max:15",
            "address" => "required",
            "gender" => "required",
            "userProfile" => "mimes:jpg,png|file",
        ]);
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

            $dbProfile = User::where('id',Auth::id())->pluck('profile')->first();
//            dd($dbProfile);
            if($dbProfile != 'default_profile.png'){
                Storage::delete('$dir'.$dbProfile); // နောက်မှ လုပ်ရန် ............................
            }

            $newName = uniqid().'_profile.'.$file->getClientOriginalExtension();
            $file->storeAs($dir,$newName); //store in storage
            $data['profile'] = $newName; // store in database
        }
//        dd($data);
        User::where('id',Auth::id())->update($data);
        return redirect()->route('user_profile',Auth::id())->with('status','Profile is updated ...');
    }
    public function passwordChange(){
        return view('user.account.passwordChange');
    }
    public function passwordUpdate(Request $request){
        $request->validate([
            "oldPassword"=> "required|min:4",
            "newPassword"=> "required|min:4",
            "confirmPassword"=> "required|min:4|same:newPassword",
        ]);
//        dd($request);
        $hashPassword = User::where('id',Auth::id())->pluck('password')->first();
//        return $hashPassword;
//        password_verify() == Hash::check()
        if (password_verify($request->oldPassword,$hashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',Auth::id())->update($data);
            Auth::logout();
            return redirect()->route('loginPage');
        }

        return redirect()->back()->with('status','The old password not match. Try Again!');
    }
}
