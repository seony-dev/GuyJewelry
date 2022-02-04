<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index () {

        $members = Member::orderBy('created', 'desc')->get();

        return view('index', ['members' => $members]);
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
}
