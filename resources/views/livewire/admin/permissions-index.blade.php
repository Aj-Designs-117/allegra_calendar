<div>
    <div class="card">
        <div class="card-header">
            <form wire:submit.prevent="store()">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Ingrese el nombre del clave del permiso" autocomplete="name" autofocus required>
                <label class="form-label">{{ __('Slug') }}</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    wire:model="description" placeholder="Ingrese el nombre slug del permiso" autocomplete="description"
                    autofocus required>
                <div class="d-flex justify-content-end">
                    @can('admin.permissions.store')
                        <x-adminlte-button class="mt-2" type="submit" label="{{ __('Guardar') }}" theme="outline-success"
                            icon="fas fa-lg fa-save" />
                    @endcan
                </div>
            </form>
        </div>

        @if ($permissions->count())
            <div class="card-body">
                <label for="form-label">{{ __('Buscar') }}</label>
                <input wire:model.live="search" type="search" class="form-control"
                    placeholder="Ingrese la clave o slug">
                <table class="table table-striped table-responsive text-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha/hora de creacion</th>
                            <th scope="col">Fecha/hora de actualizacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $permission->id }}</th>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {{ $permissions->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>{{ __('No hay registros') }}</strong>
            </div>
        @endif
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

        window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
            console.log(event.detail[0].message)
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
