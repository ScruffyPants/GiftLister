<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function showLogin(){
        return view('login');
    }

    function doLogin(){
        echo($_POST['loginCode']);
    }
}
