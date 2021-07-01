<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function ajaxRequest()
    {
        return view('App.message');
    }


    /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequestStore(Request $request)
    {
        return response()->json(['error'=>$request->email]);
    }
}
