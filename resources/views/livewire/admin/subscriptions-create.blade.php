<div>
    <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#createModal">
        {{ __('Crear nueva suscripcion') }}
    </button>

    <x-modal-bootstrap modal="createModal">
        <x-slot name="title">{{ __('Nueva suscripcion') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="store()">
                <div class="mt-2">
                    <label class="form-label">{{ __('Nombre de usuario') }}</label>
                    <select class="custom-select" required wire:model="user_id">
                        <option>Seleccione al usuario...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->id }}. {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="form-label mt-2">{{ __('Descripcion') }}</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    wire:model="description" required placeholder="Ingrese la descripcion" autofocus
                    autocomplete="description">

                <label class="form-label">{{ __('Precio') }}</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" wire:model="price"
                    required placeholder="Ingrese el precio" autofocus autocomplete="price">

                <label class="form-label">{{ __('Numero de clases') }}</label>
                <input type="number" class="form-control @error('class_limit') is-invalid @enderror"
                    wire:model="class_limit" required placeholder="Ingrese el numero de clases" autofocus>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="Activo" wire:model="status" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Activo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                        value="Inactivo" wire:model="status">
                    <label class="form-check-label" for="exampleRadios2">
                        Inactivo
                    </label>
                </div>
        </x-slot>

        <x-slot name="footer">
            @can('admin.subscriptions.store')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>
