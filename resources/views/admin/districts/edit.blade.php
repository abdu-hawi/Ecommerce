@extends('admin.index')

@section('content')
    <?php $lat = !empty(old('lat'))?old('lat'):'21.507833' ?>
    <?php $long = !empty(old('long'))?old('long'):'39.169586' ?>
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
                        <div class="card-body register-card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>aurl('manufacturers/'.$district->id),'method'=>'put']) !!}

                            <div class="form-group">
                                {!! Form::label('district_name_ar',trans('admin.district_name_ar')) !!}
                                {!! Form::text('district_name_ar',$district->district_name_ar,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('district_name_en',trans('admin.district_name_en')) !!}
                                {!! Form::text('district_name_en',$district->district_name_en,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('country_id',trans('admin.country_id')) !!}
                                {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.lang(),'id'),$district->country_id,['class'=>'form-control country_id','placeholder'=>trans('admin.please_select_city')]) !!}
                            </div>

                            <div class="form-group city"></div>


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
                @if($district->country_id)
                $.ajax({
                    url:"{!! aurl('manufacturers/create') !!}",
                    dataType:"html",
                    data:{country_id:"{!! $district->country_id !!}",select:"{!! $district->city_id !!}"},
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

