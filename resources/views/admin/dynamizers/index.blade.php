@extends('admin.layouts.app')

@section('title', 'Dinamizadores')

@section('links')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link href="/admin/css/modal.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <h2>Eliminar dinamizador</h2>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar al dinamizador <span id="spName"></span>?</p>
        <p><b>NOTA:</b> Esta acción es permanente.</p>
      </div>
      <div class="modal-footer">
        <form id="delete" action="{{ route('dynamizers.destroy', 1) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" id="id">
            <button type="submit" class="btn btn-danger ml-3">Si, deseo eliminarlo</button>
        </form>
      </div>
    </div>
  
</div>
  
  
  </div>
    <div class="card md:mt-2">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Dinamizadores</h1>
        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid gap-6 grid-cols-1">
            <table id="main_table" class="overflow-x-auto block w-full"></table>
        </div>
        <!-- end body -->

    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
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
        alert('WIP');
        window.location = '{{ url('admon/dynamizers') }}/'+ id +'/edit';
    }

    function deleteItem(id, name) {
        document.getElementById('spName').innerHTML = name;
        document.getElementById('id').innerHTML = id;
        modal.style.display = 'block';
    }
    </script>
@endsection