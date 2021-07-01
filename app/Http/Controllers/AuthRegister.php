<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthRegister extends Controller
{
    public function Register(){
        return view("Auth-Register.register");
    }

    public function Auth(){
        return view("Auth-Register.login");
    }

    public function Logout(){
        if(session()->has("userId")){
            session()->pull("userId");
            return redirect("/");
        }else{
            return redirect("/");
        }
    }

    public function Forgot(){
        return view("Auth-Register.forgot");
    }

   public function RegisterUser(Request $request){

    $validateData = Validator::make($request->all(),[
        "email"=>"required|unique:users|max:120",
        "username"=>"required|min:3|max:40",
        "password"=>"required|min:6|max:25"
    ]);

    if(!$validateData->passes()){ 
        return response()->json(['error'=>$validateData->errors()->all()]);
    }else{

        $insertUser = new Users([
            "username"=>trim($request->get('username')),
            "email"=>trim($request->get('email')),
            "password"=>Hash::make($request->get('password')),
            "added"=>$request->get("added"),
            "profile_pic"=>"/images/user.png"
        ]);

        try{
            $insertUser->save();
            return response()->json(['success'=>$insertUser->save()]);
        }catch(Exception $e){
            return response()->json(['error'=>$e]);
        }

    }
   }

   //authentication

   public function Authenticate(Request $request){

         $validateData =  validator::make($request->all(), [
              "email"=>"required",
              "password"=>"required"
          ]);

          if($validateData->passes()){
            $users = Users::where(["email"=>$request->email])->first();

            if(empty($users)){
                return response()->json(["error"=>"Incorrect email or password"]);
            }else
            $dbPass = $users->password;
            $passMatch = Hash::check($request->password, $dbPass);

            if($passMatch){
                session(["userId"=>$users->_id,"username"=>$users->username]);
                return response()->json(["success"=>true]);
            }else{
                return response()->json(["error"=>"Incorrect email or password"]);
            }

          }else{
              return back();
          }

   }
}
