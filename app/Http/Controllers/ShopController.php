<?php

namespace App\Http\Controllers;

use App\Models\ShopMainCategory;
use App\Models\ShopProduct;
use App\Models\ShopSubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop_index(Request $request)
    {

        $search_subject = $request->search_subject;
        $search_word = $request->search_word;

        $shop_product_list = ShopProduct::select(
            'shop_products.id as shop_product_id'
             )
            ->paginate(10);

        $shop_main_category_list = ShopMainCategory::where('del_yn', 'N')->get();

        $shop_sub_category_list = ShopSubCategory::where('del_yn', 'N')->get();

        return view("shop/shop", compact('shop_product_list','shop_main_category_list', 'shop_sub_category_list'));
    }

    public function sub_category_list(Request $request) {

        $shop_main_category_id = $request->shop_main_category_id;

        $shop_sub_category_list = ShopSubCategory::where('shop_main_category_id', $shop_main_category_id)->where('del_yn', 'N')->get();

        return $shop_sub_category_list;
    }
}
