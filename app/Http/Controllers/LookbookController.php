<?php

namespace App\Http\Controllers;

use App\Models\Lookbook;
use App\Models\LookbookMainCategory;
use App\Models\LookbookSubCategory;
use Illuminate\Http\Request;

class LookbookController extends Controller
{
    //룩북 > 리스트 view (메인 카테고리 리스트)
    public function lookbook_index(Request $request)
    {

        $lookbook_main_category_list = LookbookMainCategory::select(
            'lookbook_main_categories.id as lookbook_main_category_id'
            , 'lookbook_main_category_name'
            , 'lookbook_main_category_image'
            )
            ->where('lookbook_main_categories.del_yn', 'N')
            ->orderBy('lookbook_main_categories.created_at', 'DESC')
            ->get();

        return view("lookbook/lookbook", compact('lookbook_main_category_list'));
    }

    //룩북 > 서브 카테고리 리스트 view
    public function lookbook_category(Request $request)
    {

        $lookbook_main_category_id = $request->lookbook_main_category_id;

        $lookbook_sub_category_list = LookbookSubCategory::where('del_yn', 'N')
            ->where('lookbook_main_category_id', $lookbook_main_category_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view("lookbook/lookbook_category_index", compact('lookbook_sub_category_list'));
    }

    public function lookbook_content(Request $request)
    {
        $lookbook_main_category_id = $request->lookbook_main_category_id;

        $lookbook_sub_category_list = LookbookSubCategory::where('del_yn', 'N')
            ->where('lookbook_main_category_id', $lookbook_main_category_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view("lookbook/lookbook_content", compact('lookbook_sub_category_list'));
    }
}
