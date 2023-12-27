@extends('adminlte::page')

@section('title', 'Eventos')

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

    @section('css')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
