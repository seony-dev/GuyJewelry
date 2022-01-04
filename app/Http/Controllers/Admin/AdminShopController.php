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
                    , 'shop_main_categories.id as shop_main_category_id'
                    , 'shop_main_categories.shop_main_category_name as main_category_name'
                    , 'shop_sub_categories.id as shop_sub_category_id'
                    , 'shop_sub_categories.shop_sub_category_name as sub_category_name'
                    , 'shop_brands.id as shop_brand_id'
                    , 'shop_brands.shop_brand_name as brand_name'
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
        }

        return view('/admin/shop/product_index', compact('shop_product_list', 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }

    public function product_write (Request $request) {
        if ($request->session()->has('admin_session')) {

            $admin_info = $request->session()->get('admin_info');

            //모든 관리자 알람
            $admin_alarm_cnt = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->count();
            $admin_alarm_list = AdminAlarm::where('del_yn', 'N')->where('check_yn', 'N')->orderBy('id', 'desc')->get();

        } else {
            $admin_info = null;
        }

        return view('/admin/shop/product_write', compact( 'admin_info', 'admin_alarm_cnt', 'admin_alarm_list'));
    }


}
