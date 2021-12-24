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
            <h6 class="m-0 font-weight-bold text-primary">서브 카테고리</h6>
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
                        <col style="width: 20%;">
                        <col style="width: 30%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>메인 카테고리명</th>
                        <th>카테고리명</th>
                        <th>카테고리 이미지</th>
                        <th>등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($lookbook_sub_category_list))
                        @foreach($lookbook_sub_category_list as $lookbook_sub_category)
                            <tr>
                                <td>
                                    {{$lookbook_sub_category->lookbook_sub_category_id}}
                                </td>
                                <td>
                                    {{$lookbook_sub_category->lookbook_main_category_name}}
                                </td>
                                <td>{{$lookbook_sub_category->lookbook_sub_category_name}}</td>
                                <td>
                                    <img src="{{$lookbook_sub_category->lookbook_sub_category_image}}" alt="" style="width: 300px;">
                                    <span>{{$lookbook_sub_category->lookbook_sub_category_image}}</span>
                                </td>
                                <td>{{$lookbook_sub_category->created_at}}</td>
                                <td>
                                    @if($lookbook_sub_category->del_yn == "N")
                                        <button class="btn btn-danger btn_delete_main_category" data-id="{{$lookbook_sub_category->lookbook_sub_category_id}}">삭제</button>
                                        <button class="btn btn-info btn_update_modal" data-id="{{$lookbook_sub_category->lookbook_sub_category_id}}" data-toggle="modal" data-target="#lookbook_update_modal">수정</button>
                                    @else
                                        <button class="btn btn-outline-dark">삭제취소</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr align="center">
                            <td colspan="6">등록된 카테고리가 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div align="center">
                    {{$lookbook_sub_category_list->links()}}
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="lookbook_insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">서브 카테고리 등록</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryFrm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>카테고리명</th>
                                <td>
                                    <input type="text" class="form-control input-group" id="lookbook_main_category_name" name="lookbook_main_category_name">
                                </td>
                            </tr>
                            <tr>
                                <th>카테고리 이미지</th>
                                <td>
                                    <input type="file" id="lookbook_main_category_image" name="lookbook_main_category_image" style="margin-bottom: 20px;">
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
                        <button type="button" class="btn btn-primary float-right"  id="btn_insert_main_category">등록</button>
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
                    <form id="update_categoryFrm">
                        <input type="hidden" class="lookbook_sub_category_id" name="lookbook_sub_category_id">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>카테고리명</th>
                                <td>
                                    <input type="text" class="form-control input-group update_name" id="lookbook_sub_category_name" name="lookbook_sub_category_name" value="">
                                </td>
                            </tr>
                            <tr>
                                <th>카테고리 이미지</th>
                                <td>
                                    <input type="file" class="update_category_img" id="lookbook_sub_category_image" name="lookbook_sub_category_image" style="margin-bottom: 20px;">
                                    <img src="" alt="" id="preview" style="max-width: 300px;" class="update_img">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary float-right btn_update_sub_category">수정</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#lookbook_sub_category_image').change(function(){
                setImageFromFile(this, '#preview');
            });


            $("#btn_insert_sub_category").on("click", function(){

                var categoryFrm = $("#categoryFrm")[0];
                var formData = new FormData(categoryFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/main_category_write_action"
                    , data:formData
                    , cache:false
                    , contentType:false
                    , processData:false
                    , enctype:'multipart/formDataData'
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("정상 등록 됐습니다!");
                            location.reload();
                        }
                    }
                });
            });


            $(".btn_delete_sub_category").on("click", function(){

                var lookbook_sub_category_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/lookbook/sub_category_delete_action"
                    , data: {
                        lookbook_sub_category_id : lookbook_sub_category_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 카테고리가 삭제 되었습니다!");
                            location.reload();
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

        $("#btn_insert_sub_category").on("click", function(){

            var categoryFrm = $("#categoryFrm")[0];
            var formData = new FormData(categoryFrm);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/sub_category_write_action"
                , data:formData
                , cache:false
                , contentType:false
                , processData:false
                , enctype:'multipart/formDataData'
                , type:'POST'
                , success:function(result) {
                    if(result == "success") {
                        alert("정상 등록 됐습니다!");
                        location.reload();
                    }
                }
            });
        });

        $(".btn_update_modal").on("click", function(){

            $(".update_name").val('');
            $(".update_img").attr("src", '');

            var lookbook_sub_category_id = $(this).attr("data-id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , type:'POST'
                , url : '/admin/lookbook/sub_category_info'
                , data: {
                    lookbook_sub_category_id : lookbook_sub_category_id
                }
                , success:function(result) {

                    $(".update_name").val(result.lookbook_sub_category_name);
                    $(".update_img").attr("src", '/'+result.lookbook_sub_category_image);
                    $(".lookbook_sub_category_id").val(result.id);
                }
            });
        });

        $('.update_category_img').change(function(){
            setImageFromFile(this, '.update_img');
        });

        $('.btn_update_sub_category').on("click", function(){

            var update_categoryFrm = $('#update_categoryFrm')[0];
            var formData = new FormData(update_categoryFrm);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/lookbook/sub_category_update_action"
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


    </script>
@endsection
