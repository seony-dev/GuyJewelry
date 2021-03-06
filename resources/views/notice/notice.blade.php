@extends('layouts.header')

@section('content')
{{--    <section class="module bg-dark-60 about-page-header" data-background="/images/shop/watchring_main.png">--}}

    <style>
        table th,td {
            text-align: center;
        }
    </style>
    <section class="module bg-dark-60 about-page-header" style="background-image:url('/images/shop/watchring_main.png');">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">NOTICE</h2>
                    <div class="module-subtitle font-serif">공지사항</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <form class="row" id="noticeSearchFrm">
                <div class="col-sm-4 mb-sm-20">
                    <select name="search_subject" class="form-control">
                        <option value="all" selected="selected">제목+내용</option>
                        <option value="title">제목</option>
                        <option value="contents">내용</option>
                    </select>
                </div>
                <div class="col-sm-5 mb-sm-20 form-group">
                    <div class="search-box">
                        <input type="text" name="search_word" class="form-control input-lg" style="border-radius: 2px; height: 33.7px;" placeholder="검색어를 입력해주세요.">
                        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-border-d btn-circle btn-block" type="submit">
                        <i class="fa fa-bullhorn"></i> 검색
                    </button>
                </div>
            </form>
        </div>
    </section>
    <section>
        <div style="width: 80%; margin-left: 10%; margin-bottom: 15%;" >
            <table class="table table-hover">
                <colgroup>
                    <col style="width: 10%">
                    <col style="width: 40%">
                    <col style="width: 20%">
                    <col style="width: 10%">
                    <col style="width: 20%">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>조회수</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($notice_list) > 0 )
                        @foreach($notice_list as $notice)
                            <tr onclick="fn_move_notice_detail('{{$notice->notice_id}}');" style="cursor: pointer;">
                                <td>{{$notice->notice_id}}</td>
                                <td>{{$notice->notice_title}}</td>
                                <td>{{$notice->member_name}}</td>
                                <td>{{$notice->notice_views}}</td>
                                <td>{{date('Y.m.d', strtotime($notice->created_at))}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td align="center" colspan="5">등록된 공지사항이 없습니다.</td>
                        </tr>
                    @endif

            </table>
            <div align="center">
                {{$notice_list->links()}}
            </div>
            @if ( session('admin_session') )
                <div align="right">
                    <button class="btn btn-d btn-round" id="notice_write">글쓰기</button>
                </div>
            @endif
        </div>
    </section>

    <script>
        $(document).ready(function(){

            //글 작성 버튼 클릭 시
           $("#notice_write").on("click", function(){
               // location.href = "/notice_write";
               var noticeFrm = document.createElement('form');

               var objs;

               objs = document.createElement('input');
               objs.setAttribute('type', 'hidden');
               objs.setAttribute('name', 'state');
               objs.setAttribute('value', 'write');
               noticeFrm.appendChild(objs);

               objs = document.createElement('input');
               objs.setAttribute('type', 'hidden');
               objs.setAttribute('name', '_token');
               objs.setAttribute('value', '{{ csrf_token() }}');
               noticeFrm.appendChild(objs);

               noticeFrm.setAttribute('method', 'post');
               noticeFrm.setAttribute('action', "/notice_write");

               document.body.appendChild(noticeFrm);
               noticeFrm.submit();

           });
        });

        //상세 페이지 이동
        function fn_move_notice_detail(notice_id){
            var noticeFrm = document.createElement('form');

            var objs;
            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', 'notice_id');
            objs.setAttribute('value', notice_id);
            noticeFrm.appendChild(objs);

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', 'state');
            objs.setAttribute('value', 'detail');
            noticeFrm.appendChild(objs);

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', '_token');
            objs.setAttribute('value', '{{ csrf_token() }}');
            noticeFrm.appendChild(objs);

            noticeFrm.setAttribute('method', 'post');
            noticeFrm.setAttribute('action', "/notice_detail");

            document.body.appendChild(noticeFrm);
            noticeFrm.submit();

            //조회 수 증가
            fn_add_views(notice_id);
        }

        //해당 글 조회 수 증가
        function fn_add_views(notice_id) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/notice/add_views"
                , data: {
                    notice_id : notice_id
                }
                , type:'POST'
                , success:function(result) {
                    if(result == "success") {
                        console.log("OK");
                    }
                }
                , error:function() {
                    alert("에러가 발생했습니다. 다시 시도해 주세요");
                }
            });
        }
    </script>
@endsection
