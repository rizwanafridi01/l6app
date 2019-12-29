<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {


        $users = User::with('profile.country:id,name')->get();

//        dd($users);
       return view('welcome',compact('users'));

    }
}
