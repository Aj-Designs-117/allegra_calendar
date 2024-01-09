@extends('adminlte::page')

@section('title', 'Permisos')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Crear nuevos permisos') }}</h1>
    </div>
@stop

@section('content')
    <livewire:admin.permissions-index>
@stop