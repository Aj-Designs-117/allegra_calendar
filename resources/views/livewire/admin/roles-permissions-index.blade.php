<div>
    @if ($roles->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{ $role->id }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('admin.rolesPermissions.edit')
                                    <x-adminlte-button wire:click="edit('{{ $role->id }}')" class="btn-sm" theme="primary"
                                        icon="fas fa-edit" data-toggle="modal" data-target="#updateModal" />
                                @endcan
                                @can('admin.rolesPermissions.destroy')
                                    <x-adminlte-button wire:click="destroy('{{ $role->id }}')" class="btn-sm"
                                        theme="danger" icon="fas fa-trash-alt" />
                                @endcan
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

    <x-modal-bootstrap modal="updateModal">
        <x-slot name="title">{{ __('Actualizar rol') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="update('{{ $id }}')">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control mb-2 @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Ingrese el nombre del rol" autocomplete="name" autofocus required>

                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" wire:model="selectedPermissions" type="checkbox"
                                value="{{ $permission->name }}">
                            <p class="badge badge-primary ">{{ $permission->description }}</p>
                        </label>
                    </div>
                @endforeach
        </x-slot>

        <x-slot name="footer">
            @can('admin.rolesPermissions.update')
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
        window.addEventListener('warning', event => {
            toastr.success(event.detail[0].message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
