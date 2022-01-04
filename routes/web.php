<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\LookbookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GuyNewsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLookbookController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminShopController;

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

/* Main */
Route::get('/', [MainController::class, 'index']);
Route::get('/index', [MainController::class, 'index']);


/* Login ( 로그인 ) */
Route::get('/login', [LoginController::class, 'login_index']);


/* Notice ( 공지사항 ) */
Route::get('/notice', [NoticeController::class, 'notice_index']);
Route::match(array('GET','POST'), '/notice_detail', [NoticeController::class, 'notice_detail']);

//Notice 작성 및 수정 폼 + api
Route::match(array('GET','POST'), '/notice_write', [NoticeController::class, 'notice_form']);
Route::post('/notice_update', [NoticeController::class, 'notice_form']);


/* lookbook ( 룩북 ) */
Route::get('/lookbook', [LookbookController::class, 'lookbook_index']);
Route::post('/lookbook/category', [LookbookController::class, 'lookbook_category']);
Route::match(array('GET','POST'), '/lookbook/content', [LookbookController::class, 'lookbook_content']);


/* Guy news ( 가이뉴스 ) */
Route::get('/guy_news', [GuyNewsController::class, 'guy_news_index']);
Route::match(array('GET','POST'), '/guy_news_detail', [GuyNewsController::class, 'guy_news_detail']);

//Guy news 작성 및 수정 폼
Route::match(array('GET','POST'), '/guy_news_write', [GuyNewsController::class, 'guy_news_form']);
Route::post('/guy_news_update', [GuyNewsController::class, 'guy_news_form']);



/* Contact ( 간편상담 및 가이주얼리 위치 / 안내 ) */
Route::get('/contact', [ContactController::class, 'contact_index']);

// 간편상담 신청
Route::post('/contact/inquiry_write_action', [ContactController::class, 'inquiry_write_action']);


/* Shop ( 샵 ) */
Route::get('/shop', [ShopController::class, 'shop_index']);
Route::post('/shop/sub_category_list', [ShopController::class, 'sub_category_list']);


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
Route::post('/notice/delete_action', [NoticeController::class, 'notice_delete_action']);

//공지사항 수정 api
Route::post('/notice/update_action', [NoticeController::class, 'notice_update_action']);

//공지사항 파일 다운로드 api
Route::post('/notice/download_file', [NoticeController::class, 'notice_download_file']);




//가이뉴스 작성 api
Route::post('/guy_news/write_action', [GuyNewsController::class, 'guy_news_write_action']);

//가이뉴스 에디터 이미지 저장 api
Route::post('/guy_news/save_editor_images', [GuyNewsController::class, 'save_editor_images']);

//가이뉴스 조회수 증가 api
Route::post('/guy_news/add_views', [GuyNewsController::class, 'guy_news_add_views']);


//가이뉴스 삭제 api
Route::post('/guy_news/delete_action', [GuyNewsController::class, 'guy_news_delete_action']);

//가이뉴스 수정 api
Route::post('/guy_news/update_action', [GuyNewsController::class, 'guy_news_update_action']);

//가이뉴스 파일 다운로드 api
Route::post('/guy_news/download_file', [GuyNewsController::class, 'guy_news_download_file']);



//////////////////////////////////////////////////////////////////////////admin

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login_action', [AdminController::class, 'login_action']);
Route::get('/admin/logout_action', [AdminController::class, 'logout_action']);

//관리자 대시보드(메인)
Route::get('/admin/index', [AdminController::class, 'admin_index']);

Route::post('/admin/new_alarm_check_action', [AdminController::class, 'new_alarm_check_action']);


/************** 설정 관리 *******************/

/* 관리자 > 설정 > 관리자 목록 */
Route::get('/admin/setting/admin_list', [AdminSettingController::class, 'admin_list']);
Route::post('/admin/setting/admin_info', [AdminSettingController::class, 'admin_info']);
Route::post('/admin/setting/admin_write_action', [AdminSettingController::class, 'admin_write_action']);
Route::post('/admin/setting/admin_delete_action', [AdminSettingController::class, 'admin_delete_action']);
Route::post('/admin/setting/admin_update_action', [AdminSettingController::class, 'admin_update_action']);

/************** 룩북 관리 *******************/

/* 관리자 > 룩북 카테고리 관리 > 메인 카테고리 */
Route::get('/admin/lookbook/main_category', [AdminLookbookController::class, 'main_category_index']);
Route::post('/admin/lookbook/main_category_info', [AdminLookbookController::class, 'main_category_info']);
Route::post('/admin/lookbook/main_category_write_action', [AdminLookbookController::class, 'main_category_write_action']);
Route::post('/admin/lookbook/main_category_delete_action', [AdminLookbookController::class, 'main_category_delete_action']);
Route::post('/admin/lookbook/main_category_update_action', [AdminLookbookController::class, 'main_category_update_action']);

/* 관리자 > 룩북 카테고리 관리 > 서브 카테고리 */
Route::get('/admin/lookbook/sub_category', [AdminLookbookController::class, 'sub_category_index']);
Route::post('/admin/lookbook/sub_category_info', [AdminLookbookController::class, 'sub_category_info']);
Route::post('/admin/lookbook/sub_category_write_action', [AdminLookbookController::class, 'sub_category_write_action']);
Route::post('/admin/lookbook/sub_category_delete_action', [AdminLookbookController::class, 'sub_category_delete_action']);
Route::post('/admin/lookbook/sub_category_update_action', [AdminLookbookController::class, 'sub_category_update_action']);

/* 관리자 > 룩북 카테고리 관리 > 룩북 이미지 관리 */
Route::get('/admin/lookbook/contents', [AdminLookbookController::class, 'lookbook_contents']);

//관리자 > 룩북 이미지 등록 및 수정 카테고리 리스트 가져오기
Route::get('/admin/lookbook/get_main_category_list', [AdminLookbookController::class, 'get_main_category_list']);
Route::get('/admin/lookbook/get_sub_category_list', [AdminLookbookController::class, 'get_sub_category_list']);
Route::get('/admin/lookbook/get_all_sub_category_list', [AdminLookbookController::class, 'get_all_sub_category_list']);

Route::post('/admin/lookbook/lookbook_write_action', [AdminLookbookController::class, 'lookbook_write_action']);
Route::post('/admin/lookbook/lookbook_delete_action', [AdminLookbookController::class, 'lookbook_delete_action']);
Route::post('/admin/lookbook/lookbook_update_action', [AdminLookbookController::class, 'lookbook_update_action']);
Route::post('/admin/lookbook/lookbook_info', [AdminLookbookController::class, 'lookbook_info']);


/************** Contact *******************/
/* 관리자 > contact > 간편 상담 신청 관리 */
Route::get('/admin/contact/inquiry', [AdminContactController::class, 'inquiry_index']);
Route::post('/admin/contact/inquiry_check_action', [AdminContactController::class, 'inquiry_check_action']);
Route::post('/admin/contact/inquiry_delete_action', [AdminContactController::class, 'inquiry_delete_action']);
Route::post('/admin/contact/inquiry_info', [AdminContactController::class, 'inquiry_info']);


/************** Shop *******************/
/* 관리자 > shop > 메인 카테고리 관리 */
Route::get('/admin/shop/main_category', [AdminShopController::class, 'main_category_index']);

/* 관리자 > shop > 서브 카테고리 관리 */
Route::get('/admin/shop/sub_category', [AdminShopController::class, 'sub_category_index']);

/* 관리자 > shop > 브랜드 관리 */
Route::get('/admin/shop/brand', [AdminShopController::class, 'brand_index']);

/* 관리자 > shop > 상품 관리 */
Route::get('/admin/shop/product', [AdminShopController::class, 'product_index']);
Route::get('/admin/shop/product_write', [AdminShopController::class, 'product_write']);


Route::post('/admin/shop/inquiry_check_action', [AdminShopController::class, 'inquiry_check_action']);
Route::post('/admin/shop/inquiry_delete_action', [AdminShopController::class, 'inquiry_delete_action']);
Route::post('/admin/shop/inquiry_info', [AdminShopController::class, 'inquiry_info']);
