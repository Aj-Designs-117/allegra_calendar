@extends('adminlte::page')

@section('title', 'Agendados')

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de agendados') }}</h1>
    </div>
@stop

@section('content')
    <livewire:admin.appointments-index>
@stop