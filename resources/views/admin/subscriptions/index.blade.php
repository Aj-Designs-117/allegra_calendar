@extends('adminlte::page')

@section('title', 'Suscripciones')

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de suscripciones') }}</h1>
        @can('admin.subscriptions.create')
            <livewire:admin.subscriptions-create>
        @endcan
    </div>
@stop

@section('content')
    <livewire:admin.subscriptions-index>
@stop
