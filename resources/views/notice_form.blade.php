@extends('layouts.header')

@section('content')

    <link rel="stylesheet" href="/css/summerNote/summernote-lite.css">
    <style>
        table th {
            text-align: center;
            font-size : 15px;
        }
    </style>
    <script src="/js/summerNote/summernote-lite.js"></script>
    <script src="/js/summerNote/lang/summernote-ko-KR.js"></script>

    <script>
        $(document).ready(function() {
            $('#notice_contents').summernote({
                height: 300,                 // 에디터 높이
                minHeight: null,             // 최소 높이
                maxHeight: null,             // 최대 높이
                focus: true,                  // 에디터 로딩후 포커스를 맞출지 여부
                lang: "ko-KR",					// 한글 설정
                placeholder: '최대 2048자까지 쓸 수 있습니다',	//placeholder 설정
                callbacks: {	//여기 부분이 이미지를 첨부하는 부분
                    onImageUpload : function(files) {
                        uploadSummernoteImageFile(files[0], this);
                    },
                    onPaste: function (e) {
                        var clipboardData = e.originalEvent.clipboardData;
                        if (clipboardData && clipboardData.items && clipboardData.items.length) {
                            var item = clipboardData.items[0];
                            if (item.kind === 'file' && item.type.indexOf('image/') !== -1) {
                                e.preventDefault();
                            }
                        }
                    }
                }
            });

            /**
             * 이미지 파일 업로드
             */
            function uploadSummernoteImageFile(file, editor) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : data,
                    type : "POST",
                    url : "/notice/save_editor_images",
                    contentType : false,
                    processData : false,
                    success : function(data) {
                        //항상 업로드된 파일의 url이 있어야 한다.
                        console.log(data);
                        $(editor).summernote('insertImage', data);
                    }
                });
            }

            $("#btn_write_notice").on("click", function (){

                var noticeFrm = $('#noticeFrm')[0];
                var formData = new FormData(noticeFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/notice/write_action"
                    , data:formData
                    , cache:false
                    , contentType:false
                    , processData:false
                    , enctype:'multipart/formDataData'
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("정상 등록 됐습니다!");
                            location.href = "/notice";
                        }
                    }
                });
            });
        });
    </script>

    <section class="module bg-dark-30 about-page-header" data-background="/images/shop/watchring_main.png">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">NOTICE</h2>
                <div class="module-subtitle font-serif">공지사항</div>
            </div>
        </div>
    </div>
</section>
<section class="module">
    <div class="container">
        <div class="row">
            <h4 class="font-alt mb-0" style="text-align: center; font-weight: 800; font-size: 22px;">공지사항</h4>
            <hr class="divider-w2 mt-10 mb-20">
            <form id="noticeFrm" role="form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <table class="table table-bordered">
                    @if ($state == 'detail' || $state == 'update')
                        <tr>
                            <th>NO</th>
                            <td>
                                @if($state == 'detail')
                                    <input type="hidden" name="notice_id" value="{{$notice_detail->notice_id}}"/>
                                    <span>{{$notice_detail->notice_id}}</span>
                                @elseif($state == 'update')
                                    <input type="hidden" name="notice_id" value="{{$notice_detail->notice_id}}"/>
                                    <span>{{$notice_detail->notice_id}}</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th>작성자</th>
                        <td>
                            @if($state == 'detail')
                                <input type="hidden" name="user_id" value="{{$notice_detail->user_id}}"/>
                                <input class="form-control input-lg" name="member_name" type="text" placeholder="" value="{{$notice_detail->member_name}}"/>
                            @elseif($state == 'update')
                                <input class="form-control input-lg" name="member_name" type="text" placeholder="" readonly="" value="{{$notice_detail->member_name}}"/>
                            @else
                                <input type="hidden" name="user_id" value="{{$admin_id}}"/>
                                <input class="form-control input-lg" name="member_name" type="text" placeholder="" readonly="" value="{{$admin_name->member_name}}"/>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td>
                            <input class="form-control input-lg" name="notice_title" type="text" id="notice_title" name="notice_title" placeholder="" value="@if(!empty($notice_detail)) {{$notice_detail->notice_title}} @endif"/>
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            @if ($state == 'detail')

                            @endif
                            <textarea class="form-control" id="notice_contents" name="notice_contents" rows="10" cols="100" placeholder="내용을 입력해주세요">@if(!empty($notice_detail)) {{$notice_detail->notice_contents}}@endif</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>첨부파일</th>
                        <td><input type="file" id="notice_file" name="notice_file" />@if(!empty($notice_files)) {{$notice_detail->notice_files}}@endif</td>
                    </tr>
                </table>
                <div align="center">
                    <button type="button" class="btn btn-default btn-round" onclick="location.href='/notice'">목록</button>
                @if( $is_admin == 'Y' && $state == 'detail')
                    <button type="button" class="btn btn-success btn-round" id="btn_view_update_notice">수정</button>
                    <button type="button" class="btn btn-danger btn-round" id="btn_delete_notice">삭제</button>
                @elseif($state == 'write')
                    <button type="button" class="btn btn-primary btn-round" id="btn_write_notice">작성 완료</button>
                @else
                    <button type="button" class="btn btn-info btn-round" id="btn_update_notice">수정 완료</button>
                @endif
            </div>
            </form>
        </div>
    </div>
</section>
@endsection
