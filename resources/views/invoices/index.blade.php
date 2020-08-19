@extends('adminlte::page')

@section('title', 'Facturación')

@section('content_header')
<h1 class="m-0 text-dark">Facturación</h1>
@stop

@section('content')
@include('layouts.messages')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Eliminar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel"></h2>
            </div>
            <div class="modal-body">
                ¿Desea eliminar este recurso?
            </div>
            <div class="modal-footer">
                <form id="delete" action="{{ route('recursos.destroy', 1) }}" method="post">
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
                <p class="mb-0">Desde aquí se podrán ver las facturas emitidas a las empresas y obtener un pdf de dicha factura.</p>
                <br>
                <div class="box-body table-responsive">
                    <table id="main_table" class="table display compact" width="100%">
                        <thead>
                            <tr>
                                <th>Factura Núm</th>
                                <th>Descripción</th>
                                <th>Total de la factura</th>
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
                "ajax": '{!! route('invoices.datatables') !!}',
                "language": {
                    "url": "{{ url('vendor/dataTables/Spanish.json') }}"
                },
                columns: [
                    { data: 'invoice_sid', name: 'invoice_sid' },
                    { data: 'description', name: 'description' },
                    { data: 'total_amount', name: 'total_amount' },
                    { data: 'actions', name: 'actions' }
                ]
            });

            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus();
            })
        });

        function modifyDeleteAction(item) {
            $('#id').val(item);
            $('#delete').attr('action', '{{ url('recursos') }}/'+item);
        }

        function newResource() {
            window.location = "{{ url('recursos') }}/create";
        }
    </script>
@stop