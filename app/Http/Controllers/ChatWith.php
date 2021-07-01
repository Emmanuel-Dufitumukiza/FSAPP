<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class ChatWith extends Controller
{
  public function ChatWith(){
    $username = session()->get("username");

    return view("App.upload")->with(["username"=>$username]);
  }

  public function GetInfo($id){

    $info = Users::where(["_id"=>$id])->first();

    if($info){
        return response()->json(["info"=>$info]);
    }else{
        return response()->json(["error"=>true]);
    }
  }

  public function SentMessage(Request $request){
    $fileName = $request->file->getClientOriginalName();
    $uploaded = $request->file->move(public_path('uploaded_files'), $fileName);

    if($uploaded){
        return response()->json(["status"=>"File uploaded succesfully"]);
    }
  }
}
