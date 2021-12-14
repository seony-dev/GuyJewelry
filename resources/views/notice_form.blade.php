@extends('layouts.header')

@section('content')
    <style>
        table th {
            text-align: center;
            font-size : 15px;
        }
    </style>
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
            <form class="noticeFrm" role="form">
                <table class="table table-bordered">
                    <tr>
                        <th>NO</th>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>작성자</th>
                        <td>
                            <input class="form-control input-lg" type="text" placeholder="관리자" readonly="" value="관리자"/>
                        </td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td>
                            <input class="form-control input-lg" type="text" placeholder="" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            <textarea class="form-control" rows="7" placeholder="내용을 입력해주세요"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>첨부파일</th>
                        <td><input type="file" /></td>
                    </tr>
                </table>
                <div align="center">
                    <button class="btn btn-info btn-round">작성 완료</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
