@extends('adminlte::page')

@section('title', 'Establecimientos')

@section('content_header')
    <h1 class="m-0 text-dark">Establecimientos</h1>
@stop

@section('content')
    @include('layouts.messages')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Eliminar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel"></h2>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar <span id="span_name"></span>?
                </div>
                <div class="modal-footer">
                    <form id="delete" action="{{ route('establecimientos.destroy', 1) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="id" name="id" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Si</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Aquí se muestra un listado de todos los establecimientos que has conseguido.</p>
                    <br>
                    En la base de datos por ahora tenemos datos de mentira (fake).
                    <br>
                    <br>
                    <div class="box-body table-responsive">
                        <button type="button" class="btn btn-primary" onclick="newStore();">Nuevo establecimiento</button>
                        <table id="main_table" class="table display compact" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Activo?</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready( function () {
            $('#main_table').DataTable({
                "order": [[ 0, 'asc' ]],
                "processing": true,
                "serverSide": false,
                "lengthChange": false,
                "pageLength": 5,
                "ajax": '{!! route('stores.datatables') !!}',
                "language": {
                    "url": "{{ url('vendor/dataTables/Spanish.json') }}"
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'comercial_name', name: 'comercial_name' },
                    { data: 'active', name: 'active' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions' }
                ]
            });

            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus();
            })
        });

        function modifyDeleteAction(item, name) {
            $('#span_name').text(name);
            $('#id').val(item);
            $('#delete').attr('action', '{{ url('establecimientos') }}/'+item);
        }

        function newStore() {
            window.location = "{{ url('establecimientos') }}/create";
        }
    </script>
@stop