@extends('adminlte::page')

@section('title', 'Mi Agenda')

@section('content_header')
<h1 class="m-0 text-dark">Mi Agenda</h1>
@stop

@section('content')
@include('layouts.messages')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.css'/>
            
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0 mb-2">Organiza tu día a día y planifica tu semana.</p>
                <a type="button" class="btn btn-primary" href="{{ url('appointment') }}/create"><i class="fas fa-calendar-plus"></i> Nueva cita</a>
                <br>
                <div class="box-body table-responsive">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.4.0/locales/es.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            events ={!! json_encode($events) !!};
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                events: events,
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
@stop