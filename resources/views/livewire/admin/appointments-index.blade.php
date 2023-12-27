<div class="card">

    <div class="card-header">
        <x-adminlte-input wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
            placeholder="Ingrese el titulo fecha o nombre" igroup-size="md">
            <x-slot name="prependSlot">
                <div class="input-group-text text-primary">
                    <i class="fas fa-search"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    @if ($appointments->count())
        <div class="card-body" wire:poll.10s>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <th scope="row">{{ $appointment->id }}</th>
                            <th scope="row">{{ $appointment->user->name }}</th>
                            <td>{{ $appointment->title }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                <x-adminlte-button
                                    wire:click="destroy('{{ $appointment->id }}', '{{ $appointment->event_id }}')"
                                    class="btn-sm" theme="danger" icon="fas fa-trash-alt" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <strong>{{ __('No hay registros') }}</strong>
        </div>
    @endif

</div>

@push('js')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "positionClass": "toast-top-right",
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });

        window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
            console.log(event.detail[0].message)
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
