@extends('adminlte::page')

@section('title', 'Eventos')

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de Eventos') }}</h1>
        @can('admin.events.create')
            <livewire:admin.events-create>
        @endcan
    </div>
@stop

@section('content')
    <livewire:admin.events-index>
@stop
