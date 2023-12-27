<div>
    <div class="card">
        <div class="card-header">
            <form wire:submit.prevent="store()">
                <label class="form-label">{{ __('Nombre') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                    placeholder="Ingrese el nombre del rol" autocomplete="name" autofocus required>
                <div class="d-flex justify-content-end">
                    @can('admin.roles.store')
                        <x-adminlte-button class="mt-2" type="submit" label="{{ __('Guardar') }}" theme="outline-success"
                            icon="fas fa-lg fa-save" />
                    @endcan
                </div>
            </form>
        </div>

        @if ($roles->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha/hora de creacion</th>
                            <th scope="col">Fecha/hora de actualizacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
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
    </div>
</div>

@push('js')
    <script>
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
            console.log(event.detail[0].message)
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
