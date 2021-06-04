@extends('admin.index')

@section('content')
    <?php $lat = !empty($manufacturer->lat)?$manufacturer->lat:'21.507833' ?>
    <?php $long = !empty($manufacturer->long)?$manufacturer->long:'39.169586' ?>
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
                            <li><a href="{!! aurl('manufacturers') !!}">{!! trans('admin.manufacturers') !!}</a> /</li>
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
                        <div class="card-body register-card-body col-12" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>aurl('manufacturers/'.$manufacturer->id),'files'=>true,'method'=>'put','files'=>true]) !!}

                            <div class="form-group">
                                {!! Form::label('manufacturer_name_ar',trans('admin.manufacturer_name_ar')) !!}
                                {!! Form::text('manufacturer_name_ar',$manufacturer->manufacturer_name_ar,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('manufacturer_name_en',trans('admin.manufacturer_name_en')) !!}
                                {!! Form::text('manufacturer_name_en',$manufacturer->manufacturer_name_en,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('country_id',trans('admin.country_id')) !!}
                                {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.lang(),'id'),$manufacturer->country_id,['class'=>'form-control country_id','placeholder'=>trans('admin.please_select_country')]) !!}
                            </div>

                            <div class="form-group city">

                            </div>

                            <div class="form-group">
                                {!! Form::label('email',trans('admin.email')) !!}
                                {!! Form::email('email',$manufacturer->email,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('site',trans('admin.site')) !!}
                                {!! Form::text('site',$manufacturer->site,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('phone',trans('admin.phone')) !!}
                                {!! Form::number('phone',$manufacturer->phone,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('manufacturer_logo',trans('admin.manufacturer_logo')) !!}
                                {!! Form::file('manufacturer_logo',['class'=>'form-control']) !!}
                                @if(!empty($manufacturer->manufacturer_logo))
                                    <img src="{!! Storage::url($manufacturer->manufacturer_logo) !!}" height="50"/>
                                @endif
                            </div>

                            <div class="form-group">
                            {!! Form::label('address',trans('admin.address')) !!}
                            <!-- Form::text('address',"aaaa",['class'=>'form-control address', 'id'=>'address'])  --!!} -->
                                <div class="form-group location" style="max-width: 100%; height: 400px;"></div>
                            </div>

                            <input type="hidden" name="lat" id="lat" value="{!! $lat !!}">
                            <input type="hidden" name="long" id="long" value="{!! $long !!}">

                            {!! form::submit(trans('admin.save'),['class'=>'btn btn-primary form-control col-6','style'=>"margin-left: auto;margin-right: auto;display: block;"]) !!}

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
                    url:"{!! aurl('manufacturers/create') !!}",
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
                            url:"{!! aurl('manufacturers/create') !!}",
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
        <!-- locationpicker.jquery.min.js-->
        <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAi8Lp4Ndj1R9b3J69tt4F35so_ic5oEdI'></script>
        <script src="{!! url('/') !!}/adminLTE/dist/js/locationpicker.jquery.js"></script>

        <script>
            $('.location').locationpicker({
                location: {
                    latitude: {!! $lat !!},
                    longitude: {!! $long !!}
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#long'),
                    radiusInput: $('#us2-radius'),
                    locationNameInput: $('.adda'),
                }
            });
        </script>

    @endpush

@endsection

