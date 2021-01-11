@extends('adminlte::page')

@section('title', 'Editar/nuevo establecimiento')

@section('css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/taggle.css') }}">
@stop

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

        <input type="hidden" name="is_active" value="0">

        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="is_active" class="col-sm-2 control-label">¿Activo?</label>

                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_active" title="activado = se publica" @if ((isset($store) &&
                                    $store->is_active) || old('is_active') || !isset($store)) checked @endif>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                    @if (isset($store))
                    <button type="button" class="btn btn-info" onclick="window.location.href='{{ route('establecimientos.show-opening', $store->id) }}'">Horarios de apertura/cierre</button>
                    @endif
                </div>
                <!-- /.form-group -->
                </div>
            </div>

            <div class="form-group">
                <label for="service_id" class="col-sm-2 control-label">Servicio contratado*</label>
                <div class="col-sm-10">
                    <select id="service_id" name="service_id" class="form-control">
                        @foreach($services as $service)
                        <option value="{{ $service->id }}" @if ((isset($store)) && ($service->id ===
                            $store->service_id)) selected @endif>{{ $service->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="comercial_name" class="col-sm-2 control-label">Nombre comercial*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="comercial_name" name="comercial_name" title="Nombre comercial"
                        placeholder="Nombre comercial" value="{{ $store->comercial_name ?? old('comercial_name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="business_name" class="col-sm-2 control-label">Nombre de la empresa/negocio</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="business_name" name="business_name" title="Nombre de la empresa/negocio si es distinto" placeholder="Nombre de la empresa/negocio" value="{{ $store->business_name ?? old('business_name') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="cif" class="col-sm-2 control-label">CIF*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="cif" title="CIF" placeholder="CIF" value="{{ $store->cif ?? old('cif') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="contact_name" class="col-sm-2 control-label">Persona de contacto*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact_name" title="Persona de contacto" placeholder="Persona de contacto" value="{{ $store->contact_name ?? old('contact_name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="category_id" class="col-sm-2 control-label">Categoría*</label>

                <div class="col-sm-10">
                    <select id="category_id" name="category_id" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if ((isset($store)) && ($category->id ===
                            $store->category_id)) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="activities" class="col-sm-2 control-label">Actividad*</label>

                <div class="col-sm-10">
                    <div id="activities" class="form-control"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Dirección del establecimiento*</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" title="Dirección" placeholder="Dirección"
                        value="{{ $store->address ?? old('address') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="postal_code" class="col-sm-2 control-label">Código Postal*</label>

                <div class="col-sm-10">
                    <input type="number" class="form-control" name="postal_code" title="Código Postal"
                        placeholder="Código Postal" value="{{ $store->postal_code ?? old('postal_code') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email*</label>

                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" title="Correo electrónico"
                        placeholder="Correo electrónico" value="{{ $store->email ?? old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email_public" class="col-sm-2 control-label">Email <small>(para el público)</small></label>

                <div class="col-sm-10">
                    <input type="email_public" class="form-control" id="email_public" name="email_public" title="Correo electrónico"
                        placeholder="Correo electrónico" value="{{ $store->email_public ?? old('email_public') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="contact_phone" class="col-sm-2 control-label">Teléfono de contacto*</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="contact_phone" name="contact_phone" title="Teléfono de contacto" placeholder="Teléfono de contacto" value="{{ $store->contact_phone ?? old('contact_phone') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="public_phone" class="col-sm-2 control-label">Teléfono público</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="public_phone" name="public_phone" title="Teléfono público" placeholder="Teléfono público" value="{{ $store->public_phone ?? old('public_phone') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="whatsapp" class="col-sm-2 control-label">WhatsApp</label>

                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" title="WhatsApp" placeholder="WhatsApp"
                        value="{{ $store->whatsapp ?? old('whatsapp') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="logo_file" class="col-sm-2 control-label">Imagen/Logo</label>
                <div class="col-sm-10">
                    @if (isset($store) && ($store->img_path))
                    <div class="input-group">
                        <img width="352" height="288" src="{{ $store->img_path ?? old('img_path') }}">
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

            <h3>Premium</h3>

            <input type="button" id="btn-premium-toggle" value="Mostrar/Ocultar campos premium"><br>

            <div id="premium-fields">
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Descripción</label>

                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="description" title="description" placeholder="Descripción del negocio para la APP">{{ $store->description ?? old('description') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="payment_method_id" class="col-sm-2 control-label">Método de pago</label>

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
                    <label for="website" class="col-sm-2 control-label">Website</label>

                    <div class="col-sm-10">
                        <input type="url" class="form-control" name="website" title="Website" placeholder="Website"
                            value="{{ $store->website ?? old('website') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="facebook" class="col-sm-2 control-label">Facebook</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="facebook" title="Facebook" placeholder="Facebook"
                            value="{{ $store->facebook ?? old('facebook') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="instagram" class="col-sm-2 control-label">Instagram</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="instagram" title="Instagram" placeholder="Instagram"
                            value="{{ $store->instagram ?? old('instagram') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="twitter" class="col-sm-2 control-label">Twitter</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="twitter" title="Twitter" placeholder="Twitter"
                            value="{{ $store->twitter ?? old('twitter') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="tripadvisor" class="col-sm-2 control-label">Tripadvisor</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tripadvisor" title="Tripadvisor" placeholder="Tripadvisor"
                            value="{{ $store->tripadvisor ?? old('facebook') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="tiktok" class="col-sm-2 control-label">Tiktok</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tiktok" title="Tiktok" placeholder="Tiktok"
                            value="{{ $store->tiktok ?? old('tiktok') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu_es" class="col-sm-2 control-label">Carta digital <small>(URL)</small></label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="menu_es" title="Carta digital (URL)" placeholder="Carta digital (URL)"
                            value="{{ $store->menu_es ?? old('menu_es') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="menu" class="col-sm-2 control-label">Carta digital <small>(Otros idiomas)</small></label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="menu" title="Carta digital (Otros idiomas)" placeholder="Carta digital (Otros idiomas)"
                            value="{{ $store->menu ?? old('menu') }}">
                    </div>
                </div>
            </div> <!-- /.premium-fields -->
        <br>
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
<script src="/js/taggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready( function () {
        const arrCurrentActivities = @json(isset($store) ? $store->activities->pluck('name') : []);
        const arrAllActivities = @json($allActivities);

        $("#btn-premium-toggle").click(function(){
            $("#premium-fields").toggle()
        });

        $('#website').focus(function() {
            if ($('#website').val().trim() != '') {
                return false;
            }
            $('#website').val('https://');
        });

        $('#business_name').focus(function() {
            if ($('#comercial_name').val().trim() != '' && $('#business_name').val().trim() == '') {
                $('#business_name').val(
                    $('#comercial_name').val().trim()
                );
            }
        });

        $('#public_phone').focus(function() {
            if ($('#contact_phone').val().trim() != '') {
                ($('#public_phone').val().trim() == '') && $('#public_phone').val($('#contact_phone').val().trim());
                ($('#whatsapp').val().trim() == '') && $('#whatsapp').val($('#contact_phone').val().trim());
            }
        });

        $('#email_public').focus(function() {
            if ($('#email').val().trim() != '' && $('#email_public').val().trim() == '') {
                $('#email_public').val(
                    $('#email').val().trim()
                );
            }
        });

        const activityTag = new Taggle('activities', {
            tags: arrCurrentActivities,
            duplicateTagClass: 'bounce'
        });
        const container = activityTag.getContainer();
        const input = activityTag.getInput();

        $(input).autocomplete({
            source: arrAllActivities,
            appendTo: container,
            position: { at: "left bottom", of: container },
            select: function(event, data) {
                event.preventDefault();
                if (event.which === 1) {
                    activityTag.add(data.item.value);
                }
            }
        });
    });
</script>
@stop