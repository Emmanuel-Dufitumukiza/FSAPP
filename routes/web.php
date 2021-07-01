<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthRegister;
use App\Http\Controllers\ChatWith;
use App\Http\Controllers\Home;
use App\Http\Controllers\Search;
use App\Http\Controllers\UploadProfile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['AuthCheck']], function(){
Route::get('/', [AuthRegister::class, "Auth"]);
Route::get('/register', [AuthRegister::class, "Register"]);
Route::get('/dash', [Home::class, "Home"])->name("dash");
Route::get('/logout', [AuthRegister::class, "Logout"]);
Route::get('/profile', [Home::class, "Profile"]);
Route::get("/get-profile", [UploadProfile::class, "GetProfile"]);
Route::get("/delete-profile", [UploadProfile::class, "DeleteProfile"]);
Route::get("/chat", [ChatWith::class, "ChatWith"]);
Route::get("/get-clicked-info/{id}", [ChatWith::class, "GetInfo"]);
});

Route::get('/forgot', [AuthRegister::class, "Forgot"]);
Route::get("/upload",[Home::class, "Upload"])->name("upload");
Route::post("register/user", [AuthRegister::class, "RegisterUser"])->name("register.user");
Route::post("auth/user", [AuthRegister::class, "Authenticate"])->name("auth.user");
Route::post("profile-upload", [UploadProfile::class, "UploadProfile"]);
Route::post("/search", [Search::class, "SearchPeople"]);
Route::post("/sent-msg", [ChatWith::class, "SentMessage"]);
