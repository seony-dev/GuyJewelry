<?php

namespace App\Http\Controllers;

use App\Models\GuyNews;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuyNewsController extends Controller
{
    //
    public function guy_news_index(Request $request) {

        $search_subject = $request->search_subject;
        $search_word = $request->search_word;

        $guy_news_list = GuyNews::select(
            'guy_news.id as guy_news_id'
            , 'guy_news.guy_news_title'
            , 'guy_news.guy_news_contents'
            , 'guy_news.guy_news_thumbnail'
            , 'guy_news.guy_news_views'
            , 'members.id as user_id'
            , 'members.member_name'
            , 'guy_news.created_at')
            ->where('guy_news.del_yn', 'N')
            ->where(function ($query) use ($search_subject, $search_word) {
                if(!empty($search_subject)){
                    switch ($search_subject) {
                        case 'all' :
                            $query->where('guy_news_title', 'like', '%'.$search_word.'%')
                                ->orWhere('guy_news_contents', 'like', '%'.$search_word.'%');
                            break;
                        case 'title' :
                            $query->where('guy_news_title', 'like', '%'.$search_word.'%');
                            break;
                        case 'contents' :
                            $query->where('guy_news_contents', 'like', '%'.$search_word.'%');
                            break;
                    }
                }
            })
            ->orderBy('guy_news.id', 'DESC')
            ->join('members', function ($join) {
                $join->on('guy_news.user_id', '=', 'members.id');
            })
            ->paginate(10);
//            ->get();

        return view('guy_news/guy_news', compact('guy_news_list'));
    }

    //공지사항 > 상세 페이지 view
    public function guy_news_detail(Request $request)
    {

        $guy_news_id = $request->guy_news_id;
        $state = $request->state;

        $is_admin = 'N';


        //해당 글 상세 내용 조회
        $guy_news_detail = GuyNews::select(
            'guy_news.id as guy_news_id'
            , 'guy_news.guy_news_title'
            , 'guy_news.guy_news_contents'
            , 'guy_news.guy_news_thumbnail'
            , 'guy_news.guy_news_file_name'
            , 'guy_news.guy_news_file'
            , 'guy_news.guy_news_views'
            , 'guy_news.guy_news_link'
            , 'members.id as user_id'
            , 'members.member_name'
            , 'guy_news.created_at')
            ->where('guy_news.id', $guy_news_id)
            ->where('guy_news.del_yn', 'N')
            ->orderBy('guy_news.created_at', 'DESC')
            ->join('members', function ($join) {
                $join->on('guy_news.user_id', '=', 'members.id');
            })
            ->first();

        $admin_name = array();
        $admin_name['member_name'] = null;

        if ($request->session()->has('admin_session')) {
            $admin_name = $request->session()->getName();
            $is_admin = 'Y';
        }

        return view("guy_news/guy_news_form", compact('guy_news_detail', 'state', 'is_admin', 'admin_name'));
    }

    //공지사항 > 상세 / 작성 / 수정 페이지 view
    public function guy_news_form(Request $request)
    {

        if ($request->session()->has('admin_session')) {

            $is_admin = 'Y';
            $state = $request->state;

            $admin_info = $request->session()->get("admin_info");
            $admin_id = $admin_info->id;
            $admin_name = $admin_info->member_name;

            return view("guy_news/guy_news_form", compact('is_admin', 'admin_id', 'admin_name', 'state'));

        } else {
            return view("index");
        }
    }

    //공지사항 > 상세 페이지 > 조회 수 증가 api
    public function guy_news_add_views(Request $request)
    {

        $guy_news_id = $request->guy_news_id;

        //조회수 증가
        $guy_news = GuyNews::find($guy_news_id);
        $guy_news->guy_news_views = $guy_news->guy_news_views + 1;
        $guy_news->save();

    }

    //공지사항 > 글 저장 api
    public function guy_news_write_action(Request $request)
    {

        if ($request->session()->has('admin_session')) {

            $new_write_guy_news = new GuyNews();
            $new_write_guy_news->guy_news_title = $request->guy_news_title;
            $new_write_guy_news->guy_news_contents = $request->guy_news_contents;

            if(!empty($request->guy_news_thumbnail)) {
                $file = $request->file('guy_news_thumbnail');

                if ($file->isValid()) {

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('images/guy_news', $file);
                    $new_write_guy_news->guy_news_thumbnail = '/storage/'.$path;
                }
            }

            if(!empty($request->guy_news_link)) {
                $new_write_guy_news->guy_news_link = $request->guy_news_link;
            }

            if(!empty($request->guy_news_file)) {
                $file = $request->file('guy_news_file');

                if ($file->isValid()) {

                    //파일 이름 저장
                    $file_name = $file->getClientOriginalName();
                    $new_write_guy_news->guy_news_file_name = $file_name;

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('files', $file);
                    $new_write_guy_news->guy_news_file = $path;

                }
            }

            $new_write_guy_news->user_id = $request->user_id;
            $new_write_guy_news->created_at = date('Y-m-d H:i:s');

            if ($new_write_guy_news->save()) {
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;

        } else {
            return view("index");
        }
    }

    //공지사항 > 글 작성 > 에디터 이미지 저장 api
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

    //공지사항 삭제 api
    public function guy_news_delete_action(Request $request)
    {
        if ($request->session()->has('admin_session')) {

            $guy_news_id = $request->guy_news_id;

            $guy_news = GuyNews::find($guy_news_id);
            $guy_news->del_yn = 'Y';

            if($guy_news->save()){
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;
        }
    }

    //공지사항 수정 api
    public function guy_news_update_action(Request $request)
    {
        if ($request->session()->has('admin_session')) {

            $guy_news_id = $request->guy_news_id;

            $update_guy_news = GuyNews::find($guy_news_id);

            $update_guy_news->guy_news_title = $request->guy_news_title;
            $update_guy_news->guy_news_contents = $request->guy_news_contents;

            if(!empty($request->guy_news_thumbnail)) {
                $file = $request->file('guy_news_thumbnail');

                if ($file->isValid()) {

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('images/guy_news', $file);
                    $update_guy_news->guy_news_thumbnail = '/storage/'.$path;
                }
            }

            if(!empty($request->guy_news_link)) {
                $update_guy_news->guy_news_link = $request->guy_news_link;
            }

            if(!empty($request->guy_news_file)) {
//                $update_guy_news->guy_news_files = $request->guy_news_file;
                $file = $request->file('guy_news_file');

                $zip = new \ZipArchive();

                if ($file->isValid()) {

                    //파일 이름 저장
                    $file_name = $file->getClientOriginalName();
                    $update_guy_news->guy_news_file_name = $file_name;

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('files', $file);
                    $update_guy_news->guy_news_file = $path;

                }
            }
            $update_guy_news->updated_at = date('Y-m-d H:i:s');

            $result = null;

            if($update_guy_news->save()) {
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;
        }
    }

    //공지사항 첨부파일 다운로드 api
    public function guy_news_download_file (Request $request) {

        $guy_news_file = public_path('storage/'.$request->guy_news_file);

        return response()->download($guy_news_file);
    }
}
