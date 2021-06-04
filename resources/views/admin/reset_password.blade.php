@section('title')
    {!! trans("admin.reset_password") !!}
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
            <p class="login-box-msg">{!! trans('admin.please_write_new_password') !!}</p>

            <form method="post">
                {!! csrf_field() !!}
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" value="{!! $data->email !!}" placeholder="{!! trans('admin.email') !!}">
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
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="{!! trans('admin.password_confirmation') !!}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{!! trans('admin.reset_password') !!}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{!! aurl('login') !!}">{!! trans('admin.login') !!}</a>
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
