<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{

    //공지사항 > 리스트 view
    public function notice_index(Request $request)
    {

        $search_subject = $request->search_subject;
        $search_word = $request->search_word;

        $notice_list = Notice::select(
            'notices.id as notice_id'
            , 'notices.notice_title'
            , 'notices.notice_contents'
            , 'notices.notice_views'
            , 'members.id as user_id'
            , 'members.member_name'
            , 'notices.created_at')
            ->where('notices.del_yn', 'N')
            ->where(function ($query) use ($search_subject, $search_word) {
                if(!empty($search_subject)){
                    switch ($search_subject) {
                        case 'all' :
                            $query->where('notice_title', 'like', '%'.$search_word.'%')
                                ->orWhere('notice_contents', 'like', '%'.$search_word.'%');
                            break;
                        case 'title' :
                            $query->where('notice_title', 'like', '%'.$search_word.'%');
                            break;
                        case 'contents' :
                            $query->where('notice_contents', 'like', '%'.$search_word.'%');
                            break;
                    }
                }
            })
            ->orderBy('notices.created_at', 'DESC')
            ->join('members', function ($join) {
                $join->on('notices.user_id', '=', 'members.id');
            })
            ->paginate(10);
//            ->get();

        return view("notice/notice", compact('notice_list'));
    }

    //공지사항 > 상세 페이지 view
    public function notice_detail(Request $request)
    {

        $notice_id = $request->notice_id;
        $state = $request->state;

        $is_admin = 'N';


        //해당 글 상세 내용 조회
        $notice_detail = Notice::select(
            'notices.id as notice_id'
            , 'notices.notice_title'
            , 'notices.notice_contents'
            , 'notices.notice_file_name'
            , 'notices.notice_file'
            , 'notices.notice_views'
            , 'notices.notice_link'
            , 'members.id as user_id'
            , 'members.member_name'
            , 'notices.created_at')
            ->where('notices.id', $notice_id)
            ->where('notices.del_yn', 'N')
            ->orderBy('notices.created_at', 'DESC')
            ->join('members', function ($join) {
                $join->on('notices.user_id', '=', 'members.id');
            })
            ->first();

        $admin_name = array();
        $admin_name['member_name'] = null;

        if ($request->session()->has('admin_session')) {
            $admin_name = $request->session()->getName();
            $is_admin = 'Y';
        }

        return view("notice/notice_form", compact('notice_detail', 'state', 'is_admin', 'admin_name'));
    }

    //공지사항 > 상세 / 작성 / 수정 페이지 view
    public function notice_form(Request $request)
    {

        if ($request->session()->has('admin_session')) {

            $is_admin = 'Y';
            $state = $request->state;

            $admin_id = $request->session()->get("admin_session");
            $admin_name = Member::select('member_name')
                ->where('id', $admin_id)
                ->where('del_yn', 'N')
                ->first();

            return view("notice/notice_form", compact('is_admin', 'admin_id', 'admin_name', 'state'));

        } else {
            return view("index");
        }
    }

    //공지사항 > 상세 페이지 > 조회 수 증가 api
    public function notice_add_views(Request $request)
    {

        $notice_id = $request->notice_id;

        //조회수 증가
        $notice = Notice::find($notice_id);
        $notice->notice_views = $notice->notice_views + 1;
        $notice->save();

    }

    //공지사항 > 글 저장 api
    public function notice_write_action(Request $request)
    {

        if ($request->session()->has('admin_session')) {

            $new_write_notice = new Notice();
            $new_write_notice->notice_title = $request->notice_title;
            $new_write_notice->notice_contents = $request->notice_contents;

            if(!empty($request->notice_link)) {
                $new_write_notice->notice_link = $request->notice_link;
            }

            if (!empty($request->notice_file)) {
                $new_write_notice->notice_file = $request->notice_file;
            }
            $new_write_notice->user_id = $request->user_id;
            $new_write_notice->created_at = date('Y-m-d H:i:s');

            if ($new_write_notice->save()) {
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
    public function notice_delete_action(Request $request)
    {
        if ($request->session()->has('admin_session')) {

            $notice_id = $request->notice_id;

            $notice = Notice::find($notice_id);
            $notice->del_yn = 'Y';

            if($notice->save()){
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;
        }
    }

    //공지사항 수정 api
    public function notice_update_action(Request $request)
    {
        if ($request->session()->has('admin_session')) {

            $notice_id = $request->notice_id;

            $update_notice = Notice::find($notice_id);

            $update_notice->notice_title = $request->notice_title;
            $update_notice->notice_contents = $request->notice_contents;

            if(!empty($request->notice_link)) {
                $update_notice->notice_link = $request->notice_link;
            }

            if(!empty($request->notice_file)) {
//                $update_notice->notice_files = $request->notice_file;
                $file = $request->file('notice_file');

                $zip = new \ZipArchive();

                if ($file->isValid()) {

                    //파일 이름 저장
                    $file_name = $file->getClientOriginalName();
                    $update_notice->notice_file_name = $file_name;

                    //파일 경로 저장
                    $path = Storage::disk('public')->put('files', $file);
                    $update_notice->notice_file = $path;

                }
            }
            $update_notice->updated_at = date('Y-m-d H:i:s');

            $result = null;

            if($update_notice->save()) {
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;
        }
    }

    //공지사항 첨부파일 다운로드 api
    public function notice_download_file (Request $request) {

        $notice_file = public_path('storage/'.$request->notice_file);

        return response()->download($notice_file);
    }

}
