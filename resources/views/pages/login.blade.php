<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- link css -->
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <!-- link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="form sign_in">
                <h3>Đăng nhập</h3>
                <span>sử dụng tài khoản của bạn</span>

                {!! Form::open(['route'=>'loginUser','method'=>'POST', 'enctype' => 'multipart/form-data','id'=>'form_input'])!!}
                    <div class="type">
                        <input type="text" placeholder="Tên đăng nhập" name="email" id="email">

                    </div>
                    <div class="type">
                        <input type="password" placeholder="Mật khẩu" name="password" id="password">

                    </div>
                    <div>{{isset($failed)? $failed:""}}</div>
                    <div class="forgot">
                        <a href=""><span>Quên mật khẩu</span></a>
                    </div>
                    {!! Form::submit('Đăng nhập',['class'=>'btn bkg'])!!}
                    {!! Form::close('')!!}
            </div>

            <div class="form sign_up">
                <h3>Đăng kí</h3>
                <span>tạo tài khoản bằng email</span>

                <form action="" id="form_input" method="POST">
                    <div class="type">

                        <input type="text" name="hoten" placeholder="Họ tên" id="name">
                    </div>
                    <div class="type">

                        <input type="email" name="email" placeholder="Email" id="email">
                    </div>
                    <div class="type">

                        <input type="password" name="pass" placeholder="Mật khẩu" id="pass">
                    </div>
                    <div class="type">

                        <input type="password" name="repass" placeholder="Nhập lại mật khẩu" id="repass">
                    </div>
                    <button type="submit" class="btn bkg" name="dangki">Đăng kí</button>
                </form>
            </div>
        </div>

        <div class="overlay">
            <div class="page page_signIn">
                <h3>Chào mừng trở lại!</h3>
                <p>* Nếu bạn chưa có tài khoản? Vui lòng đăng ký.</p>

                <button class="btn btnSign-in">Đăng kí <i class="bi bi-arrow-right"></i></button>
            </div>

            <div class="page page_signUp">
                <h3>Chào bạn!</h3>
                <p>Nhập thông tin cá nhân của bạn và bắt đầu mua hàng</p>

                <button class="btn btnSign-up">
                    <i class="bi bi-arrow-left"></i> Đăng nhập</button>
            </div>
        </div>
    </div>
    <!-- link script -->
    <script src="{{asset('js/login.js')}}"></script>
</body>
</html>