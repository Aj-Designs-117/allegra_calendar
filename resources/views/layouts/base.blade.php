<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agenda') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <style>
        .bg-pink {
            background-color: #F9A8D4 !important
        }

        .nav-link {
            color: #ffffff !important;
        }
    </style>

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg bg-pink navbar-light shadow-0 border-bottom">
        <div class="container">

            <!-- Toggle button -->
            <button data-mdb-collapse-init class="navbar-toggler" type="button"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('agenda') }}">
                    <x-application-mark class="mx-2 rounded-circle" />
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('agenda') }}">{{ __('Inicio') }}</a>
                    </li>
                    <li class="nav-item">
                        @can('admin.index')
                            <a class="nav-link" href="{{ route('admin.index') }}">{{ __('Administrador') }}</a>
                        @endcan
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-bs-toggle="modal"
                            data-bs-target="#infoModal">{{ __('Suscripción') }}</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <ul class="navbar-nav flex-row">
                <li class="nav-item dropdown">
                    <a data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow px-0" href="#"
                        id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                        <strong><small>{{ Auth::user()->name }}</small></strong>
                        {{-- <i class="fas fa-chevron-circle-down fa-md"></i> --}}
                        <i class="fa-solid fa-chevron-down fa-sm"></i>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <small class="text-body-secondary  dropdown-item">{{ __('Manage Account') }}</small>
                        <li>
                            @can('admin.profile.index')
                                <a class="dropdown-item border-bottom" href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </a>
                            @endcan
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Right elements -->
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        var urlGlobal = {!! json_encode(url('/')) !!}
    </script>
    @vite(['resources/js/fullcalendar.js'])


    @livewireScripts
</body>

</html>
