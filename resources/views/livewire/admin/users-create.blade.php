<div>
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createModal">
        {{ __('Crear nuevo usuario') }}
    </button>

    <x-modal-bootstrap modal="createModal">
        <x-slot name="title">{{ __('Usuario Nuevo') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="store()">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" required
                    placeholder="Ingrese el nombre del estudiante" autofocus autocomplete="name">
                <label class="form-label">{{ __('Correo') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                    required placeholder="Ingrese el correo del estudiante" autofocus autocomplete="email">
                <label class="form-label">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    wire:model="password" placeholder="Ingrese la contraseña del estudiante" required>
        </x-slot>

        <x-slot name="footer">
            @can('admin.users.store')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>
