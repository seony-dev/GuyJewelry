@extends('layouts.admin_header')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">상품 카테고리 설정</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">메인 카테고리 목록</h6>
        </div>
        <div class="card-body">
            <div align="right" style="margin-bottom: 15px;">
                <button type="button" class="btn btn-success" id="btn_insert_modal" data-toggle="modal" data-target="#admin_insert_modal">등록</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 20%;">
                        <col style="width: 35%;">
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>메인 카테고리명</th>
                        <th>메인 카테고리 이미지</th>
                        <th style="border-right-color: transparent;">등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(is_null($shop_main_category_list) ? 0 : count($shop_main_category_list) > 0)
                        @foreach($shop_main_category_list as $shop_main_category)
                            <tr>
                                <td>{{$shop_main_category->id}}</td>
                                <td>{{$shop_main_category->shop_main_category_name}}</td>
                                <td>{{$shop_main_category->shop_main_category_image}}</td>
                                <td>{{$shop_main_category->created_at}}</td>
                                <td>
                                    @if($shop_main_category->del_yn == "N")
                                        <button class="btn btn-info btn_update_modal" data-id="{{$shop_main_category->id}}" data-toggle="modal" data-target="#admin_update_modal">수정</button>
                                        <button class="btn btn-danger btn_delete_admin" data-id="{{$shop_main_category->id}}">삭제</button>
                                    @else
                                        <button class="btn btn-outline-dark btn_delete_cancel_admin" data-id="{{$shop_main_category->id}}">삭제취소</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr align="center">
                            <td colspan="6">등록된 메인 카데고리가 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(is_null($shop_main_category_list) ? 0 : count($shop_main_category_list) > 0)
                    <div align="center">
                        {{$shop_main_category_list->links()}}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="admin_insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">관리자 등록</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insert_adminFrm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>아이디</th>
                                <td>
                                    <input type="text" class="form-control input-group" id="insert_admin_id" name="insert_admin_id">
                                </td>
                            </tr>
                            <tr>
                                <th>이름</th>
                                <td>
                                    <input type="text" class="form-control input-group" id="insert_admin_name" name="insert_admin_name">
                                </td>
                            </tr>
                            <tr>
                                <th>패스워드</th>
                                <td>
                                    <input type="password" class="form-control input-group" id="insert_admin_pw" name="insert_admin_pw">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary float-right"  id="btn_insert_admin">등록</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="admin_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">관리자 정보 수정</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_adminFrm">
                        <input type="hidden" id="admin_id" name="admin_id">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>아이디</th>
                                <td>
                                    <span id="update_admin_id"></span>

                                </td>
                            </tr>
                            <tr>
                                <th>이름</th>
                                <td>
                                    <input type="text" class="form-control input-group" id="update_admin_name" name="update_admin_name">
                                </td>
                            </tr>
                            <tr>
                                <th>패스워드</th>
                                <td>
                                    <input type="password" class="form-control input-group" id="update_admin_pw" name="update_admin_pw" placeholder="변경 시에만 입력해주세요.">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary float-right btn_update_admin">수정</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
