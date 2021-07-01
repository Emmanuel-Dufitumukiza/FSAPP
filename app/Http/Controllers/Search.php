<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use MongoDB\BSON\Regex;

class Search extends Controller
{
    public function SearchPeople(Request $request){
       $request->searchKey = trim($request->searchKey);
       $results = Users::where('username', 'regex', new Regex($request->searchKey, 'i'))->get();

       return response()->json(["results"=>$results]);
    }
}
