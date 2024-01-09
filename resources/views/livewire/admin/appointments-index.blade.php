<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">

            <div class="card-header">
                <x-adminlte-input wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
                    placeholder="Ingrese el titulo fecha" igroup-size="md">
                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
            </div>
            @if ($appointments->count())
                <div class="card-body table-responsive" wire:poll.10s>
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                @can('admin.appointments.destroy')
                                    <th scope="col">Acciones</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <th>{{ $appointment->user->name }}</th>
                                    <td>{{ $appointment->title }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>
                                        @can('admin.appointments.destroy')
                                            <x-adminlte-button
                                                wire:click="confirmDestroy('{{ $appointment->id }}', '{{ $appointment->event_id }}')"
                                                class="btn-sm" theme="danger" icon="fas fa-trash-alt" />
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    {{ $appointments->links() }}
                </div>
            @else
                <div class="card-body">
                    <strong>{{ __('No hay registros') }}</strong>
                </div>
            @endif

        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            toastr.options = {
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
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
        window.addEventListener('confirmDeleteAppointments', event => {
            const message = event.detail[0].message;
            const confirmButtonText = event.detail[0].confirmButtonText;

            Swal.fire({
                title: message,
                text: "Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: confirmButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy');
                }
            });
        });
        window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
