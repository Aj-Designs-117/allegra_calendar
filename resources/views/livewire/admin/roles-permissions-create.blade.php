<div class="card">
    <form wire:submit.prevent="store()">
        <div class="card-header">
            <div class="">
                <form wire:submit.prevent="store()">
                    <label class="form-label">{{ __('Nombre') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                        placeholder="Ingrese el nombre del rol" autocomplete="name" autofocus required>
                    <div class="d-flex justify-content-end">
                        @can('admin.rolesPermissions.store')
                            <x-adminlte-button class="mt-2" type="submit" label="{{ __('Guardar') }}"
                                theme="outline-success" icon="fas fa-lg fa-save" />
                        @endcan
                    </div>
                </form>
            </div>
        </div>

        @if ($permissions->count())
            <div class="card-body">
                @error('selectedPermissions')
                    <small class="text-danger">La seleccion de permisos es obligatoria</small>
                @enderror
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" wire:model="selectedPermissions" type="checkbox"
                                value="{{ $permission->name }}">
                            <p class="badge badge-primary ">{{ $permission->description }}</p> -----
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card-body">
                <strong>{{ __('No hay registros') }}</strong>
            </div>
        @endif
    </form>
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
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
