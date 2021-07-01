<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function Home(){
        $username = session()->get("username");

        return view("App.Home")->with(["username"=>$username]);
    }

    public function Upload(Request $request){
        response()->json("Request recieved");
}

public function Profile(){
    $username = session()->get("username");
    return view("App.profile")->with(["username"=>$username]);;
}
}
