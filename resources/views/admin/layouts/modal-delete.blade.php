<div id="myModal" class="modal">
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
