@extends('adminlte::page')

@section('title', 'Recursos')

@section('content_header')
<h1 class="m-0 text-dark">Recursos</h1>
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
    <code>
    </code>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Aquí se muestra un listado de todos los recursos que tienes disponible para usar en
                    redes sociales. Puedes hacer búsquedas por hashtag o cualquier palabra presente en cada recurso.</p>
                <p class="mb-0">También podrás añadir nuevos recursos a los ya existentes.</p>
                <br>
                <div class="box-body table-responsive">
                    <a type="button" class="btn btn-primary" href="{{ url('recursos') }}/create"><i class="fas fa-pen"></i> Nuevo recurso</a>
                    <br />
                    <div class="scrolling-pagination">

                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                              @foreach($resources as $resource)
                              <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                  <div class="card-header text-muted border-bottom-0 h-10" style="height: 5.3rem;">
                                    {{ Str::limit($resource->body, 100) }}
                                  </div>
                                  <div class="card-body pt-0">
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <img class="img-responsive center-block d-block mx-auto img-fluid" src="{{ $resource->path }}">
                                        <p class="text-muted text-sm"><b>Hashtags: </b> #homem, #requit </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Vistas: {{ $resource->views }}</li>
                                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Descargas: {{ $resource->downloads }}</li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer">
                                    <div class="text-right">
                                        <form action="{{ route('recursos.show', $resource->id) }}" method="get">
                                        <a href="{{ URL::to('recursos/' . $resource->id) }}" class="btn btn-sm bg-teal">
                                        <i class="fas fa-eye"></i> Ver ficha
                                      </a>
                                      @if (auth()->user()->id === $resource->user_id)
                                        <button type="submit" class="btn btn-primary btn-sm" title="Editar">
                                            <i class="fas fa-pen"></i> Editar
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction(' . $resource->id . ')" title="Eliminar">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                        @endif
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                              {{ $resources->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <script>
        $('ul.pagination').hide();

        $(function() {
            $('.scrolling-pagination').jscroll({
                autoTrigger: true,
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scrolling-pagination',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
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