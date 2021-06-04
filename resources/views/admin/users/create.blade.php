@extends('admin.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! $title !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">{!! trans('admin.home') !!}</a> /</li>
                            <li><a href="{!! aurl('users') !!}">{!! trans('admin.users_account') !!}</a> /</li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body col-8" style="margin-left: auto;margin-right: auto;">
                            @include('admin.layouts.massages')
                        </div>
                        <div class="card-body register-card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>aurl('users')]) !!}
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" value="{!! old('name') !!}" placeholder="{!! trans('admin.user_name') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" value="{!! old('email') !!}" placeholder="{!! trans('admin.email') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    {!! Form::select('level',[
                                                'user'=>trans('admin.user'),
                                                'vendor'=>trans('admin.vendor'),
                                                'company'=>trans('admin.company')
                                            ],
                                            old('level'),
                                            [
                                                'class'=>'form-control',
                                                'placeholder'=>'Select user level',
                                                'style'=>'ff'
                                            ])
                                     !!}
                                </div>


                            <!--
                            <div class="input-group mb-3">
                                <button type="password" class="btn btn-default form-control" name="password" data-toggle="dropdown">Select Type of user</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </button>
                            </div>
                            -->

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="{!! trans('admin.password') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password_confirmation"placeholder="{!! trans('admin.password_confirmation') !!}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- /.col -->
                                    <div class="col-4" style="margin-right: auto;margin-left: auto">
                                        <button type="submit" class="btn btn-primary btn-block">{!! trans('admin.agree') !!}</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @push('jQuery')



    @endpush

@endsection

