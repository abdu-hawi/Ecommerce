

@extends('admin.index')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! trans('admin.settings') !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! aurl() !!}">{!! trans('admin.home') !!}</a> /</li>
                            <li class="active">{!! trans('admin.settings') !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->



        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{!! $title !!}</h3>
                        </div>

                            @include('admin.layouts.massages')

                        <!-- /.card-header -->
                        <div class="card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('site_name_ar',trans('admin.site_name_ar')) !!}
                                {!! Form::text('site_name_ar',setting()->site_name_ar,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('site_name_en',trans('admin.site_name_en')) !!}
                                {!! Form::text('site_name_en',setting()->site_name_en,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email',trans('admin.email')) !!}
                                {!! Form::text('email',setting()->email,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo',trans('admin.logo')) !!}
                                {!! Form::file('logo',['class'=>'form-control']) !!}
                                @if(!empty(setting()->logo))
                                    <img src="{!! Storage::url(setting()->logo) !!}" height="50"/>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('icon',trans('admin.icon')) !!}
                                {!! Form::file('icon',['class'=>'form-control']) !!}
                                @if(!empty(setting()->icon))
                                    <img src="{!! Storage::url(setting()->icon) !!}" height="50"/>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('main_lang',trans('admin.main_lang')) !!}
                                {!! Form::select('main_lang',['ar'=>trans('admin.ar'),'en'=>trans('admin.en')],setting()->main_lang,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('descriptions',trans('admin.descriptions')) !!}
                                {!! Form::textarea('descriptions',setting()->descriptions,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('keywords',trans('admin.keywords')) !!}
                                {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status',trans('admin.status')) !!}
                                {!! Form::select('status',['open'=>trans('admin.open'),'close'=>trans('admin.closer')],setting()->status,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('msg_maintenance_ar',trans('admin.msg_maintenance_ar')) !!}
                                {!! Form::textarea('msg_maintenance_ar',setting()->msg_maintenance_ar,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('msg_maintenance_en',trans('admin.msg_maintenance_en')) !!}
                                {!! Form::textarea('msg_maintenance_en',setting()->msg_maintenance_en,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>

                            {!! form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

