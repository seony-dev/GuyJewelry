@extends('layouts.admin_header')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">룩북</h1>
    {{--    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.--}}
    {{--        For more information about DataTables, please visit the <a target="_blank"--}}
    {{--                                                                   href="https://datatables.net">official DataTables documentation</a>.</p>--}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">룩북 이미지 관리</h6>
        </div>
        <div class="card-body">
            <div align="right" style="margin-bottom: 15px;">
                <button type="button" class="btn btn-success" id="btn_insert_modal" data-toggle="modal" data-target="#lookbook_insert_modal">등록</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 15%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>메인 카테고리명</th>
                        <th>서브 카테고리명</th>
                        <th>룩북명</th>
                        <th>룩북 이미지</th>
                        <th style="border-right-color: transparent;">등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($lookbook_list) > 0)
                        @foreach($lookbook_list as $lookbook)
                            <tr>
                                <td>
                                    {{$lookbook->lookbook_id}}
                                </td>
                                <td>
                                    {{$lookbook->lookbook_main_category_name}}
                                </td>
                                <td>
                                    {{$lookbook->lookbook_sub_category_name}}
                                </td>
                                <td>{{$lookbook->lookbook_title}}</td>
                                <td>
                                    <img src="{{$lookbook->lookbook_image}}" alt="" style="width: 300px;">
                                    <span>{{$lookbook->lookbook_image}}</span>
                                </td>
                                <td>{{$lookbook->created_at}}</td>
                                <td>
                                    @if($lookbook->del_yn == "N")
                                        <button class="btn btn-danger btn_delete_lookbook" data-id="{{$lookbook->lookbook_id}}">삭제</button>
                                        <button class="btn btn-info btn_update_modal" data-id="{{$lookbook->lookbook_id}}" data-toggle="modal" data-target="#lookbook_update_modal">수정</button>
                                    @else
                                        <button class="btn btn-outline-dark btn_delete_cancel_lookbook" data-id="{{$lookbook->lookbook_id}}">삭제취소</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr align="center">
                            <td colspan="7">등록된 룩북이 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div align="center">
                    {{$lookbook_list->links()}}
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="lookbook_insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">룩북 등록</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lookbookInsertFrm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>메인 카테고리</th>
                                    <td>
                                        <select class="form-control" name="lookbook_main_category_id" id="lookbook_main_category_id">
                                            <option value="">메인 카테고리 선택</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>서브 카테고리</th>
                                    <td>
                                        <select class="form-control" name="lookbook_sub_category_id" id="lookbook_sub_category_id">
                                            <option value="">서브 카테고리 선택</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북명</th>
                                    <td>
                                        <input type="text" name="lookbook_title" id="lookbook_title" class="form-control input-group" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북 내용</th>
                                    <td>
                                        <textarea class="form-control input-group" name="lookbook_contents" id="lookbook_contents" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북 이미지</th>
                                    <td style="text-align: left;">
                                        <input type="file" id="lookbook_image" name="lookbook_image">
                                        <img src="" alt="" id="preview" style="max-width: 300px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary float-right"  id="btn_insert_lookbook">등록</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lookbook_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">서브 카테고리 수정</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lookbookUpdateFrm">
                        <input type="hidden" class="lookbook_id" name="lookbook_id" id="lookbook_id">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>메인 카테고리</th>
                                    <td>
                                        <select class="form-control" name="lookbook_main_category_id" id="lookbook_main_category_id">
                                            <option value="">메인 카테고리 선택</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>서브 카테고리</th>
                                    <td>
                                        <select class="form-control" name="lookbook_sub_category_id" id="lookbook_sub_category_id">
                                            <option value="">서브 카테고리 선택</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북명</th>
                                    <td>
                                        <input type="text" name="lookbook_title" id="lookbook_title" class="form-control input-group" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북 내용</th>
                                    <td>
                                        <textarea class="form-control input-group" name="lookbook_contents" id="lookbook_contents" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>룩북 이미지</th>
                                    <td style="text-align: left;">
                                        <input type="file" id="lookbook_image" name="lookbook_image">
                                        <img src="" alt="" id="preview" style="max-width: 300px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary float-right btn_update_lookbook">수정</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        fn_update_get_all_main_category_list();
        fn_update_get_all_sub_category_list();

        $(document).ready(function(){

            $('#lookbook_image').change(function(){
                setImageFromFile(this, '#preview');
            });

            $("#btn_insert_modal").on("click", function() {

                $("#lookbookInsertFrm #lookbook_main_category_id").val('');
                $("#lookbookInsertFrm #lookbook_sub_category_id").val('');

                fn_insert_get_main_category_list();
            });

            $('#lookbook_main_category_id').on("change", function() {

                var lookbook_main_category_id = $(this).val();
                fn_insert_get_sub_category_list(lookbook_main_category_id);
            });

            $("#btn_insert_lookbook").on("click", function(){

                var lookbookInsertFrm = $("#lookbookInsertFrm")[0];
                var formData = new FormData(lookbookInsertFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/lookbook_write_action"
                    , data:formData
                    , cache:false
                    , contentType:false
                    , processData:false
                    , enctype:'multipart/formDataData'
                    , type:'POST'
                    , success:function(result) {

                        console.log(result);

                        if(result == "success") {
                            alert("정상 등록 됐습니다!");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_lookbook").on("click", function(){

                var lookbook_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/lookbook_delete_action"
                    , data: {
                        lookbook_id : lookbook_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 룩북이 삭제 되었습니다!");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_cancel_lookbook").on("click", function(){

                var lookbook_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/lookbook_delete_action"
                    , data: {
                        lookbook_id : lookbook_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 룩북이 삭제 취소되었습니다!");
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_update_modal").on("click", function(){

                $("#lookbookUpdateFrm #lookbook_main_category_id").val('');
                $("#lookbookUpdateFrm #lookbook_sub_category_id").val('');
                $("#lookbookUpdateFrm #lookbook_title").val('');
                $("#lookbookUpdateFrm #lookbook_contents").val('');
                $("#lookbookUpdateFrm #lookbook_image").attr("src", '');

                var lookbook_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , type:'POST'
                    , url : "/admin/lookbook/lookbook_info"
                    , data: {
                        lookbook_id : lookbook_id
                    }
                    , success:function(result) {

                        $("#lookbookUpdateFrm #lookbook_main_category_id").val(result.lookbook_main_category_id).prop("selected", true);
                        $("#lookbookUpdateFrm #lookbook_sub_category_id").val(result.lookbook_sub_category_id).prop("selected", true);
                        $("#lookbookUpdateFrm #lookbook_title").val(result.lookbook_title);
                        $("#lookbookUpdateFrm #lookbook_contents").val(result.lookbook_contents);
                        $("#lookbookUpdateFrm #lookbook_image").attr("src", result.lookbook_image);
                        $("#lookbook_id").val(result.id);
                    }
                });
            });

            $('#lookbookUpdateFrm #lookbook_image').change(function(){
                setImageFromFile(this, '#lookbookUpdateFrm #lookbook_image');
            });

            $('.btn_update_lookbook').on("click", function(){

                var lookbookUpdateFrm = $('#lookbookUpdateFrm')[0];
                var formData = new FormData(lookbookUpdateFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/lookbook_update_action"
                    , data: formData
                    , cache:false
                    , contentType:false
                    , processData:false
                    , enctype:'multipart/formDataData'
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

        //카테고리 등록 > 파일 선택 시, 이미지 썸네일
        function setImageFromFile(input, expression) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(expression).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function fn_insert_get_main_category_list() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/get_main_category_list"
                , data: {
                    1 : 1
                }
                , type:'GET'
                , success:function(result) {

                    for(var i=0; i < result.length; i++) {
                        var option = $("<option value='" + result[i].id + "'>"+ result[i].lookbook_main_category_name +"</option>");
                        $("#lookbookInsertFrm #lookbook_main_category_id").append(option);
                    }
                }
            });
        }

        function fn_insert_get_sub_category_list(lookbook_main_category_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/get_sub_category_list"
                , data: {
                    lookbook_main_category_id : lookbook_main_category_id
                }
                , type:'GET'
                , success:function(result) {

                    $("#lookbookInsertFrm #lookbook_sub_category_id").empty();

                    var option = $("<option value=''>서브 카테고리 선택</option>");
                    $("#lookbookInsertFrm #lookbook_sub_category_id").append(option);

                    for(var i=0; i < result.length; i++) {
                        option = $("<option value='" + result[i].id + "'>" + result[i].lookbook_sub_category_name + "</option>");
                        $("#lookbookInsertFrm #lookbook_sub_category_id").append(option);
                    }

                    $("#lookbookInsertFrm #lookbook_sub_category_id").focus();

                }
            });
        }

        function fn_update_get_all_main_category_list() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/get_main_category_list"
                , data: {
                    1 : 1
                }
                , type:'GET'
                , success:function(result) {

                    for(var i=0; i < result.length; i++) {
                        var option = $("<option value='" + result[i].id + "'>"+ result[i].lookbook_main_category_name +"</option>");
                        $("#lookbookUpdateFrm #lookbook_main_category_id").append(option);
                    }
                }
            });
        }

        function fn_update_get_all_sub_category_list() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/get_all_sub_category_list"
                , data: {
                    1:1
                }
                , type:'GET'
                , success:function(result) {

                    $("#lookbookUpdateFrm #lookbook_sub_category_id").empty();

                    var option = $("<option value=''>서브 카테고리 선택</option>");
                    $("#lookbookUpdateFrm #lookbook_sub_category_id").append(option);

                    for(var i=0; i < result.length; i++) {
                        option = $("<option value='" + result[i].id + "'>" + result[i].lookbook_sub_category_name + "</option>");
                        $("#lookbookUpdateFrm #lookbook_sub_category_id").append(option);
                    }

                    $("#lookbookUpdateFrm #lookbook_sub_category_id").focus();

                }
            });
        }
    </script>
@endsection
