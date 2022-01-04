@extends('layouts.admin_header')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">관리자 설정</h1>
    {{--    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.--}}
    {{--        For more information about DataTables, please visit the <a target="_blank"--}}
    {{--                                                                   href="https://datatables.net">official DataTables documentation</a>.</p>--}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">관리자 목록</h6>
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
                        <th>아이디</th>
                        <th>이름</th>
                        <th>등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($admin_list) > 0)
                        @foreach($admin_list as $admin)
                            <tr>
                                <td>{{$admin->id}}</td>
                                <td>{{$admin->member_id}}</td>
                                <td>{{$admin->member_name}}</td>
                                <td>{{$admin->created_at}}</td>
                                <td>
                                    @if($admin->del_yn == "N")
                                        <button class="btn btn-info btn_update_modal" data-id="{{$admin->id}}" data-toggle="modal" data-target="#admin_update_modal">수정</button>
                                        <button class="btn btn-danger btn_delete_admin" data-id="{{$admin->id}}">삭제</button>
                                    @else
                                        <button class="btn btn-outline-dark btn_delete_cancel_admin" data-id="{{$admin->id}}">삭제취소</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr align="center">
                            <td colspan="6">등록된 관리자가 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div align="center">
                    {{$admin_list->links()}}
                </div>

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

            $("#btn_insert_admin").on("click", function(){

                var insert_admin_id = $("#insert_admin_id").val();
                var insert_admin_name = $("#insert_admin_name").val();
                var insert_admin_pw = $("#insert_admin_pw").val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/setting/admin_write_action"
                    , data: {
                        insert_admin_id : insert_admin_id
                        , insert_admin_name : insert_admin_name
                        , insert_admin_pw : insert_admin_pw
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("정상 등록 됐습니다!");
                            location.reload();
                        } else if(result == "same_id") {
                            alert("중복된 아이디가 존재합니다.");
                            location.reload();
                        } else {
                            alert("에러가 발생했습니다. 다시 시도해주세요.");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_admin").on("click", function(){

                var admin_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/setting/admin_delete_action"
                    , data: {
                        admin_id : admin_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 관리자가 삭제 되었습니다!");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_cancel_admin").on("click", function(){

                var admin_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/setting/admin_delete_action"
                    , data: {
                        admin_id : admin_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 관리자가 삭제 취소되었습니다!");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_update_modal").on("click", function(){

                $("#update_admin_id").text('');
                $("#update_admin_name").val('');

                var admin_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , type:'POST'
                    , url : "/admin/setting/admin_info"
                    , data: {
                        admin_id : admin_id
                    }
                    , success:function(result) {

                        $("#update_adminFrm #admin_id").val(result.id);
                        $("#update_admin_id").text(result.member_id);
                        $("#update_admin_name").val(result.member_name);
                    }
                });
            });

            $('.btn_update_admin').on("click", function(){

                var admin_id = $("#update_adminFrm #admin_id").val();
                var update_admin_name = $("#update_admin_name").val();
                var update_admin_pw = $("#update_admin_pw").val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/setting/admin_update_action"
                    , data: {
                        admin_id : admin_id
                        , update_admin_name : update_admin_name
                        , update_admin_pw : update_admin_pw
                    }
                    , type:'POST'
                    , success:function(result) {

                        if(result == "success") {
                            alert("정상적으로 수정되었습니다!");
                            location.reload();
                        } else {
                            alert("에러가 발생했습니다. 다시 시도해주세요.");
                        }
                    }
                });
            });
        });
    </script>
@endsection
