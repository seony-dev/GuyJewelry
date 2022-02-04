<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAlarm;
use App\Models\LookbookMainCategory;
use App\Models\ShopBrand;
use App\Models\ShopMainCategory;
use App\Models\ShopProduct;
use App\Models\ShopSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminShopController extends Controller
{
    //
    public function main_category_index (Request $request) {

        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

            //메인 카테고리 리스트
            $shop_main_category_list = ShopMainCategory::orderBy('id', 'desc')->paginate(15);

        } else {
            $admin_info = null;
        }

        return view('/admin/shop/main_category_index', compact('shop_main_category_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }

    public function sub_category_index (Request $request) {

        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

            //서브 카테고리 리스트
            $shop_sub_category_list = ShopSubCategory::select(
                'shop_sub_categories.id as shop_sub_category_id'
                , 'shop_sub_categories.shop_sub_category_name'
                , 'shop_sub_categories.shop_sub_category_image'
                , 'shop_sub_categories.created_at'
                , 'shop_sub_categories.del_yn'
                , 'shop_main_categories.id as shop_main_category_id'
                , 'shop_main_categories.shop_main_category_name'
            )
                ->orderBy('shop_sub_categories.id', 'desc')
                ->leftjoin('shop_main_categories', function ($join) {
                    $join->on('shop_main_categories.id', '=', 'shop_sub_categories.shop_main_category_id');
                })
                ->paginate(15);

        } else {
            $admin_info = null;
        }

        return view('/admin/shop/sub_category_index', compact('shop_sub_category_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }

    public function brand_index (Request $request) {

        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

            //브랜드 리스트
            $shop_brand_list = ShopBrand::orderBy('id', 'desc')->paginate(15);

        } else {
            $admin_info = null;
        }

        return view('/admin/shop/brand_index', compact('shop_brand_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));

    }

    public function product_index (Request $request) {

        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

            //상품 리스트
            $shop_product_list = ShopProduct::select(
                    'shop_products.id as shop_product_id'
                    , 'shop_products.product_code'
                    , 'shop_products.product_name'
                    , 'shop_products.product_image_main'
                    , 'shop_products.created_at'
                    , 'shop_products.del_yn'
                    , 'shop_products.product_price'
                    , 'shop_main_categories.id as shop_main_category_id'
                    , 'shop_main_categories.shop_main_category_name as main_category_name'
                    , 'shop_sub_categories.id as shop_sub_category_id'
                    , 'shop_sub_categories.shop_sub_category_name as sub_category_name'
                    , 'shop_brands.id as shop_brand_id'
                    , 'shop_brands.brand_name as shop_brand_name'
                )
                ->leftjoin('shop_main_categories', function ($join) {
                    $join->on('shop_main_categories.id', '=', 'shop_products.shop_main_category_id');
                })
                ->leftjoin('shop_sub_categories', function ($join) {
                    $join->on('shop_sub_categories.id', '=', 'shop_products.shop_sub_category_id');
                })
                ->leftjoin('shop_brands', function ($join) {
                    $join->on('shop_brands.id', '=', 'shop_products.shop_brand_id');
                })
                ->orderBy('shop_products.id', 'desc')
                ->paginate(15);

        } else {
            $admin_info = null;
            $admin_alarm_cnt = null;
            $admin_alarm_list = null;

            $shop_product_list = null;
        }

        return view('/admin/shop/product_index', compact('shop_product_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }

    public function product_write (Request $request) {
        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

            //메인 카테고리
            $shop_main_category_list = ShopMainCategory::where('del_yn', 'N')->get();

            //서브 카테고리
            $shop_sub_category_list = ShopSubCategory::where('del_yn', 'N')->get();

            //브랜드
            $shop_brand_list = ShopBrand::where('del_yn', 'N')->get();

        } else {
            $admin_info = null;
            $admin_alarm_cnt = null;
            $admin_alarm_list = null;

            $shop_main_category_list = null;
            $shop_sub_category_list = null;
            $shop_brand_list = null;
        }

        return view('/admin/shop/product_write', compact( 'shop_main_category_list','shop_sub_category_list',
            'shop_brand_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }

    //룩북 카테고리 > 서브 카테고리 전체 리스트 가져오기 api
    public function get_sub_category_list(Request $request) {

        if ($request->session()->has('admin_session')) {

            $shop_main_category_id = $request->shop_main_category_id;

            $shop_sub_category_list = ShopSubCategory::where([
                ['del_yn', 'N'],
                ['shop_main_category_id', $shop_main_category_id]
            ])->get();

            return $shop_sub_category_list;
        }
    }

    //Shop > 상품 관리 > 에디터 이미지 저장 api
    public function save_editor_images(Request $request)
    {

        if ($request->session()->has('admin_session')) {

            $file = $request->file('file');

            $path = "no save";
            if ($file->isValid()) {

                $path = Storage::disk('public')->put('images/editorImages', $file);

                return 'storage/' . $path;

            }
        }
    }

    public function product_insert_action(Request $request){

        if ($request->session()->has('admin_session')) {

            $new_product = new ShopProduct();
            $new_product->product_code = $request->product_code;
            $new_product->product_name = $request->product_name;
            $new_product->product_info = $request->product_info;

            if(!empty($request->product_image_main)) {
                $file = $request->file('product_image_main');

                if ($file->isValid()) {

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('admin/shop', $file);
                    $new_product->product_image_main = '/storage/'.$path;

                }
            }

            if(!empty($request->product_image_sub)) {
                $file = $request->file('product_image_sub');

                if ($file->isValid()) {

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('admin/shop', $file);
                    $new_product->product_image_sub = '/storage/'.$path;

                }
            }

            if(!empty($request->product_image_third)) {
                $file = $request->file('product_image_third');

                if ($file->isValid()) {

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('admin/shop', $file);
                    $new_product->product_image_third = '/storage/'.$path;

                }
            }

            $new_product->shop_main_category_id = $request->shop_main_category_id;
            $new_product->shop_sub_category_id = $request->shop_sub_category_id;
            $new_product->shop_brand_id = $request->shop_brand_id;


            $num_product_price = str_replace(',','',$request->product_price);
            $new_product->product_price = $num_product_price;

            $new_product->product_main_yn = $request->product_main_yn;

            $new_product->created_at = date('Y-m-d H:i:s');

            if ($new_product->save()) {
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;

        } else {
            return view("index");
        }

        return $result;
    }

    public function product_delete_action(Request $request){

        $result = 'success';

        return $result;
    }

    public function product_update_action(Request $request){

        $result = 'success';

        return $result;
    }
}
