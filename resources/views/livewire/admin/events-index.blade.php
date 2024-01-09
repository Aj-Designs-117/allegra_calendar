<div class="card">
    <div class="card-header">
        <x-adminlte-input type="search" wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
            placeholder="Ingrese el titulo de la clase o el horario" igroup-size="md">
            <x-slot name="prependSlot">
                <div class="input-group-text text-primary">
                    <i class="fas fa-search"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    @if ($events->count())
        <div class="card-body table-responsive">
            <table class="table table-striped text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Dia</th>
                        <th scope="col">Horario de inicio</th>
                        <th scope="col">Horario final</th>
                        <th scope="col">Cupos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <th scope="row">{{ $event->id }}</th>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->daysOfWeek }}</td>
                            <td>{{ $event->startTime }}</td>
                            <td>{{ $event->endTime }}</td>
                            <td>{{ $event->max_quotas }}</td>
                            <td>
                                @can('admin.events.edit')
                                    <x-adminlte-button wire:click="edit('{{ $event->id }}')" class="btn-sm"
                                        theme="primary" icon="fas fa-edit" data-toggle="modal" data-target="#updateModal" />
                                @endcan
                                @can('admin.events.destroy')
                                    <x-adminlte-button wire:click="confirmDestroy('{{ $event->id }}')" class="btn-sm"
                                        theme="danger" icon="fas fa-trash-alt" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $events->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>{{ __('No hay registros') }}</strong>
        </div>
    @endif

    <x-modal-bootstrap modal="updateModal">
        <x-slot name="title">{{ __('Actualizar horario') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="update('{{ $id }}')">
                <label class="form-label">{{ __('Titulo') }}</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title"
                    placeholder="Ingrese el titulo del evento" required>

                <label class="form-label mt-2">{{ __('Hora de inicio') }}</label>
                <input type="time" class="form-control @error('startTime') is-invalid @enderror"
                    wire:model="startTime" required>

                <label class="form-label mt-2">{{ __('Hora final') }}</label>
                <input type="time" class="form-control @error('endTime') is-invalid @enderror" wire:model="endTime"
                    required>

                <label class="form-label mt-2">{{ __('Numero de cupos') }}</label>
                <input type="number" class="form-control @error('max_quotas') is-invalid @enderror"
                    wire:model="max_quotas" placeholder="Ingrese el numero de cupos" required>

                <label class="form-label mt-2">{{ __('Horario recurrente (Ingrese la columna del mes)') }}</label>
                <input type="number" max="6" class="form-control @error('daysOfWeek') is-invalid @enderror"
                    wire:model="daysOfWeek" placeholder="Ingrese el numero de columan del mes">

                <label class="form-label mt-2">{{ __('Color del Horario') }}</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" wire:model="color"
                    required>

                <label class="form-label mt-2">{{ __('Color del texto') }}</label>
                <input type="color" class="form-control @error('textColor') is-invalid @enderror"
                    wire:model="textColor" required>
        </x-slot>

        <x-slot name="footer">
            @can('admin.events.update')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#updateModal').modal('hide');
            $('#createModal').modal('hide');
        });

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
