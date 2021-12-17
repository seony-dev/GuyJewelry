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
                <h4 class="font-alt mb-0" style="text-align: center; font-weight: 800; font-size: 22px;">예시 ) 마이페이지 > 판매자 신청 현황</h4>
                <hr class="divider-w2 mt-10 mb-20">
                <style>
                    td {
                        text-align: center;
                    }

                    a {
                        color: #337ab7;
                        text-decoration: underline;
                    }
                </style>
                <form class="noticeFrm" role="form">
{{--                    <table class="table table-bordered">--}}
{{--                        <colgroup>--}}
{{--                            <col style="width:10%">--}}
{{--                            <col style="width:5%">--}}
{{--                            <col style="width:25%">--}}
{{--                            <col style="width:25%">--}}
{{--                            <col style="width:25%">--}}
{{--                            <col style="width:5%">--}}
{{--                        </colgroup>--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th>목록</th>--}}
{{--                                <th>NO.</th>--}}
{{--                                <th>진행상태</th>--}}
{{--                                <th>거래정보</th>--}}
{{--                                <th>시계정보</th>--}}
{{--                                <th></th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>개인판매</td>--}}
{{--                                <td>123</td>--}}
{{--                                <td><span style="color: red;">거래진행</span>--}}
{{--                                    <button class="btn btn-danger" style="padding: 5px 20px;">예약</button>--}}
{{--                                    <button class="btn" style="padding: 5px 20px;">파기</button>--}}
{{--                                </td>--}}
{{--                                <td>홍길동 010-0000-1111</td>--}}
{{--                                <td>롤렉스 데이저스트 112233</td>--}}
{{--                                <td>--}}
{{--                                    <button class="btn" style="font-size: 13px; padding: 5px 20px; letter-spacing: inherit;">상세정보 바로가기</button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>개인판매</td>--}}
{{--                                <td>85</td>--}}
{{--                                <td>--}}
{{--                                    <span style="color: red;">거래진행</span>--}}
{{--                                    <button class="btn btn-warning" style="padding: 5px 20px;">변경</button>--}}
{{--                                    <button class="btn" style="padding: 5px 20px;">파기</button>--}}
{{--                                </td>--}}
{{--                                <td>김길동 010-1234-5678</td>--}}
{{--                                <td>파텍필립 노틸러스 10045465445</td>--}}
{{--                                <td><button class="btn" style="font-size: 13px; padding: 5px 20px;     letter-spacing: inherit;">상세정보 바로가기</button></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>개인판매</td>--}}
{{--                                <td>545</td>--}}
{{--                                <td><span style="color: red;">거래진행</span>--}}
{{--                                    <br>--}}
{{--                                    <button class="btn btn-danger" style="padding: 5px 20px;">예약</button>--}}
{{--                                    <button class="btn" style="padding: 5px 20px;">파기</button>--}}
{{--                                </td>--}}
{{--                                <td>홍길동 010-0000-1111</td>--}}
{{--                                <td>롤렉스 데이저스트 112233</td>--}}
{{--                                <td>--}}
{{--                                    <button class="btn" style="font-size: 13px; padding: 5px 20px; letter-spacing: inherit;">상세정보 바로가기</button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>개인판매</td>--}}
{{--                                <td>1045</td>--}}
{{--                                <td>--}}
{{--                                    <span style="color: red;">거래진행</span>--}}
{{--                                    <br>--}}
{{--                                    <button class="btn btn-warning" style="padding: 5px 20px;">변경</button>--}}
{{--                                    <button class="btn" style="padding: 5px 20px;">파기</button>--}}
{{--                                </td>--}}
{{--                                <td>김길동 010-1234-5678</td>--}}
{{--                                <td>파텍필립 노틸러스 10045465445</td>--}}
{{--                                <td><button class="btn" style="font-size: 13px; padding: 5px 20px;     letter-spacing: inherit;">상세정보 바로가기</button></td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width:10%">
                            <col style="width:5%">
                            <col style="width:10%">
                            <col style="width:25%">
                            <col style="width:25%">
                            <col style="width:20%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>목록</th>
                            <th>NO.</th>
                            <th>진행상태</th>
                            <th>거래정보</th>
                            <th>시계정보</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>개인판매</td>
                                <td>123</td>
                                <td><span style="color: red;">거래진행</span>

                                </td>
                                <td>홍길동 010-0000-1111</td>
                                <td><a href="">롤렉스 데이저스트 112233</a></td>
                                <td>
                                    <button class="btn btn-danger" style="padding: 5px 20px;">예약</button>
                                    <button class="btn" style="padding: 5px 20px;">거래취소</button>
                                </td>
                            </tr>
                            <tr>
                                <td>개인판매</td>
                                <td>85</td>
                                <td>
                                    <span style="color: red;">거래진행</span>
                                </td>
                                <td>김길동 010-1234-5678</td>
                                <td><a href="">파텍필립 노틸러스 10045465445</a></td>
                                <td>
                                    <button class="btn btn-warning" style="padding: 5px 20px;">변경</button>
                                    <button class="btn" style="padding: 5px 20px;">거래취소</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </section>
@endsection
