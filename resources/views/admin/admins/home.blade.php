@section('cssDataTable')
    <link rel="stylesheet" href="{!! url('/') !!}/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
                        <h1>{!! trans('admin.admin_account') !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! aurl() !!}">{!! trans('admin.home') !!}</a> /</li>
                            <li class="active">{!! trans('admin.admin_account') !!}</li>
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
                            {!! $dataTable->table(['class'=>'table table-hover table-bordered table-striped tb-my-admin'],true) !!}
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

    <div class="modal" id="multi_delete">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">{!! trans('admin.delete_record') !!}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="empty_records d-none">
                        <h5>{!! trans('admin.please_chose_record') !!}</h5>
                    </div>
                    <div class="not_empty_records d-none">
                        <h5>{!! trans('admin.are_you_sure_you_want_delete') !!}<span class="records">  </span>{!! trans('admin.records?') !!}</h5>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="empty_records d-none">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">{!! trans('admin.close') !!}</button>
                    </div>
                    <div class="not_empty_records d-none">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">{!! trans('admin.close') !!}</button>
                        <button type="submit" class="btn btn-danger delete-all" data-dismiss="modal">{!! trans('admin.agree') !!}</button>
                    </div>

                </div>

            </div>
        </div>
    </div>


    {!! Form::open(['url' => aurl('admin/destroy/all'),'id'=>'form_delete','method'=>'delete']) !!}

    {!! Form::close() !!}

    <!-- model delete alert -->

    @push('jQuery')

        <script src="{!! url('/') !!}/adminLTE/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{!! url('/') !!}/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="{!! url('/') !!}/datatable/js/dataTables.buttons.min.js"></script>
        <script src="{!! url('/') !!}/datatable/js/buttons.server-side.js"></script>
        <script src="{!! url('/') !!}/adminLTE/dist/js/myfunction.js"></script>

        {!! $dataTable->scripts() !!}

        <style>
            .table-responsive {
                width: 100% !important;
            }
            .tb-my-admin tfoot{
                display: none !important;
            }
        </style>

        <script>
            deleteAll();
            delete_admin();
        </script>

    @endpush

@endsection

