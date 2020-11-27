@extends('adminlte::page')

@section('title', 'Recursos')

@section('content_header')
<h1 class="m-0 text-dark">Recursos</h1>
@stop

@section('content')
@include('layouts.messages')

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
                    <a type="button" class="btn btn-primary" href="{{ url('recursos') }}/create">
                        <i class="fas fa-pen"></i> Nuevo recurso
                    </a>
                    <br />
                    <div class="scrolling-pagination">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                                @foreach($resources as $resource)
                                @if(($resource->published) || (Auth::user()->id === $resource->user_id && !$resource->published))
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light container-fluid">
                                        <div class="card-header text-muted border-bottom-0 h-10" style="height: 5.3rem;">
                                            {{ Str::limit($resource->title, 100) }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @switch($resource->mime_id)
                                                    @case(1)
                                                    <p>{{ $resource->body }}</p>
                                                    @break
                                                    @case(2)
                                                    @case(4)
                                                    <img class="img-responsive center-block d-block mx-auto img-fluid" src="{{ $resource->path }}">
                                                    @break
                                                    @case(3)
                                                    <video controls class="img-responsive center-block d-block mx-auto img-fluid">
                                                        <source src="storage/{{ $resource->path }}" type="video/mp4">
                                                        Lo siento, tu navegador no soporta vídeos incrustados.
                                                    </video>
                                                    @break
                                                    @endswitch
                                                    @foreach ($resource->hashtags as $item)
                                                    <a href="{{ route('recursos.hashtags.search') }}?q={{ $item->name }}">
                                                        <small class="mt-2 mb-2 btn btn-outline-primary btn-sm">{{ addHashTag($item->name) }}</small>
                                                    </a>
                                                    @endforeach
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small">
                                                            <div class="fa-li">
                                                                <i class="fas fa-lg fa-eye"></i>
                                                            </div>
                                                            {{ $resource->views }}
                                                        </li>
                                                        <li class="small">
                                                            <span class="fa-li">
                                                                <i class="fas fa-lg fa-cloud-download-alt"></i>
                                                            </span>
                                                            {{ $resource->downloads }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <form action="{{ route('recursos.show', $resource->id) }}" method="get">
                                                    @if (!$resource->published)
                                                    <a href="#" class="btn bg-warning btn-sm" title="Recurso tuyo NO publicado, por lo que otros dinamizadores NO lo pueden ver/usar">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('recursos.download', ['id' => $resource->id]) }}"
                                                        class="btn bg-teal btn-sm" title="Decargar recurso">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <a href="{{ route('recursos.show', $resource->id) }}" class="btn btn-sm @if (auth()->user()->id === $resource->user_id) btn-primary @else bg-teal @endif" title="Ver o editar recurso si procede">
                                                        <i class="fas fa-eye"></i> @if (auth()->user()->id === $resource->user_id) Ver/Editar @else Ver @endif recurso
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light container-fluid text-center">
                                        <div class="my-auto">
                                            <p class="btn bg-warning btn-sm">
                                                <i class="fas fa-eye-slash"></i>
                                            </p>
                                            <p>Recurso no publicado aún por su dinamizador</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
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

    $(function () {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function () {
                $('ul.pagination').remove();
            }
        });
    });

    function newResource() {
        window.location = "{{ url('recursos') }}/create";
    }
</script>
@stop