<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    function showLogin(){
        return view("adminLogin");
    }

    function doLogin(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $infoArray = DB::select("SELECT * FROM admin WHERE Username = '".$username."' AND Password = '".$password."'");

        if(isset($infoArray[0])){
            session(['Admin' => true]);
            return redirect("adminPanel");
        }
        else
            return redirect("adminLogin");
    }

    function showPanel(){
        if(session("Admin")){
            $infoArray = DB::select("SELECT * FROM presents");
            return view("adminPanel", ["infoArray" => $infoArray]);
        }
        else{
            echo "You are not authorized";
        }
    }

    function deleteUser($ID){
        if(session("Admin")){
            DB::table('presents')->where('ID','=',$ID)->delete();
            return redirect("adminPanel");
        }
    }

    function addUser(){
        $name = $_POST['name'];
        $drawnname = isset($_POST['drawnname']) ? $_POST['drawnname'] : "";
        $login = isset($_POST['login']) ? $_POST['login'] : "";

        DB::table('presents')->insert(['Name' => $name, "DrawnName" => $drawnname, "Login" => $login]);
        return redirect("adminPanel");
    }

    function giveLogins(){
        $infoArray = DB::select("SELECT * FROM presents WHERE Login = ''");

        foreach($infoArray as $info){
            $newLogin = $this -> generateLogin($info->ID, $info->Name);
            DB::table('presents')->where('id',$info->ID)->update(["Login"=>$newLogin]);
        }

        return redirect("adminPanel");
    }

    function generateLogin($ID, $name){
        $newLogin = substr($name, 0, 2);
        $newLogin .= $ID;
        $newLogin .= rand(10,999);
        return $newLogin;
    }
}
