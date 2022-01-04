@extends('layouts.admin_header')

@section('content')
    <script>
        $(document).ready(function(){

            $("#btn_move_write").on("click", function(){
                location.href = '/admin/shop/product_write';
            });
        });
    </script>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">상품 카테고리 설정</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">상품 등록</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                        <col style="">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>상품 코드</th>
                        <th>상품명</th>
                        <th>상품 메인 이미지</th>
                        <th>메인 카테고리명</th>
                        <th>서브 카테고리명</th>
                        <th>브랜드명</th>
                        <th>상품 가격</th>
                        <th>메인 노출 여부</th>
                        <th style="border-right-color: transparent;">등록일</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$shop_product->shop_product_id}}</td>
                            <td>{{$shop_product->product_code}}</td>
                            <td>{{$shop_product->product_name}}</td>
                            <td>{{$shop_product->product_image_main}}</td>
                            <td>{{$shop_product->main_category_name}}</td>
                            <td>{{$shop_product->sub_category_name}}</td>
                            <td>{{$shop_product->brand_name}}</td>
                            <td>{{$shop_product->product_price}}</td>
                            <td>@if($shop_product->product_main_yn === 'N') X @else O @endif</td>
                            <td>{{$shop_product->created_at}}</td>
                            <td>
                                @if($shop_product->del_yn === "N")
                                    <button class="btn btn-info btn_update_modal" data-id="{{$shop_product->shop_sub_category_id}}" data-toggle="modal" data-target="#admin_update_modal">수정</button>
                                    <button class="btn btn-danger btn_delete_admin" data-id="{{$shop_product->shop_sub_category_id}}">삭제</button>
                                @else
                                    <button class="btn btn-outline-dark btn_delete_cancel_admin" data-id="{{$shop_product->shop_sub_category_id}}">삭제취소</button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div align="center">
                    <button type="button" class="btn btn-primary" id="btn_write">등록</button>
                    <button type="button" class="btn btn-outline-dark" onclick="history.back();">목록</button>
                </div>
            </div>
        </div>
    </div>
@endsection
