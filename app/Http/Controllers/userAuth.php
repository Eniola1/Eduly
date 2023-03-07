<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

class userAuth extends Controller
{
    public function register(Request $req)
    {   
        $username = $req->name;
        $password = md5($req->password);
        $email = $req->email;
        $contact = $req->contact;

        $user = new Users;   
        $user->name = $username;
        $user->password = $password;
        $user->email = $email;
        $user->contact = $contact;

        $user->save();

        return view("auth.login");
    }

    public function login(Request $req)
    {   
        $email = $req->email;
        $password = md5($req->password);
        $excptDV = 'Incorrect Login details';
        
        $user = Users::where('email', $email)->where('password', $password)->count();

        if($user > 0)
        {
            return view("auth.welcome");
        }

        else
        {
            return view("auth.login", compact("excptDV"));
        }
    }
}
