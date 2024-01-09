@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de roles') }}</h1>
        @can('admin.rolesPermissions.create')
            <a href="{{ route('admin.rolesPermissions.create') }}" class="btn btn-outline-success">Crear nuevo rol</a>
        @endcan
    </div>
@stop

@section('content')
    <div class="card">
        <livewire:admin.roles-permissions-index>
    </div>
@stop
