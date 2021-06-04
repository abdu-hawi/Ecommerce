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
                        <h1>{!! $title !!} : {!! $factory !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">{!! trans('admin.home') !!}</a> /</li>
                            <li><a href="{!! aurl('manufacturers') !!}">{!! trans('admin.manufacturers') !!}</a> /</li>
                            <li class="breadcrumb-item active">{!! $factory !!}</li>
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
                        <div class="card-body register-card-body col-8" style="margin-left: auto;margin-right: auto;">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    @if(!empty($manufacturer->manufacturer_logo))
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 src="{!! Storage::url($manufacturer->manufacturer_logo) !!}"
                                                 alt="User profile picture">
                                        </div>
                                    @endif


                                    <h3 class="profile-username text-center">
                                        {!! lang()=='ar'?$manufacturer->manufacturer_name_ar:$manufacturer->manufacturer_name_en !!}
                                    </h3>

                                    <p class="text-muted text-center">
                                        {!! lang()=='ar'?$manufacturer->manufacturer_name_en:$manufacturer->manufacturer_name_ar !!}
                                    </p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>{!! trans('admin.country_id') !!}</b>
                                            <a class="float-right">{!! App\Model\Country::pluck('country_name_'.lang())[0] !!}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>{!! trans('admin.city_id') !!}</b>
                                            <a class="float-right">{!! App\Model\City::pluck('city_name_'.lang())[0] !!}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Following</b> <a class="float-right">543</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Friends</b> <a class="float-right">13,287</a>
                                        </li>
                                    </ul>

                                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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

