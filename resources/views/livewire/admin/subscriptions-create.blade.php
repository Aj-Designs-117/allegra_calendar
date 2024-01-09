<div>
    <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#createModal">
        {{ __('Crear nueva suscripcion') }}
    </button>

    <x-modal-bootstrap modal="createModal">
        <x-slot name="title">{{ __('Nueva suscripcion') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="store()">
                <div class="mt-2">
                    <label class="form-label">{{ __('Selecione el nombre del usuario') }}</label>
                    <select class="custom-select @error('user_id') is-invalid @enderror" required wire:model="user_id">
                        <option>Seleccione al usuario...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->id }}. {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <label class="form-label">{{ __('Selecione el paquete') }}</label>
                    <select class="custom-select @error('package_id') is-invalid @enderror" wire:model.live="package_id"
                        required>
                        <option>Seleccione el paquete...</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->description }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($package_id)
                    <label class="form-label mt-2">{{ __('Descripcion') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                        wire:model="description" required placeholder="Ingrese la descripcion"
                        autocomplete="description" disabled>

                    <label class="form-label mt-2">{{ __('Precio') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                            wire:model="price" required placeholder="Ingrese el precio" autofocus disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                    <label class="form-label mt-2">{{ __('Numero de clases') }}</label>
                    <input type="number" class="form-control @error('limit_class') is-invalid @enderror"
                        wire:model="limit_class" required placeholder="Ingrese el numero de clases" disabled>

                    <label class="form-label mt-2">{{ __('Selecciones el estatus') }}</label>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                            value="Activo" wire:model="status" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Activo
                        </label>
                    </div>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                            value="Inactivo" wire:model="status">
                        <label class="form-check-label" for="exampleRadios2">
                            Inactivo
                        </label>
                    </div>
                @endif
        </x-slot>

        <x-slot name="footer">
            @can('admin.subscriptions.store')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>
