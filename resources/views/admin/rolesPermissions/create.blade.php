@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Toastr', true)

@section('content_header')
    <h1>{{ __('Crear nuevo rol con permisos') }}</h1>
@stop

@section('content')
    <livewire:admin.roles-permissions-create />
@stop