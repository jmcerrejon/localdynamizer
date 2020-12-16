@extends('admin.layouts.app')

@section('title', 'Dinamizadores')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="/admin/css/modal.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
@include('admin.layouts.modal-delete', [
    'title' => 'Eliminar dinamizador'
])
    <div class="card md:mt-2">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Dinamizadores</h1>
            <button type="button" onclick="addItem();"><i class="fa fa-user-plus"></i></button>
        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid gap-6 grid-cols-1">
            @include('layouts.messages')
            <table id="main_table" class="overflow-x-auto block w-full"></table>
        </div>
        <!-- end body -->

    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
<script src="/admin/js/modal.js"></script>
    <script>
    const modal = document.getElementById("myModal");

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Datatable
    const data = @json($data);
    let obj = {
        headings: @json($headings),
        data: []
    };

    for ( let i = 0, length=data.length; i < length; i++ ) {
        obj.data[i] = [];
        for (let p in data[i]) {
            if( data[i].hasOwnProperty(p) ) {
                obj.data[i].push(data[i][p]);
            }
        }
    }

    const dataTable = new simpleDatatables.DataTable('#main_table', {
        firstLast: true,
        truncatePager: true,
        layout: {
            top: '{search}'
        },
        labels: {
            placeholder: 'Buscar...',
            perPage: '{select} registros por página',
            noRows: 'Nada que mostrar',
            info: 'Mostrando {start}/{end} de {rows} registros',
        },
        data: obj,
        filters: {'Job': ['Assistant', 'Manager']},
        columns: [
            {
                select: 4,
                type: 'date',
                format: 'MM/DD/YYYY'
            }
        ]
    });

    function addItem() {
        window.location = '{{ route('dynamizers.create') }}';
    }

    function editItem(id) {
        window.location = '{{ url('admon/dynamizers') }}/'+ id +'/edit';
    }

    function deleteItem(id, name) {
        document.getElementById('spName').innerHTML = name;
        document.getElementById('formDelete').action = 'dynamizers/' + id;
        toggleModal();
    }
    </script>
@endsection