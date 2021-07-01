<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Users;
use Illuminate\Contracts\Session\Session;

class UploadProfile extends Controller
{
    public function UploadProfile(Request $request){
        $userId = Session("userId");
        $validateImage = validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(!$validateImage->passes()){
        return response()->json(["error"=>$validateImage->errors()->all()]);
        }
        $imageName = $request->image->getClientOriginalName();

        $file_path = public_path('uploads/' . $imageName);

        while(file_exists($file_path)){
        $imageName.= "fsapp.".$request->image->extension();
        $file_path = public_path('uploads/' . $imageName);
        }

        if(!file_exists($file_path)){
            $uploaded = $request->image->move(public_path('uploads'), $imageName);
            if($uploaded){
            $info = Users::find($userId);
            $prevImage = $info->profile_pic;
            $info->profile_pic = "/uploads/".$imageName;
            $info->update();
            if($prevImage != "/images/user.png"){
            unlink(public_path($prevImage));
            }
            return response()->json(["uploaded"=>true]);
            }
        }else{
            return response()->json(["error"=>"Image failed to be uploaded, please try to rename your image","exists"=>true]);
        }
    }

    public function GetProfile(){

       $userId = Session("userId");
       $info = Users::where(["_id"=>$userId])->first();

       if($info){
           return response()->json(["info"=>$info]);
       }
    }

    public function DeleteProfile(){
        $userId = Session("userId");
        $info = Users::find($userId);
        $prevImage = $info->profile_pic;
        $info->profile_pic = "/images/user.png";
        $updated = $info->update();

        if($updated && $prevImage!="/images/user.png"){
            unlink(public_path($prevImage));
        }
    }
}
