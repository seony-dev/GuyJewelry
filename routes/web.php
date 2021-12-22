<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\LookbookController;
use App\Http\Controllers\AdminController;

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

//DB 확인 -> 성공
Route::get('/db_check', function () {
    $user = DB::connection('mysql')->table('Members')->get();
    return $user;
});


////////////////////////////////////////////////////////////////////////////////////////////


//Route::get('/', function () {
//    return view('index');
//});

/*********** View Page ***********/

//Main
Route::get('/', [MainController::class, 'index']);
Route::get('/index', [MainController::class, 'index']);

//Login ( 로그인 )
Route::get('/login', [LoginController::class, 'login_index']);

//Notice ( 공지사항 )
Route::get('/notice', [NoticeController::class, 'notice_index']);
Route::match(array('GET','POST'), '/notice_detail', [NoticeController::class, 'notice_detail']);

//Notice 작성 및 수정 폼
Route::match(array('GET','POST'), '/notice_write', [NoticeController::class, 'notice_form']);

Route::post('/notice_update', [NoticeController::class, 'notice_form']);

//lookbook ( 룩북 )
Route::get('/lookbook', [LookbookController::class, 'lookbook_index']);

//guy news ( 가이뉴스 )
Route::get('/guy_news', function () {
    return view('guy_news');
});

//Contact ( 간편상담 및 가이주얼리 위치 / 안내 )
Route::get('/contact', function () {
    return view('contact');
});



/*********** 부가 api (insert, update, delete) ***********/

//로그인 api
Route::post('/login_action', [LoginController::class, 'login_action']);

//로그아웃 api
Route::get('/logout_action', [LoginController::class, 'logout_action']);




//공지사항 작성 api
Route::post('/notice/write_action', [NoticeController::class, 'notice_write_action']);

//공지사항 에디터 이미지 저장 api
Route::post('/notice/save_editor_images', [NoticeController::class, 'save_editor_images']);

//공지사항 조회수 증가 api
Route::post('/notice/add_views', [NoticeController::class, 'notice_add_views']);


//공지사항 삭제 api
Route::post('notice/delete_action', [NoticeController::class, 'notice_delete_action']);

//공지사항 수정 api
Route::post('notice/update_action', [NoticeController::class, 'notice_update_action']);

//공지사항 파일 다운로드 api
Route::post('notice/download_file', [NoticeController::class, 'notice_download_file']);



//////////////////////////////////////////////////////////////////////////admin

Route::get('/admin', [AdminController::class, 'login']);
Route::post('/admin_login_action', [AdminController::class, 'login_action']);
Route::post('/admin_logout_action', [AdminController::class, 'logout_action']);

Route::get('/admin_index', [AdminController::class, 'admin_index']);
