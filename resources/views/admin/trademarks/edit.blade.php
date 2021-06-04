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
                            <li><a href="{!! aurl('trademarks') !!}">{!! trans('admin.edit_trademark') !!}</a> /</li>
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
                            {!! Form::open(['url'=>aurl('trademarks/'.$trademark->id),'method'=>'put','files'=>true]) !!}

                                <div class="form-group">
                                    {!! Form::label('trademark_name_ar',trans('admin.trademark_name_ar')) !!}
                                    {!! Form::text('trademark_name_ar',$trademark->trademark_name_ar,['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('trademark_name_en',trans('admin.trademark_name_en')) !!}
                                    {!! Form::text('trademark_name_en',$trademark->trademark_name_en,['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('trademark_logo',trans('admin.logo')) !!}
                                    {!! Form::file('trademark_logo',['class'=>'form-control']) !!}
                                    @if(!empty($trademark->trademark_logo))
                                        <img src="{!! Storage::url($trademark->trademark_logo) !!}" height="50"/>
                                    @endif
                                </div>

                                {!! form::submit(trans('admin.save'),['class'=>'btn btn-primary form-control']) !!}

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

