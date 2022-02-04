@extends('layouts.admin_header')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Contact</h1>
    {{--    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.--}}
    {{--        For more information about DataTables, please visit the <a target="_blank"--}}
    {{--                                                                   href="https://datatables.net">official DataTables documentation</a>.</p>--}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">간편상담 관리</h6>
        </div>
        <div class="card-body">
            <div align="right" style="margin-bottom: 15px;">
                <button type="button" class="btn btn-success" id="btn_insert_modal" data-toggle="modal" data-target="#inquiry_insert_modal">등록</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col style="width: 10%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>신청자 성함</th>
                        <th>신청자 번호</th>
                        <th>관리자 확인 여부</th>
                        <th style="border-right-color: transparent;">등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(is_null($inquiry_list) ? 0 : count($inquiry_list) > 0)
                        @foreach($inquiry_list as $inquiry)
                            <tr class="inquiry_tr" data-toggle="modal" data-target="#inquiry_detail_modal" style="cursor: pointer;" data-id="{{$inquiry->id}}">
                                <td>
                                    {{$inquiry->id}}
                                </td>
                                <td>
                                    {{$inquiry->applicant_name}}
                                </td>
                                <td>
                                    {{$inquiry->applicant_phone}}
                                </td>
                                <td>
                                    @if($inquiry->admin_check_yn == "N")
                                        <span>미확인</span>
                                    @else
                                        <span>확인</span>
                                    @endif
                                </td>
                                <td>{{date('Y.m.d', strtotime($inquiry->created_at))}}</td>
                                <td>
                                    @if($inquiry->del_yn == "N")
{{--                                        @if($inquiry->admin_check_yn == "N")--}}
{{--                                        <button class="btn btn-outline-dark btn_check_inquiry" data-id="{{$inquiry->id}}">관리자 확인</button>--}}
{{--                                        @endif--}}
                                        <button class="btn btn-danger btn_delete_inquiry" data-id="{{$inquiry->id}}">삭제</button>
                                    @else
                                        <button class="btn btn-outline-danger btn_delete_cancel_inquiry" data-id="{{$inquiry->id}}">삭제취소</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr align="center">
                            <td colspan="7">등록된 간편상담이 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(is_null($inquiry_list) ? 0 : count($inquiry_list) > 0)
                    <div align="center">
                        {{$inquiry_list->links()}}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="inquiry_detail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">간편상담 상세</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="inquiryDetailFrm">
                        <input type="hidden" class="lookbook_id" name="lookbook_id" id="lookbook_id">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 80%;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>NO</th>
                                    <td>
                                        <span id="inquiry_no"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>등록일</th>
                                    <td>
                                        <span id="inquiry_created_at"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>신청자 성함</th>
                                    <td>
                                        <span id="inquiry_applicant_name"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>신청자 번호</th>
                                    <td>
                                        <span id="inquiry_applicant_phone"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>간편상담 내용</th>
                                    <td>
                                        <textarea class="form-control input-group" name="inquiry_contents" id="inquiry_contents" cols="30" rows="10" readonly></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>관리자 <br>확인 여부</th>
                                    <td>
                                        <span id="inquiry_admin_check_yn"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-outline-dark float-right btn_check_inquiry" data-id="{{$inquiry->id}}">관리자 확인</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function(){

            $(".inquiry_tr").on("click", function(){

                $("#inquiryDetailFrm #inquiry_no").text('');
                $("#inquiryDetailFrm #inquiry_created_at").text('');
                $("#inquiryDetailFrm #inquiry_applicant_name").text('');
                $("#inquiryDetailFrm #inquiry_applicant_phone").text('');
                $("#inquiryDetailFrm #inquiry_contents").val('');
                $("#inquiryDetailFrm #inquiry_admin_check_yn").text('');

                var inquiry_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , type:'POST'
                    , url : "/admin/contact/inquiry_info"
                    , data: {
                        inquiry_id : inquiry_id
                    }
                    , success:function(result) {
                        $("#inquiryDetailFrm #inquiry_no").text(result.id);
                        $("#inquiryDetailFrm #inquiry_created_at").text(result.created_at);
                        $("#inquiryDetailFrm #inquiry_applicant_name").text(result.applicant_name);
                        $("#inquiryDetailFrm #inquiry_applicant_phone").text(result.applicant_phone);
                        $("#inquiryDetailFrm #inquiry_contents").val(result.inquiry_contents);
                        result.admin_check_yn == 'N' ? $(".btn_check_inquiry").show()
                            : $(".btn_check_inquiry").hide()
                        result.admin_check_yn == 'N' ? $("#inquiryDetailFrm #inquiry_admin_check_yn").text('미확인')
                            : $("#inquiryDetailFrm #inquiry_admin_check_yn").text('확인')

                    }
                });
            });

            $(".btn_check_inquiry").on("click", function(){

                var inquiry_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/contact/inquiry_check_action"
                    , data: {
                        inquiry_id : inquiry_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert('해당 상담 내용이 확인 처리되었습니다.');
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_inquiry").on("click", function(){

                var inquiry_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/contact/inquiry_delete_action"
                    , data: {
                        inquiry_id : inquiry_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert('해당 상담이 삭제되었습니다.');
                            location.reload();
                        }
                    }
                });
            });

            $(".btn_delete_cancel_inquiry").on("click", function(){

                var inquiry_id = $(this).attr("data-id");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/admin/contact/inquiry_delete_action"
                    , data: {
                        inquiry_id : inquiry_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert('해당 상담이 삭제 취소되었습니다.');
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
