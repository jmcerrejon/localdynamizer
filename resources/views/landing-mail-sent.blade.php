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
            	<p class="login-box-msg">¡Datos del formulario recibido!. Nos pondremos muy pronto en contacto con usted.</p>
        </div>
		@endif
    </div>
    <script type=”text/javascript”>
        setTimeout(function() {
            window.location=”https://dinamizadorlocal.com”;
        }, 3000);
    </script>
@stop
