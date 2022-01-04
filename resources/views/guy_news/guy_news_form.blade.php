@extends('layouts.header')

@section('content')

    <link rel="stylesheet" href="/css/summerNote/summernote-lite.css">
    <style>
        table th {
            text-align: center;
            font-size : 15px;
            width: 10%;
        }

        .detail {
            border: none;
            background-color : #FFF !important;
        }

        .detail_update {
            border: 1px solid #EAEAEA;
        }

        .guy-news-detail-form {
            font-family: "Roboto Condensed", sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size : 15px;
            transition: all 0.4s ease-in-out 0s;
            padding: 10px 22px !important;
        }

        th {
            vertical-align: middle !important;
        }

        .guy-news-link {
            cursor: pointer !important;
            color: #1b6d85;
            font-weight: bold;
        }
    </style>
    <script src="/js/summerNote/summernote-lite.js"></script>
    <script src="/js/summerNote/lang/summernote-ko-KR.js"></script>

    <script>
        $(document).ready(function() {

            $(".thumbnail_tr").hide();

            @if($state !== "detail")

                $(".thumbnail_tr").show();

                $('#guy_news_contents').summernote({
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
            @endif

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
                    url : "/guy_news/save_editor_images",
                    contentType : false,
                    processData : false,
                    success : function(data) {
                        //항상 업로드된 파일의 url이 있어야 한다.
                        console.log(data);
                        $(editor).summernote('insertImage', data);
                    }
                });
            }

            $("#btn_write_guy_news").on("click", function (){

                var guyNewsFrm = $('#guyNewsFrm')[0];
                var formData = new FormData(guyNewsFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/guy_news/write_action"
                    , data:formData
                    , cache:false
                    , contentType:false
                    , processData:false
                    , enctype:'multipart/formDataData'
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("정상 등록 됐습니다!");
                            location.href = "/guy_news";
                        }
                    }
                });
            });

            $("#btn_delete_guy_news").on("click", function(){

                var guy_news_id = $("#guy_news_id").val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/guy_news/delete_action"
                    , data: {
                        guy_news_id : guy_news_id
                    }
                    , type:'POST'
                    , success:function(result) {
                        if(result == "success") {
                            alert("해당 글이 삭제 되었습니다!");
                            location.href = "/guy_news";
                        }
                    }
                });
            });

            //수정 버튼 클릭 시
            $("#btn_view_update_guy_news").on("click", function (){

                $(".thumbnail_tr").show();

                $("#btn_view_update_guy_news").hide();
                $("#btn_update_guy_news").show();
                $("#btn_delete_guy_news").hide();

                $("#guy_news_title").prop("readonly", false);
                $("#guy_news_title").attr("display", "block");
                $("#guy_news_title").addClass("detail_update");

                $("#guy_news_link").prop("readonly", false);
                $("#guy_news_link").attr("display", "block");
                $("#guy_news_link").addClass("detail_update");
                $("#guy_news_link").removeClass("guy-news-link");

                $(".detail-file").show();
                $("#guy_news_file_label").show();
                $("#guy_news_detail_file").hide();

                $('#detail_guy_news_content').hide();
                // $('#guy_news_contents').show();
                $('#guy_news_contents').summernote({
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
            });

            $("#btn_update_guy_news").on("click", function(){

                // var guy_news_id = $("#guy_news_id").val();

                var guyNewsFrm = $('#guyNewsFrm')[0];
                var formData = new FormData(guyNewsFrm);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url : "/guy_news/update_action"
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

        function fn_download_file(file_path) {

            var guyNewsFrm = document.createElement('form');

            var objs;

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', 'guy_news_file');
            objs.setAttribute('value', file_path);
            guyNewsFrm.appendChild(objs);

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', '_token');
            objs.setAttribute('value', '{{ csrf_token() }}');
            guyNewsFrm.appendChild(objs);

            guyNewsFrm.setAttribute('method', 'post');
            guyNewsFrm.setAttribute('action', "/guy_news/download_file");

            document.body.appendChild(guyNewsFrm);
            guyNewsFrm.submit();

        }
    </script>

    <section class="module bg-dark-30 about-page-header" data-background="/images/shop/watchring_main.png">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">GUY NEWS</h2>
                    <div class="module-subtitle font-serif">가이뉴스</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <h4 class="font-alt mb-0" style="text-align: center; font-weight: 800; font-size: 22px;">가이뉴스</h4>
                <hr class="divider-w2 mt-10 mb-20">
                <form id="guyNewsFrm" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <table class="table table-bordered">
                        @if ($state == 'detail' || $state == 'update')
                            <tr>
                                <th>NO</th>
                                <td>
                                    <input type="hidden" id="guy_news_id" name="guy_news_id" value="{{$guy_news_detail->guy_news_id}}"/>
                                    <div class="guy-news-detail-form">
                                        <span>{{$guy_news_detail->guy_news_id}}</span>
                                    </div>
                                </td>
                                @if($state == 'detail')
                                    <th rowspan="1">조회수</th>
                                    <td rowspan="1">
                                        <div class="guy-news-detail-form">
                                            <span>{{$guy_news_detail->guy_news_views}}</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endif
                        <tr>
                            <th>작성자</th>
                            <td>
                                @if($state == 'detail')
                                    <div class="guy-news-detail-form">
                                        <span id="member_name">{{$guy_news_detail->member_name}}</span>
                                    </div>
                                @elseif($state == 'write')
                                    <input class="form-control input-lg" id="member_name" name="member_name" type="text" placeholder="" readonly="" value="{{$admin_name}}"/>
                                @endif
                                <input type="hidden" id="user_id" name="user_id" value="@if(!empty($admin_id)){{$admin_id}}@endif"/>
                            </td>
                            @if($state == 'detail')
                                <th>등록일</th>
                                <td>
                                    <div class="guy-news-detail-form">
                                        <span>{{date('Y.m.d', strtotime($guy_news_detail->created_at))}}</span>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td @if($state == 'detail') colspan="3" @endif>
                                @if($state == 'detail')
                                    <input class="form-control input-lg detail" type="text" id="guy_news_title" name="guy_news_title" readonly="readonly" value="@if(!empty($guy_news_detail)) {{$guy_news_detail->guy_news_title}} @endif"/>
                                @else
                                    <input class="form-control input-lg" type="text" id="guy_news_title" name="guy_news_title" placeholder="" value="@if(!empty($guy_news_detail)) {{$guy_news_detail->guy_news_title}} @endif"/>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td @if($state == 'detail') colspan="3" @endif>
                                @if ($state == 'detail')
                                    <div class="guy_news-detail-form" id="detail_guy_news_content">@if(!empty($guy_news_detail)) {!! $guy_news_detail->guy_news_contents !!}@endif</div>
                                    <textarea class="form-control" id="guy_news_contents" name="guy_news_contents" rows="10" cols="100" style="display: none;" placeholder="내용을 입력해주세요">@if(!empty($guy_news_detail)) {{$guy_news_detail->guy_news_contents}}@endif</textarea>
                                @else
                                    <textarea class="form-control" id="guy_news_contents" name="guy_news_contents" rows="10" cols="100" placeholder="내용을 입력해주세요">@if(!empty($guy_news_detail)) {{$guy_news_detail->guy_news_contents}}@endif</textarea>
                                @endif
                            </td>
                        </tr>
                        <tr class="thumbnail_tr">
                            <th>썸네일</th>
                            <td colspan="3">
                                <input type="file" class="guy_news-detail-form detail-file" id="guy_news_thumbnail" name="guy_news_thumbnail" value=""/>
                                @if($state == 'detail')
                                    @if(!empty($guy_news_detail->guy_news_thumbnail))<img src=" {{$guy_news_detail->guy_news_thumbnail}}" alt="">@endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>링크</th>
                            <td @if($state == 'detail') colspan="3" @endif>
                                @if(!empty($guy_news_detail->guy_news_link))<a href="{{$guy_news_detail->guy_news_link}}" target='_blank'>@endif
                                    <input type="text" id="guy_news_link" name="guy_news_link" class="form-control input-lg @if($state == 'detail') detail guy-news-link @endif" @if($state == 'detail')readonly="readonly"@endif value="@if(!empty($guy_news_detail)) {{$guy_news_detail->guy_news_link}}@endif">
                                @if(!empty($guy_news_detail->guy_news_link))</a>@endif
                            </td>
                        </tr>
                        <tr>
                            <th>첨부파일</th>
                            <td @if($state == 'detail') colspan="3" @endif>
                                @if($state == 'detail')
                                    <div class="guy_news-detail-form" id="guy_news_detail_file">
                                        <a href="javascript:fn_download_file('{{$guy_news_detail->guy_news_file}}');">{{$guy_news_detail->guy_news_file_name}}</a>
                                    </div>
                                    <input type="file" class="guy_news-detail-form detail-file" id="guy_news_file" name="guy_news_file" style="display: none;" value=""/>
                                    <label class="guy_news-detail-form detail-file" for="guy_news_file" id="guy_news_file_label" style="display: none;">@if(!empty($guy_news_detail->guy_news_file_name)) {{$guy_news_detail->guy_news_file_name}}@else 기존에 등록한 파일이 없습니다.@endif</label>
                                @else
                                    <input type="file" class="guy_news-detail-form" id="guy_news_file" name="guy_news_file" value="@if(!empty($guy_news_detail->guy_news_file_name)) {{$guy_news_detail->guy_news_file_name}}@endif"/>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div align="center">
                        <button type="button" class="btn btn-default btn-round" onclick="location.href='/guy_news'">목록</button>
                        @if( $is_admin == 'Y' && $state == 'detail')
                            <button type="button" class="btn btn-success btn-round" id="btn_view_update_guy_news">수정</button>
                            <button type="button" class="btn btn-success btn-round" id="btn_update_guy_news" style="display: none;">수정 완료</button>
                            <button type="button" class="btn btn-danger btn-round" id="btn_delete_guy_news">삭제</button>
                        @elseif($state == 'write')
                            <button type="button" class="btn btn-primary btn-round" id="btn_write_guy_news">작성 완료</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
