@component('mail::message')
#{!! trans('admin.reset_password') !!}

{!! trans('admin.welcome') !!} {!! $data['data']->name !!}

@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
{!! trans('admin.click_here_to_reset_password') !!}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
