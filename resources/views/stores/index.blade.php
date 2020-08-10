@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">Establecimientos</h1>
@stop

@section('content')
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
            $('#delete').attr('action', '{{ url('stores') }}/'+item);
        }

		function newStore() {
			window.location = "{{ url('establecimientos') }}/create";
		}
    </script>
@stop