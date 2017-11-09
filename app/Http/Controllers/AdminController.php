<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Crypt;
use App\User;
use App\Http\Controllers\Controller;

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

    function drawNames(){
        $query = DB::select("SELECT Name FROM presents");
        $i = 0;
        $y = 1;

        foreach ($query as $info){
           $nameArray[$i] = $info->Name;
           $drawnArray[$y] = $info->Name;
           $i++;
           $y++;
        }

        $temp = $drawnArray[sizeof($drawnArray)];
        array_unshift($drawnArray, $temp);
        array_pop($drawnArray);

        $iterations = rand(10000, 50000);

        for($i=0; $i<$iterations; $i++){
            $temp1 = rand(0, sizeof($drawnArray)-1);
            $temp2 = rand(0, sizeof($drawnArray)-1);

            while($temp2 == $temp1) $temp2 = rand(0, sizeof($drawnArray)-1);

            if($drawnArray[$temp1] != $nameArray[$temp2] && $drawnArray[$temp2] != $nameArray[$temp1]){
                $tempx = $drawnArray[$temp1];
                $tempy = $drawnArray[$temp2];
                $drawnArray[$temp1] = $tempy;
                $drawnArray[$temp2] = $tempx;
            }
        }

        for($i=0; $i<sizeof($nameArray); $i++) {
            $encryptedName = Crypt::encrypt($drawnArray[$i]);
            //print_r($encryptedName);
            DB::table('presents')->where('Name', $nameArray[$i])->update(["DrawnName" => $encryptedName]);
        }

        return redirect("adminPanel");
    }
}
