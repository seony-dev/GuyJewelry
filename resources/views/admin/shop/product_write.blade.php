@extends('layouts.admin_header')

@section('content')
    <script>

        $(document).ready(function(){

            $('#shop_main_category_id').on("change", function() {

                var shop_main_category_id = $(this).val();
                fn_get_sub_category_list(shop_main_category_id);
            });

            $('#product_info').summernote({
                height: 400,                 // 에디터 높이
                minHeight: null,             // 최소 높이
                maxHeight: null,             // 최대 높이
                focus: false,                  // 에디터 로딩후 포커스를 맞출지 여부
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
                url : "/save_editor_images",
                contentType : false,
                processData : false,
                success : function(data) {
                    //항상 업로드된 파일의 url이 있어야 한다.
                    //console.log(data);

                    //추후 변경
                    var image = $('<img>').attr('src', window.location.origin + '/' + data);
                    $(editor).summernote("insertNode", image[0]);
                    //$(editor).summernote('insertImage', data);
                }
            });
        }

        function fn_get_sub_category_list(shop_main_category_id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/shop/get_sub_category_list"
                , data: {
                    shop_main_category_id : shop_main_category_id
                }
                , type:'GET'
                , success:function(result) {

                    $("#shop_sub_category_id").empty();

                    var options = $("<option value=''>:::::서브 카테고리 선택:::::</option>");
                    $("#shop_sub_category_id").append(options);

                    for(var i=0; i < result.length; i++) {
                        options = $("<option value='" + result[i].id + "'>" + result[i].shop_sub_category_name + "</option>");
                        $("#shop_sub_category_id").append(options);
                    }

                    $("#lookbook_sub_category_id").focus();

                }
            });
        }

        function inputNumberFormat(obj) {
            obj.value = comma(uncomma(obj.value));
        }

        function comma(str) {
            str = String(str);
            return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
        }

        function uncomma(str) {
            str = String(str);
            return str.replace(/[^\d]+/g, '');
        }

        function fn_insert_product(){

            var productFrm = $('#productFrm')[0];
            var formData = new FormData(productFrm);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url : "/admin/shop/product_insert_action"
                , data:formData
                , cache:false
                , contentType:false
                , processData:false
                , enctype:'multipart/formDataData'
                , type:'POST'
                , success:function(result) {
                    if(result == "success") {
                        alert("정상 등록 됐습니다!");
                        location.href = "/admin/shop/product";
                    }
                }
            });
        }
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
                <form id="productFrm">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <colgroup>
                            <col style="">
                            <col style="width: 80%;">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>모델 번호</th>
                            <td>
                                <input type="text" class="form-control input-group col-md-3" id="product_code" name="product_code" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td>
                                <input type="text" class="form-control input-group col-md-3" id="product_name" name="product_name" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>상품 정보</th>
                            <td style="text-align: left;">
                                <textarea class="form-control" id="product_info" name="product_info" rows="10" cols="100" style="display: none;" placeholder="내용을 입력해주세요"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>상품 메인 이미지</th>
                            <td>
                                <input type="file" class="form-control input-group col-md-5" id="product_image_main" name="product_image_main" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>상품 이미지 2</th>
                            <td>
                                <input type="file" class="form-control input-group col-md-5" id="product_image_sub" name="product_image_sub" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>상품 이미지 3</th>
                            <td>
                                <input type="file" class="form-control input-group col-md-5" id="product_image_third" name="product_image_third" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>메인 카테고리</th>
                            <td>
                                <select name="shop_main_category_id" id="shop_main_category_id" class="form-control col-md-3">
                                    <option value="">:::::메인 카테고리 선택:::::</option>
                                    @if(!empty($shop_main_category_list))
                                        @foreach($shop_main_category_list as $shop_main_category)
                                            <option value="{{$shop_main_category->id}}">{{$shop_main_category->shop_main_category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>서브 카테고리</th>
                            <td>
                                <select name="shop_sub_category_id" id="shop_sub_category_id" class="form-control col-md-3">
                                    <option value="">:::::서브 카테고리 선택:::::</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>브랜드</th>
                            <td>
                                <select name="shop_brand_id" id="shop_brand_id" class="form-control col-md-3">
                                    <option value="">:::::브랜드 선택:::::</option>
                                    @if(!empty($shop_brand_list))
                                        @foreach($shop_brand_list as $shop_brand)
                                            <option value="{{$shop_brand->id}}">{{$shop_brand->brand_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>상품 가격</th>
                            <td style="text-align: left;">
                                <input type="text" class="form-control col-md-3" id="product_price" name="product_price" value="" style="display: inline-block;" onkeyup="inputNumberFormat(this)"/>
                                <span>원</span>
                            </td>
                        </tr>
                        <tr>
                            <th>메인 노출 여부</th>
                            <td style="text-align: left;">
                                <input type="radio" class="col-sm-1" id="product_main_y" name="product_main_yn" value="Y"/>
                                <label for="shop_main_y">예</label>
                                <input type="radio" class="col-sm-1" id="product_main_n" name="product_main_yn" value="N"/>
                                <label for="shop_main_n">아니오</label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <div align="center">
                    <button type="button" class="btn btn-primary" id="btn_write" onclick="fn_insert_product();">등록</button>
                    <button type="button" class="btn btn-outline-dark" onclick="history.back();">목록</button>
                </div>
            </div>
        </div>
    </div>
@endsection
