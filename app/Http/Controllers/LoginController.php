<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class LoginController extends Controller
{
    function showLogin(){
        return view('login');
    }

    function doLogin(){
        $loginCode = $_POST['loginCode'];
        $query = DB::select("SELECT * FROM presents WHERE Login = '".$loginCode."'");

        if(isset($query[0])){
            try{
                $drawnName = Crypt::decrypt($query[0]->DrawnName);
            } catch(DecryptException $e){
                echo "error: ".$e." PLEASE CONTACT THE SERVER ADMIN";
            }

            return view('reveal',['name'=>$drawnName]);
        }
        else{
            return redirect("login");
        }
    }
}
