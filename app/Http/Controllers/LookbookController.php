<?php

namespace App\Http\Controllers;

use App\Models\Lookbook;
use App\Models\LookbookMainCategory;
use Illuminate\Http\Request;

class LookbookController extends Controller
{
    //룩북 > 리스트 view
    public function lookbook_index(Request $request)
    {

//        $lookbook_list = Lookbook::select(
//            'lookbooks.id as lookbook_id'
//            , 'lookbooks.lookbook_title'
//            , 'lookbooks.lookbook_contents'
//            )
//            ->where('lookbooks.del_yn', 'N')
//            ->orderBy('lookbooks.created_at', 'DESC')
//            ->paginate(5);
////            ->get();
///

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
}
