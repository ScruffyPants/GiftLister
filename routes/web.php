<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('present/{tag}','PresentController@draw');

Route::get('login', array('uses' => 'LoginController@showLogin'));

Route::post('login', array('uses' => 'LoginController@doLogin'));

Route::get('adminLogin', array('uses' => 'adminController@showLogin'));

Route::post('adminLogin', array('uses' => 'adminController@doLogin'));

Route::get('adminPanel', array('uses' => 'adminController@showPanel'));

Route::get('adminPanel/deleteUser/{ID}', 'adminController@deleteUser');

Route::post('addUser', array('uses' => 'adminController@addUser'));

Route::get('adminPanel/giveLogins', 'adminController@giveLogins');

Route::get('/adminPanel/drawNames', 'adminController@drawNames');