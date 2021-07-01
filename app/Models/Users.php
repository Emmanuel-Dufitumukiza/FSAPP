<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $collection = "users";
    protected $fillable = [
      "username", "email", "password", "added","profile_pic"
    ];
}
