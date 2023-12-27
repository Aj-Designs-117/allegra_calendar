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
        <div class="card-body" wire:poll.10s>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha</th>
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
                            <td>{{ $event->start }}</td>
                            <td>{{ $event->startTime }}</td>
                            <td>{{ $event->endTime }}</td>
                            <td>{{ $event->limited_quotas }}</td>
                            <td>
                                @can('admin.events.edit')
                                    <x-adminlte-button wire:click="edit('{{ $event->id }}')" class="btn-sm"
                                        theme="primary" icon="fas fa-edit" data-toggle="modal" data-target="#updateModal" />
                                @endcan
                                @can('admin.events.destroy')
                                    <x-adminlte-button wire:click="destroy('{{ $event->id }}')" class="btn-sm"
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
                    required placeholder="Ingrese el titulo del horario" autofocus autocomplete="title">

                <hr>
                <label class="form-label">{{ __('Fecha de inicio') }}</label>
                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror"
                    wire:model="start">

                <label class="form-label mt-2">{{ __('Fecha final') }}</label>
                <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" wire:model="end">

                <label class="form-label mt-2">{{ __('Numero de cupos') }}</label>
                <input type="number" class="form-control @error('limited_quotas') is-invalid @enderror"
                    wire:model="limited_quotas">

                <hr>
                <label class="form-label">{{ __('Horario recurrente (Ingrese la columna del mes)') }}</label>
                <input type="number" max="7" class="form-control @error('daysOfWeek') is-invalid @enderror"
                    wire:model="daysOfWeek">

                <label class="form-label mt-2">{{ __('Hora de inicio') }}</label>
                <input type="time" class="form-control @error('startTime') is-invalid @enderror"
                    wire:model="startTime">

                <label class="form-label mt-2">{{ __('Hora final') }}</label>
                <input type="time" class="form-control @error('endTime') is-invalid @enderror" wire:model="endTime">
                <hr>

                <label class="form-label mt-2">{{ __('Color del Horario') }}</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" wire:model="color"
                    required autofocus>

                <label class="form-label mt-2">{{ __('Color del texto') }}</label>
                <input type="color" class="form-control @error('textColor') is-invalid @enderror"
                    wire:model="textColor" required autofocus>

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
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
