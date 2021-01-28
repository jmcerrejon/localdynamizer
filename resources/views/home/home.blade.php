@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">Inicio</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">¡Bienvenid@! 👋</p>
                    <br>
                    <p>Este es el panel de dinamizador. Desde aquí podrás ver las estadísticas y acceder a las opciones más
                        importantes de la localidad que gestionas.</p>
                    <p>Para cualquier problema, no dudes en ponerte en contacto con nosotros.</p>
                    <p>A continuación tus estadísticas:</p>
                    <div class="row">
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fas fa-box-open"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Tu total de recursos</span>
                                    <span class="info-box-number">{{ $user->resources_count }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fas fa-store"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Tu total de negocios</span>
                                    <span class="info-box-number">{{ $user->stores_count }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <p>El equipo técnico.</p>
                </div>
            </div>
        </div>
    </div>
@stop
