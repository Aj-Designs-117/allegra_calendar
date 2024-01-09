@extends('adminlte::page')

@section('title', 'Administracion')

@section('content')
    <livewire:admin.calendar-index />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
@endsection
