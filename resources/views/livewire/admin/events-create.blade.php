<div>
    <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#createModal">
        {{ __('Crear eventos') }}
    </button>

    <x-modal-bootstrap modal="createModal">
        <x-slot name="title">{{ __('Nuevo evento') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="store()">
                <label class="form-label">{{ __('Titulo') }}</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title"
                    required placeholder="Ingrese el titulo del evento" autofocus autocomplete="title">

                <label class="form-label">{{ __('Fecha de inicio') }}</label>
                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror"
                    wire:model="start">

                <label class="form-label mt-2">{{ __('Fecha final') }}</label>
                <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" wire:model="end">

                <label class="form-label mt-2">{{ __('Numero de cupos') }}</label>
                <input type="number" class="form-control @error('limited_quotas') is-invalid @enderror"
                    wire:model="limited_quotas" placeholder="Ingrese el numero de cupos">

                <label class="form-label">{{ __('Color del Horario') }}</label>
                <input type="color" class="form-control @error('color') is-invalid @enderror" wire:model="color"
                    required autofocus>

                <label class="form-label mt-2">{{ __('Color del texto') }}</label>
                <input type="color" class="form-control @error('textColor') is-invalid @enderror"
                    wire:model="textColor" required autofocus>

                <hr class="mb-1">
                <p class="text-danger h5">Eventos fijos (opcional)</p>
                <label class="form-label">{{ __('Horario recurrente (Ingrese la columna del mes)') }}</label>
                <input type="number" max="7" class="form-control @error('daysOfWeek') is-invalid @enderror"
                    wire:model="daysOfWeek" placeholder="Ingrese el numero de columan del mes">

                <label class="form-label mt-2">{{ __('Hora de inicio') }}</label>
                <input type="time" class="form-control @error('startTime') is-invalid @enderror"
                    wire:model="startTime">

                <label class="form-label mt-2">{{ __('Hora final') }}</label>
                <input type="time" class="form-control @error('endTime') is-invalid @enderror" wire:model="endTime">
                <hr>
        </x-slot>

        <x-slot name="footer">
            @can('admin.events.store')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>
