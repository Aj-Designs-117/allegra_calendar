@extends('adminlte::page')

@section('title', 'Usuarios')

@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de usuarios') }}</h1>
        @can('admin.users.create')
            <livewire:admin.users-create />
        @endcan
    </div>
@stop

@section('content')
    <div class="card">
        <livewire:admin.users-index />
    </div>
@stop
