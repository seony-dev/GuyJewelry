@extends('layouts.header')

@section('content')
    {{--    <section class="module bg-dark-60 about-page-header" data-background="/images/shop/watchring_main.png">--}}

    <style>
        table th,td {
            text-align: center;
        }

        .post-name {
            color: #111;
            font-size: 14px;
        }
    </style>
    <section class="module bg-dark-60 about-page-header" style="background-image:url('/images/shop/watchring_main.png');">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">GUY NEWS</h2>
                    <div class="module-subtitle font-serif">가이뉴스</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <form class="row" id="guyNewsSearchFrm">
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
    <section class="module-small">
        <div class="container">
            <div class="row post-masonry post-columns">
                @if ( count($guy_news_list) > 0 )
                    @foreach($guy_news_list as $guy_news)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="post">
                                <div class="post-thumbnail">
                                    <a href="javascript:fn_move_guy_news_detail('{{$guy_news->guy_news_id}}');">
                                        <img src="{{$guy_news->guy_news_thumbnail}}" alt="Blog-post Thumbnail"/>
                                    </a>
                                </div>
                                <div class="post-header font-alt">
                                    <h2 class="post-title">
                                        <a href="javascript:fn_move_guy_news_detail('{{$guy_news->guy_news_id}}');">{{$guy_news->guy_news_title}}</a>
                                    </h2>
                                    <div class="post-meta">By&nbsp;<span class="post-name">{{$guy_news->member_name}}</span></div>
                                </div>
                                <div class="post-entry">
                                    <p>{{date('Y.m.d', strtotime($guy_news->created_at))}}</p>
                                </div>
                                <div class="post-more"><a class="more-link" href="javascript:fn_move_guy_news_detail('{{$guy_news->guy_news_id}}');">Read more</a></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td align="center" colspan="5">등록된 뉴스가 없습니다.</td>
                    </tr>
                @endif
            </div>
            <div align="center">
                {{$guy_news_list->links()}}
            </div>
            @if ( session('admin_session') )
                <div align="right">
                    <button class="btn btn-d btn-round" id="guy_news_write">글쓰기</button>
                </div>
            @endif
        </div>
    </section>

    <script>
        $(document).ready(function(){

            //글 작성 버튼 클릭 시
            $("#guy_news_write").on("click", function(){
                // location.href = "/guy_news_write";
                var guy_newsFrm = document.createElement('form');

                var objs;

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', 'state');
                objs.setAttribute('value', 'write');
                guy_newsFrm.appendChild(objs);

                objs = document.createElement('input');
                objs.setAttribute('type', 'hidden');
                objs.setAttribute('name', '_token');
                objs.setAttribute('value', '{{ csrf_token() }}');
                guy_newsFrm.appendChild(objs);

                guy_newsFrm.setAttribute('method', 'post');
                guy_newsFrm.setAttribute('action', "/guy_news_write");

                document.body.appendChild(guy_newsFrm);
                guy_newsFrm.submit();

            });
        });

        //상세 페이지 이동
        function fn_move_guy_news_detail(guy_news_id){
            var guy_newsFrm = document.createElement('form');

            var objs;
            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', 'guy_news_id');
            objs.setAttribute('value', guy_news_id);
            guy_newsFrm.appendChild(objs);

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', 'state');
            objs.setAttribute('value', 'detail');
            guy_newsFrm.appendChild(objs);

            objs = document.createElement('input');
            objs.setAttribute('type', 'hidden');
            objs.setAttribute('name', '_token');
            objs.setAttribute('value', '{{ csrf_token() }}');
            guy_newsFrm.appendChild(objs);

            guy_newsFrm.setAttribute('method', 'post');
            guy_newsFrm.setAttribute('action', "/guy_news_detail");

            document.body.appendChild(guy_newsFrm);
            guy_newsFrm.submit();

            //조회 수 증가
            fn_add_views(guy_news_id);
        }

        //해당 글 조회 수 증가
        function fn_add_views(guy_news_id) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/guy_news/add_views"
                , data: {
                    guy_news_id : guy_news_id
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
