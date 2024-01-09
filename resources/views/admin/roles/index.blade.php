@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Toastr', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Crear nuevos roles') }}</h1>
    </div>
@stop

@section('content')
    <livewire:admin.roles-index>
@stop
