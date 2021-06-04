@section('cssDataTable')
    <link rel="stylesheet" href="{!! url('/') !!}/jstree/dist/themes/default/style.min.css" />
@endsection

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
                            <li><a href="{!! aurl('sections') !!}">{!! trans('admin.sections') !!}</a> /</li>
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
                            {!! Form::open(['url'=>aurl('sections/'.$section->id),'method'=>'put','files'=>true]) !!}

                            <div class="form-group">
                                {!! Form::label('section_name_ar',trans('admin.section_name_ar')) !!}
                                {!! Form::text('section_name_ar',$section->section_name_ar,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('section_name_en',trans('admin.section_name_en')) !!}
                                {!! Form::text('section_name_en',$section->section_name_en,['class'=>'form-control']) !!}
                            </div>

                            <input type="hidden" name="parent" value="{!! $section->parent !!}" class="parent-id">

                            <div class="form-group" id="jstree">
                            </div>

                            <div class="form-group">
                                {!! Form::label('icon_section',trans('admin.icon_section')) !!}
                                {!! Form::file('icon_section',['class'=>'form-control']) !!}
                                @if(!empty($section->icon_section))
                                    <img src="{!! Storage::url($section->icon_section) !!}" height="50"/>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('description',trans('admin.description')) !!}
                                {!! Form::textarea('description',$section->description,['class'=>'form-control', 'rows' => 2]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('keyword',trans('admin.keyword')) !!}
                                {!! Form::textarea('keyword',$section->keyword,['class'=>'form-control', 'rows' => 2]) !!}
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
        <script src="{!! url('/') !!}/jstree/dist/jstree.min.js"></script>
        <script>
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! load_section( $section->parent , $section->id ) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow"]//, "checkbox" ]
            });
            $('#jstree').on('changed.jstree',function (e,data) {
                let i, j , k = [];
                for(i=0 , j = data.selected.length ; i < j ; i++ ){
                    k.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent-id').val(k.join(', '));
            })
        </script>
    @endpush

@endsection

