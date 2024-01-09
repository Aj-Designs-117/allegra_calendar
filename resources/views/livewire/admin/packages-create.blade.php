<div>
    <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#createModal">
        {{ __('Crear paquete') }}
    </button>

    <x-modal-bootstrap modal="createModal">
        <x-slot name="title">{{ __('Nuevo paquete') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="store()">
                <label class="form-label">{{ __('Descripcion') }}</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    wire:model="description" placeholder="Ingrese la descripcion del paquete" required>

                <label class="form-label mt-2">{{ __('Precio') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" wire:model="price"
                        required placeholder="Ingrese el precio" autofocus>
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <label class="form-label mt-2">{{ __('Numero de clases') }}</label>
                <input type="number" class="form-control @error('class') is-invalid @enderror"
                    wire:model="class" required placeholder="Ingrese el numero de clases">
        </x-slot>

        <x-slot name="footer">
            @can('admin.packages.update')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>
