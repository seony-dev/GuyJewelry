<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/notice', function () {
    return view('notice');
});

Route::get('/lookbook', function () {
    return view('lookbook');
});

Route::get('/guynews', function () {
    return view('guynews');
});


Route::get('/contact', function () {
    return view('contact');
});


//부가 api (insert, update, delete)
Route::get('/notice_write', function () {
    return view('notice_form');
});

//DB 확인 -> 성공
Route::get('/db_check', function () {
    $user = DB::connection('mysql')->table('Members')->get();
    return $user;
});
