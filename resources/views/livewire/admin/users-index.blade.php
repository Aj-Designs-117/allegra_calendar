<div>
    <div class="card-header">
        <x-adminlte-input type="search" wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
            placeholder="Ingrese el nombre o correo del usuario" igroup-size="md">
            <x-slot name="prependSlot">
                <div class="input-group-text text-primary">
                    <i class="fas fa-search"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    @if ($users->count())
        <div class="card-body" wire:poll.10s>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @can('admin.users.edit')
                                    <x-adminlte-button wire:click="edit('{{ $user->id }}')" class="btn-sm"
                                        theme="primary" icon="fas fa-edit" data-toggle="modal" data-target="#updateModal" />
                                @endcan
                                @can('admin.users.rol')
                                    <x-adminlte-button wire:click="edit('{{ $user->id }}')" class="btn-sm"
                                        label="{{ __('Asignar rol') }}" theme="warning" icon="fas fa-user-cog"
                                        data-toggle="modal" data-target="#rolModal" />
                                @endcan
                                @can('admin.users.destroy')
                                    <x-adminlte-button wire:click="destroy('{{ $user->id }}')" class="btn-sm"
                                        theme="danger" icon="fas fa-trash-alt" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>{{ __('No hay registros') }}</strong>
        </div>
    @endif

    <x-modal-bootstrap modal="updateModal">
        <x-slot name="title">{{ __('Actualizar usuario') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="update('{{ $id }}')">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Ingrese el nombre del estudiante" autocomplete="name" autofocus required>
                <label class="form-label">{{ __('Correo') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                    placeholder="Ingrese el correo del estudiante" autocomplete="email" autofocus required>
                <label class="form-label">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    wire:model="password" placeholder="Ingrese la contraseña del estudiante" autofocus>
        </x-slot>

        <x-slot name="footer">
            @can('admin.users.update')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>


    <x-modal-bootstrap modal="rolModal">
        <x-slot name="title">{{ __('Asigna un rol') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="assignArole({{ $id }})">

                <div class="card-header">
                    <label class="form-label">{{ __('Nombre') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                        disabled>
                </div>

                @if ($roles->count())

                    <div class="card-body">
                        @error('selectedPermissions')
                            <small class="text-danger">La seleccion de permisos es obligatoria</small>
                        @enderror
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" wire:model="selectedRoles" type="checkbox"
                                        value="{{ $role->name }}">
                                    <p class="badge badge-primary ">{{ $role->name }}</p>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="card-body">
                        <strong>{{ __('No hay registros') }}</strong>
                    </div>
                @endif


        </x-slot>

        <x-slot name="footer">
            @can('admin.users.storeRol')
                <x-adminlte-button type="submit" label="{{ __('Asignar') }}" theme="success"
                    icon="fas fa-lg fa-thumbs-up" />
            @endcan
            </form>
        </x-slot>
    </x-modal-bootstrap>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#createModal').modal('hide');
            $('#updateModal').modal('hide');
            $('#rolModal').modal('hide');
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
