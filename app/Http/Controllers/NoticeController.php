<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function notice_index (Request $request) {

        $notice_list = Notice::select (
                'notices.notice_id'
                , 'notices.notice_title'
                , 'notices.notice_contents'
                , 'members.user_id'
                , 'members.member_name'
                , 'notices.created_at' )
            ->where('notices.del_yn', 'N')
            ->orderBy('notices.created_at', 'DESC')
//            ->with(['member'])
            ->join('members', function ($join) {
                $join->on('notices.user_id', '=', 'members.user_id');
            })
            ->get();

        return view("notice", compact('notice_list'));
    }

    public function notice_detail (Request $request) {

        $notice_id = $request->notice_id;
        $state = $request->state;

        $is_admin = 'N';

        $notice_detail = Notice::select (
            'notices.notice_id'
            , 'notices.notice_title'
            , 'notices.notice_contents'
            , 'notices.notice_files'
            , 'members.user_id'
            , 'members.member_name'
            , 'notices.created_at' )
            ->where('notice_id', $notice_id)
            ->where('notices.del_yn', 'N')
            ->orderBy('notices.created_at', 'DESC')
            ->join('members', function ($join) {
                $join->on('notices.user_id', '=', 'members.user_id');
            })
            ->first();

        if($request->session()->has('admin_session')) {
            $admin_name = $request->session()->getName();
            $is_admin = 'Y';
        }

        return view("notice_form", compact('notice_detail', 'state', 'is_admin', 'admin_name'));
    }

    public function notice_form (Request $request) {

        if ($request->session()->has('admin_session')) {

            $is_admin = 'Y';
            $state = $request->state;

            $admin_id = $request->session()->get("admin_session");
            $admin_name = Member::select ('member_name')
                ->where('user_id', $admin_id)
                ->where('del_yn', 'N')
                ->first();

            return view("notice_form", compact('is_admin','admin_id', 'admin_name' ,'state'));

        } else {

            return view("index");
        }
    }

    public function notice_write_action (Request $request) {

        if ($request->session()->has('admin_session')) {

            $new_write_notice = New Notice();
            $new_write_notice->notice_title = $request->notice_title;
            $new_write_notice->notice_contents = $request->notice_contents;

            if(!empty($request->notice_files)) {
                $new_write_notice->notice_files = $request->notice_files;
            }
            $new_write_notice->user_id = $request->user_id;
            $new_write_notice->created_at = date('Y-m-d H:i:s');
            $new_write_notice->updated_at = date('Y-m-d H:i:s');

            if($new_write_notice->save()) {
                $result = "success";
            } else {
                $result = "fail";
            }

            return $result;

        } else {
            return view("index");
        }
    }

    public function save_editor_images (Request $request) {

        if ($request->session()->has('admin_session')) {

//            Storage::disk('custom_01')->put('test.png' , $request->file('upload_files') ) ;
//            Storage::disk($diskName)->putFile($SaveFilePath, $httpRrequest->file('upload_file'));

//            $request->file('file')->store('images/editorImages', 'public');

            $file = $request->file('file');

            $path = "no save";
            if ($file->isValid()) {

                $path = Storage::disk('public')->put('images/editorImages', $file);

                //$get_path = Storage::disk('public')->path($path);
//                $path = $request->file('file')->store('images/editorImages');

                return 'storage/'.$path;

            }

            //업로드할 폴더
//            $uploads_dir = $this->input->post('editorImages');
//
//            //폴더가 없으면 생성해 줍니다.
//            if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$uploads_dir)) {
//                @mkdir($_SERVER['DOCUMENT_ROOT']."/".$uploads_dir, 0777);
//                @chmod($_SERVER['DOCUMENT_ROOT']."/".$uploads_dir, 0777);
//            } //업로드 허용 확장자
//
//            $allowed_ext = array('jpg','jpeg','png','gif');
//            //결과를 담을 변수
//            $result = array();
//
//            foreach($_FILES['file']['name'] as $f=>$name) {
//                $name = $_FILES['file']['name'][$f]; //확장자 추출
//                $exploded_file = strtolower(substr(strrchr($name, '.'), 1));
//                //변경할 파일명(중복되지 않게 처리하기 위해 파일명을 변경해 줍니다.)
//                $thisName = date("YmdHis",time())."_".md5($name).".".$exploded_file; //업로드 파일(업로드 경로/변경할 이미지 파일명)
//                $uploadFile = $uploads_dir."/".$thisName; if(in_array($exploded_file, $allowed_ext)) {
//                    if(move_uploaded_file($_FILES['file']['tmp_name'][$f], $uploadFile)){ //파일을 업로드 폴더로 옮겨준후 $result 에 해당 경로를 넣어줍니다.
//                        array_push($result, "/".$uploadFile);
//                    }
//                }
//            }

        }
    }



}
