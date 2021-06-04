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
                        <h1>{!! trans('admin.sections') !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! aurl() !!}">{!! trans('admin.home') !!}</a> /</li>
                            <li class="active">{!! trans('admin.sections') !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    @include('admin.layouts.massages')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{!! $title !!}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{!! aurl('sections/create') !!}">
                                <button class="btn bg-green">
                                    <i class="fa fa-plus"></i> {!! trans('admin.create_new_section') !!}
                                </button>
                            </a>
                            <a href="" class="edit-section btn-controller d-none">
                                <button class="btn bg-blue">
                                    <i class="fa fa-edit"></i> {!! trans('admin.edit') !!}
                                </button>
                            </a>
                            <a href="" class="delete-section btn-controller d-none btn-delete-section" data-toggle="modal" data-target="#section_delete_modal">
                                <button class="btn bg-red">
                                    <i class="fa fa-trash"></i> {!! trans('admin.delete') !!}
                                </button>
                            </a>

                            <div id="jstree" style="padding-top:  0.75em"></div>
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


    <!-- model delete alert -->
    <!-- The Modal -->
    <div class="modal fade" id="section_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <input type="hidden" name="parent" value="" class="parent-id">

                <!-- Modal Header -->
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">{!! trans('admin.delete_section') !!}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <!-- Modal body -->
                <div class="modal-body">
                    <h5>{!! trans('admin.are_you_sure_you_want_delete_section(') !!}<span class="records"></span>{!! trans('admin.)?') !!}</h5>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">{!! trans('admin.close') !!}</button>
                    <button type="submit" class="btn btn-outline-danger model-delete-section" data-dismiss="modal">{!! trans('admin.agree') !!}</button>
                </div>

            </div>
        </div>
    </div>

    {!! Form::open(['id'=>'form_delete_section','method'=>'delete']) !!}
    {!! Form::close() !!}

    <!-- model delete alert -->

    @push('jQuery')
        <script src="{!! url('/') !!}/jstree/dist/jstree.min.js"></script>
        <script>
            //btn-delete-section
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core" : {
                        'data' : {!! load_section() !!},
                        "themes" : {
                            "variant" : "large"
                        }
                    },
                    "checkbox" : {
                        "keep_selected_style" : true
                    },
                    "plugins" : [ "wholerow"]//, "checkbox" ]
                });
                $('#jstree').on('changed.jstree',function (e,data) {
                    let i, j , k = [];
                    let n = [];
                    for(i=0 , j = data.selected.length ; i < j ; i++ ){
                        k.push(data.instance.get_node(data.selected[i]).id);
                        n.push(data.instance.get_node(data.selected[i]).text);
                    }
                    if(k.join(', ') !== ''){
                        $('.btn-controller').removeClass('d-none')
                        $('.edit-section').attr('href',"{!! aurl('sections') !!}/"+k.join(', ')+'/edit')
                    }else{
                        $('.btn-controller').addClass('d-none')
                    }
                    $('.btn-delete-section').on('click',function () {
                        $('.records').text(n.join(', '));
                    })
                    $('.model-delete-section').on('click',function () {
                        $('#form_delete_section').attr('action',"{!! aurl('sections') !!}/"+k.join(', ')).submit()
                    })
                })
            })

        </script>
    @endpush

@endsection

