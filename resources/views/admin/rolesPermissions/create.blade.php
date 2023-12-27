@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>{{ __('Crear nuevo rol con permisos') }}</h1>
@stop

@section('content')
    <livewire:admin.roles-permissions-create />
@stop

@section('css')
    <style>
        .nav-link {
            color: #ffffff !important;
        }

        .navbar {
            background-color: #f461ab !important
        }

        .brand-link,
        .main-sidebar {
            background-color: #89004f !important;
            border-color: #89004f !important;
        }
    </style>
@endsection
