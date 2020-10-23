@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

		@if (isset($error))
        <div class="register-box-body">
			<p class="login-box-msg">{{$error}}</p>
        </div>
		@else
        <div class="register-box-body">
            	<p class="login-box-msg">¡Correo enviado!. Nos pondremos muy pronto en contacto con usted.</p>
        </div>
		@endif
    </div>
@stop
