@extends('layouts.header')

@section('content')
{{--    <section class="module bg-dark-60 about-page-header" data-background="/images/shop/watchring_main.png">--}}
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
            <form class="row">
                <div class="col-sm-4 mb-sm-20">
                    <select class="form-control">
                        <option selected="selected">제목+내용</option>
                        <option>제목</option>
                        <option>내용</option>
                    </select>
                </div>
                <div class="col-sm-5 mb-sm-20 form-group">
                    <div class="search-box">
                        <input type="text" class="form-control input-lg" style="border-radius: 2px; height: 33.7px;" placeholder="검색어를 입력해주세요.">
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
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">제목</th>
                        <th scope="col">작성자</th>
                        <th scope="col">등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="center" colspan="4">등록된 공지사항이 없습니다.</td>
                    </tr>
            </table>
            <div align="right">
                <p>(후에 관리자만 글쓰기 가능하도록)</p>
                <button class="btn btn-d btn-round" id="notice_write">글쓰기</button>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
           $("#notice_write").on("click", function(){
               location.href = "/notice_write";
           });
        });
    </script>
@endsection
