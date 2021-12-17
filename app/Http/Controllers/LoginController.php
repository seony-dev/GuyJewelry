<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //로그인 뷰
    public function login_index () {

        $members = Member::orderBy('created_at', 'desc')->get();

        return view('login', ['members' => $members]);
    }

    //로그인 api
    public function login_action (Request $request) {

        $member_id = $request->member_id;
        $member_pw = $request->member_pw;

        //관리자 로그인
        $admin = Member::where([
            ['member_id', $member_id],
            ['member_pw', $member_pw],
            ['admin_yn', 'Y']
        ])->first();

        //관리자만 로그인 가능
        if (!empty($admin)) {
            $request->session()->put('admin_session', true);
            $result = "success";

        } else {
            $result = "fail";
        }

        return $result;
    }

    //로그아웃 api
    public function logout_action (Request $request) {
        $request->session()->forget('admin_session');
        return redirect('/');
    }
}
