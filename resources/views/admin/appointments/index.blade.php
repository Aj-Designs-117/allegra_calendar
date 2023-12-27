@extends('adminlte::page')

@section('title', 'Agendados')

@section('content_header')
    <div class="d-flex justify-content-between m-2">
        <h1>{{ __('Lista de agendados') }}</h1>
    </div>
@stop

@section('content')
    <livewire:admin.appointments-index>
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
