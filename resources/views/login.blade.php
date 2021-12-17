@extends('layouts.header')

@section('content')
{{-- 1680 x 908   --}}
{{--<section class="module bg-dark-30" data-background="/images/section-4.jpg">--}}
<script>
    $(document).ready(function(){


        $("#login_btn").on("click", function (e) {

            //var loginFrm = $("#loginFrm").serialize() ;
            e.preventDefault();

            var member_id = $("#member_id").val();
            var member_pw = $("#member_pw").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/login_action',
                data: {
{{--                    "_token": "{{ csrf_token() }}",--}}
                    member_id : member_id,
                    member_pw : member_pw

                },
                success: function(result) {
                    if (result == "success"){
                        alert("ღ Welcome Guy Jewelry ! ღ \n 관리자님 로그인 됐습니다.");
                        location.href = "/";
                    } else {
                        alert("아이디와 비밀번호를 확인해주세요.");
                        location.reload();
                    }
                },
                error: function(data) {
                    alert("에러가 발생했습니다. 다시 시도해주세요.");
                }
            });
        });
    });
</script>
<section class="module bg-dark-30" data-background="/images/login_bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">LOGIN</h1>
            </div>
        </div>
    </div>
</section>
<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-3">
                <h4 class="font-alt">Login</h4>
                <hr class="divider-w mb-10">
                <form class="form" id="loginFrm">
                    <div class="form-group">
                        <input class="form-control" id="member_id" type="text" name="member_id" placeholder="ID" style="text-transform: none;"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="member_pw" type="password" name="member_pw" placeholder="Password"/>
                    </div>
                    <div class="form-group" align="center">
                        <button type="button" class="btn btn-round btn-b" id="login_btn">Login</button>
                    </div>
{{--                    <div class="form-group" align="right">--}}
{{--                        <a href="">Forgot Password?</a>--}}
{{--                    </div>--}}
                </form>
            </div>
{{--            <div class="col-sm-5">--}}
{{--                <h4 class="font-alt">Register</h4>--}}
{{--                <hr class="divider-w mb-10">--}}
{{--                <form class="form">--}}
{{--                    <div class="form-group">--}}
{{--                        <input class="form-control" id="E-mail" type="text" name="email" placeholder="Email"/>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input class="form-control" id="username" type="text" name="username" placeholder="Username"/>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input class="form-control" id="password" type="password" name="password" placeholder="Password"/>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input class="form-control" id="re-password" type="password" name="re-password" placeholder="Re-enter Password"/>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <button class="btn btn-block btn-round btn-b">Register</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>
    </div>
</section>
@endsection
