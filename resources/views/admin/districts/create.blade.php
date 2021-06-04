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
                            <li><a href="{!! aurl('districts') !!}">{!! trans('admin.districts') !!}</a> /</li>
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
                            {!! Form::open(['url'=>aurl('districts')]) !!}

                            <div class="form-group">
                                {!! Form::label('district_name_ar',trans('admin.district_name_ar')) !!}
                                {!! Form::text('district_name_ar',old('district_name_ar'),['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('district_name_en',trans('admin.district_name_en')) !!}
                                {!! Form::text('district_name_en',old('district_name_en'),['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('country_id',trans('admin.country_id')) !!}
                                {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.lang(),'id'),old('country_id'),['class'=>'form-control country_id','placeholder'=>trans('admin.please_select_country')]) !!}
                            </div>

                            <div class="form-group city">

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

        <script type="text/javascript">
            $(document).ready(function () {
                @if(old('country_id'))
                $.ajax({
                    url:"{!! aurl('districts/create') !!}",
                    dataType:"html",
                    data:{country_id:"{!! old('country_id') !!}",select:"{!! old('city_id') !!}"},
                    success:function (data) {
                        $('.city').html(data);
                    }
                });
                @endif
                $(document).on('change','.country_id',function () {
                    let country_id = $('.country_id option:selected').val();
                    if(country_id > 0){
                        $.ajax({
                           url:"{!! aurl('districts/create') !!}",
                            dataType:"html",
                            data:{country_id:country_id,select:''},
                            success:function (data) {
                               $('.city').html(data);
                            }
                        });
                    }else{
                        $('.city').html('');
                    }
                })
            })
        </script>

    @endpush

@endsection

