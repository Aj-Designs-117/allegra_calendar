@extends('adminlte::page')

@section('title', 'Suscripciones')

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
