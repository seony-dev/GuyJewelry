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
                <button type="button" class="btn btn-success" id="btn_insert_modal" data-toggle="modal" data-target="#inquiry_insert_modal">등록</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 15%;">
                        <col style="width: 20%;">
                        <col style="width: 25%;">
                        <col style="width: 15%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>신청자 성함</th>
                        <th>신청자 번호</th>
                        <th>간편상담 내용</th>
                        <th style="border-right-color: transparent;">등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(is_null($inquiry_list) ? 0 : count($inquiry_list) > 0)
                        @foreach($inquiry_list as $inquiry)
                            <tr>
                                <td>
                                    {{$inquiry->id}}
                                </td>
                                <td>
                                    {{$inquiry->applicant_name}}
                                </td>
                                <td>
                                    {{$inquiry->applicant_phone}}
                                </td>
                                <td>{{$inquiry->inquiry_contents}}</td>
                                <td>{{$inquiry->created_at}}</td>
                                <td>
                                    @if($inquiry->del_yn == "N")
                                        <button class="btn btn-danger btn_delete_inquiry" data-id="{{$inquiry->id}}">삭제</button>
                                        <button class="btn btn-info btn_update_modal" data-id="{{$inquiry->id}}" data-toggle="modal" data-target="#inquiry_update_modal">수정</button>
                                    @else
                                        <button class="btn btn-outline-dark btn_delete_cancel_inquiry" data-id="{{$inquiry->inquiry_id}}">삭제취소</button>
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
    <script>

        $(document).ready(function(){

        });
    </script>
@endsection
