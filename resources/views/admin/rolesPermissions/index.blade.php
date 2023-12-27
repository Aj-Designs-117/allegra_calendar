@extends('adminlte::page')

@section('title', 'Roles')

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

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .nav-link{ color: #ffffff !important; }
        .navbar{ background-color: #f461ab !important }
        .brand-link,.main-sidebar{ background-color:  #89004f  !important; border-color: #89004f  !important;  }
    </style>
@endsection

