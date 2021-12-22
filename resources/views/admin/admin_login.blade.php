<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8" name="csrf-token" content="{{ csrf_token() }}">

    <title>Guy Jewelry Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/admin/sb-admin-2.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/admin/sb-admin-2.min.js"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Guy Jewelry Admin</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="admin_id" name="admin_id" aria-describedby="emailHelp"
                                                   placeholder="ID">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                   id="admin_pw" name="admin_pw" placeholder="Password">
                                        </div>
    {{--                                    <div class="form-group">--}}
    {{--                                        <div class="custom-control custom-checkbox small">--}}
    {{--                                            <input type="checkbox" class="custom-control-input" id="customCheck">--}}
    {{--                                            <label class="custom-control-label" for="customCheck">Remember--}}
    {{--                                                Me</label>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
                                        <button type="button" class="btn btn-primary btn-user btn-block" id="login_btn">
                                            로그인
                                        </button>
                                        <hr>
    {{--                                    <a href="index.html" class="btn btn-google btn-user btn-block">--}}
    {{--                                        <i class="fab fa-google fa-fw"></i> Login with Google--}}
    {{--                                    </a>--}}
    {{--                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">--}}
    {{--                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook--}}
    {{--                                    </a>--}}
                                    </form>
    {{--                                <hr>--}}
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
    {{--                                <div class="text-center">--}}
    {{--                                    <a class="small" href="register.html">Create an Account!</a>--}}
    {{--                                </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function(){

            $("#login_btn").on("click", function (e) {

                e.preventDefault();

                var admin_id = $("#admin_id").val();
                var admin_pw = $("#admin_pw").val();

                console.log($('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '/admin_login_action',
                    data: {
                        admin_id : admin_id,
                        admin_pw : admin_pw
                    },
                    success: function(result) {
                        if (result == "success"){
                            alert("ღ Welcome Guy Jewelry ! ღ \n 관리자님 로그인 됐습니다.");
                            location.href = "/admin_index";
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

</body>

</html>
