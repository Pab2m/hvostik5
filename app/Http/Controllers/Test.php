<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role; use App\User; USE App\Permission;

class Test extends Controller
{
    public function roleTest(){
          $user = User::find(15);
          dd($user->hasRole('admin'));


    }
}
