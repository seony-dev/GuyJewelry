@extends('layouts.header')

@section('content')
    <script>
        $(document).ready(function(){
           $("#btn_write_inquiry").on("click", function(){
               var applicant_name = $("#applicant_name").val();
               var applicant_phone = $("#applicant_phone").val();
               var applicant_email = $("#applicant_email").val();
               var inquiry_contents = $("#inquiry_contents").val();

               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                   , url : "/contact/inquiry_write_action"
                   , data: {
                       applicant_name : applicant_name
                       , applicant_phone : applicant_phone
                       , applicant_email : applicant_email
                       , inquiry_contents : inquiry_contents
                   }
                   , type:'POST'
                   , success:function(result) {
                       if(result == "success") {
                           alert("간편 상담 신청이 완료됐습니다!");
                           location.reload();
                       } else {
                           alert("에러가 발생했습니다. 다시 시도해주세요.");
                       }
                   }
               });
           });
        });
    </script>
    <section class="module bg-dark-60 contact-page-header bg-dark" data-background="/images/shop/2.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Contact Us</h2>
{{--                    <div class="module-subtitle font-serif"></div>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="font-alt">간편 상담</h4><br/>
                    <form id="contactFrm">
                        <div class="form-group">
                            <label class="sr-only" for="name">Name</label>
                            <input class="form-control" type="text" id="applicant_name" name="applicant_name" placeholder="* 성함" required="required" data-validation-required-message="성명을 입력해주세요."/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="email">Phone</label>
                            <input class="form-control" type="text" id="applicant_phone" name="applicant_phone" placeholder="* 전화번호" required="required" data-validation-required-message="전화번호를 입력해주세요." maxlength="13"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="email">Email</label>
                            <input class="form-control" type="email" id="applicant_email" name="applicant_email" placeholder="이메일" required="required" data-validation-required-message="이메일을 입력해주세요."/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="7" id="inquiry_contents" name="inquiry_contents" placeholder="* 상담내용" required="required" data-validation-required-message="간편 상담 내용을 입력해주세요."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-block btn-round btn-d" id="btn_write_inquiry" type="button">접수</button>
                        </div>
                    </form>
                    <div class="ajax-response font-alt" id="contactFormResponse"></div>
                </div>
                <div class="col-sm-6">
                    <h4 class="font-alt">가이 주얼리 & 워치링</h4><br/>
                    <p>고품격 하이엔드 주얼리 브랜드 가이 주얼리 & 워치링입니다. <br> 최고의 명성답게 최고의 서비스를 제공해드리겠습니다.</p>
                    <hr/>
                    <h4 class="font-alt">상담 시간</h4><br/>
                    <ul class="list-unstyled" style="font-size: 15px;">
                        <li>월 ~ 금 : AM 10:00 ~ PM 19:00</li>
                        <li>주말 : AM 10:00 ~ PM 14:00</li>
                        <p style="color: red;">공휴일은 쉽니다.</p>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="map-section">
        <div id="map"></div>
        <p><em>지도를 클릭해주세요!</em></p>
        <div id="clickLatlng"></div>
    </section>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=bc75922c59878b3f0def62b88fe40b18"></script>
    <script>
        var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
        var options = { //지도를 생성할 때 필요한 기본 옵션
            center: new kakao.maps.LatLng(37.52739582576465, 127.03786172368594), //지도의 중심좌표.
            level: 3 //지도의 레벨(확대, 축소 정도)
        };

        var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

        var marker = new kakao.maps.Marker({
            // 지도 중심좌표에 마커를 생성합니다
            position: map.getCenter()
        });
        // 지도에 마커를 표시합니다
        marker.setMap(map);

        // var iwContent = '<div style="padding:5px;">가이주얼리 & 워치링<br><a href="https://map.kakao.com/link/map/가이주얼리 & 워치링,37.52739582576465,127.03786172368594" style="color:blue" target="_blank">큰지도보기</a> <a href="https://map.kakao.com/link/to/가이주얼리 & 워치링,37.52739582576465,127.03786172368594" style="color:blue" target="_blank">길찾기</a></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
        var iwContent = '<div style="box-shadow: 0 0 10px rgba(0,0,0,.1); outline: 2px solid #fff; background: #fff; padding: 10px; width: 200px; height: 80px; line-height: 1.4;  font-size: 12px;"><b style="font-weight: bolder; font-size: 16px; ">가이주얼리 & 워치링</b><br>지하철: 압구정로데오역 6번 출구<br>압구정역 2번 출구</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
            iwPosition = new kakao.maps.LatLng(37.52739582576465, 127.03786172368594); //인포윈도우 표시 위치입니다

        // 인포윈도우를 생성합니다
        var infowindow = new kakao.maps.InfoWindow({
            position : iwPosition,
            content : iwContent
        });

        // 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
        infowindow.open(map, marker);
    </script>
@endsection
