@section('title')
    {!! trans("admin.login") !!}
@endsection

@include('admin.layouts.header')

<body class="hold-transition login-page">
<div class="login-box">
    <!--
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
     /.login-logo -->
    @include('admin.layouts.massages')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{!! trans('admin.Sign_in_to_start_your_session') !!}</p>

            <form method="post">
                {!! csrf_field() !!}
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" value="{!! old('email') !!}" placeholder="{!! trans('admin.email') !!}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="{!! trans('admin.password') !!}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="rememberme" value="1">
                            <label for="remember">
                                {!! trans('admin.remember_me') !!}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{!! trans('admin.sing_in') !!}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{!! aurl('forgotPassword') !!}">{!! trans('admin.i_forgot_my_password') !!}</a>
            </p>
            <p class="mb-0">
                <a href="{!! aurl('register') !!}" class="text-center">{!! trans('admin.register_a_new_membership') !!}</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{!! url('adminLTE') !!}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{!! url('adminLTE') !!}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{!! url('adminLTE') !!}/dist/js/adminlte.min.js"></script>

</body>
</html>
