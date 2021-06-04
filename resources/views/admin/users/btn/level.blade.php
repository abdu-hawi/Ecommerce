<span class="label
    {!! $level == 'user'?'btn-danger btn-sm':'' !!}
    {!! $level == 'vendor'?'btn-info btn-sm':'' !!}
    {!! $level == 'company'?'btn-success btn-sm':'' !!}
     disabled">
    {!! trans('admin.'.$level) !!}
</span>
