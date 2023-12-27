@extends('adminlte::page')

@section('title', 'Administracion')

@section('content')
    <livewire:admin.calendar-index />
@endsection

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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
@endsection
