<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index () {

        $members = Member::orderBy('created_at', 'desc')->get();

        return view('index', ['members' => $members]);
    }
}
