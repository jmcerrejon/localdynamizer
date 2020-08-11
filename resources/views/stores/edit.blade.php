@extends('adminlte::page')

@section('title', 'Editar/nuevo establecimiento')

@section('content')
@include('layouts.messages')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Editar/Nuevo establecimiento</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form id="form_edit" role="form" enctype="multipart/form-data" class="form-horizontal"
        action="{{ (isset($store)) ? route('establecimientos.update', $store->id) : route('establecimientos.store') }}"
        method="post">
        @csrf
        @if (isset($store)) @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $store->id ?? '' }}">
        <input type="hidden" name="subscription_type" value="{{ $store->subscription_type ?? 1 }}">
        <input type="hidden" name="is_active" value="0">
        <div class="box-body">
            <div class="form-group">
                <label for="is_active" class="col-sm-2 control-label">¿Activo?</label>

                <div class="col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_active" title="activado = se publica" @if ((isset($store) &&
                                $store->is_active) || old('is_active')) checked @endif>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="payment_method_id" class="col-sm-2 control-label">Método de pago*</label>
                <div class="col-sm-10">
                    <select id="payment_method_id" name="payment_method_id" class="form-control">
                        @foreach($payment_methods as $payment_method)
                        <option value="{{ $payment_method->id }}" @if ((isset($store)) && ($payment_method->id ===
                            $store->payment_method_id)) selected @endif>{{ $payment_method->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="comercial_name" class="col-sm-2 control-label">Nombre comercial*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="comercial_name" title="Nombre comercial"
                        placeholder="Nombre comercial" value="{{ $store->comercial_name ?? old('comercial_name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="business_name" class="col-sm-2 control-label">Nombre de la empresa/negocio</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="business_name"
                        title="Nombre de la empresa/negocio si es distinto" placeholder="Nombre de la empresa/negocio"
                        value="{{ $store->business_name ?? old('business_name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_name" class="col-sm-2 control-label">Persona de contacto*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact_name" title="Persona de contacto"
                        placeholder="Persona de contacto" value="{{ $store->contact_name ?? old('contact_name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Dirección del establecimiento*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" title="Dirección" placeholder="Dirección"
                        value="{{ $store->address ?? old('address') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="locality" class="col-sm-2 control-label">Localidad</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="locality" title="Localidad" placeholder="Localidad"
                        value="{{ $store->locality ?? old('locality') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="population" class="col-sm-2 control-label">Población</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="population" title="Población" placeholder="Población"
                        value="{{ $store->population ?? old('population') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="postal_code" class="col-sm-2 control-label">Código Postal*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="postal_code" title="Código Postal"
                        placeholder="Código Postal" value="{{ $store->postal_code ?? old('postal_code') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Correo electrónico*</label>

                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" title="Correo electrónico"
                        placeholder="Correo electrónico" value="{{ $store->email ?? old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="public_phone" class="col-sm-2 control-label">Teléfono público</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" name="public_phone" title="Teléfono público"
                        placeholder="Teléfono público" value="{{ $store->public_phone ?? old('public_phone') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_phone" class="col-sm-2 control-label">Teléfono de contacto*</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" name="contact_phone" title="Teléfono de contacto"
                        placeholder="Teléfono de contacto" value="{{ $store->contact_phone ?? old('contact_phone') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="whatsapp" class="col-sm-2 control-label">WhatsApp</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" name="whatsapp" title="WhatsApp" placeholder="WhatsApp"
                        value="{{ $store->whatsapp ?? old('whatsapp') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="website" class="col-sm-2 control-label">Website</label>

                <div class="col-sm-10">
                    <input type="url" class="form-control" id="website" name="website" title="Website" placeholder="Website"
                        value="{{ $store->website ?? old('website') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="logo_file" class="col-sm-2 control-label">Imagen/Logo del establecimiento</label>
                <div class="col-sm-10">
                    @if (isset($store) && ($store->logo_path))
                    <div class="input-group">
                        <img width="352" height="288" src="{{ $store->logo_path ?? old('logo_path') }}">
                    </div>
                    <br>
                    @endif
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-image"></i>
                        </div>
                        <input type="file" class="form-control pull-right" title="Dirección del logo" name="logo_file" value="">
                    </div>
                    <p class="help-block">Resolución aconsejada máxima: 2048x1024 | Máximo 5 Mb. Soportados: jpg, png.
                    </p>
                </div>
            </div>
        </div> <!-- /.box-body -->
        <div class="box-footer">
            @if (isset($store))
            <button type="button" class="btn btn-default"
                onclick="window.location.href='{{ route('establecimientos.index') }}'">Volver</button>
            @endif
            <button type="submit" class="btn btn-info pull-right" id="submit">Guardar</button>
        </div> <!-- /.box-footer -->
    </form>
    <br>
    <br>
</div>
@stop

@section('js')
<script>
    $(document).ready( function () {
        $('#website').focus(function() {
            if ($('#website').val().trim() != '') {
                return false;
            }
            $('#website').val('https://');
          });
    });
</script>
@stop