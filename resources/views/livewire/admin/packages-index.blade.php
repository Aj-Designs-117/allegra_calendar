<div class="card">
    <div class="card-header">
        <x-adminlte-input type="search" wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
            placeholder="Ingrese la descripción" igroup-size="md">
            <x-slot name="prependSlot">
                <div class="input-group-text text-primary">
                    <i class="fas fa-search"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    @if ($packages->count())
        <div class="card-body table-responsive" wire:poll.10s>
            <table class="table table-striped text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Clases</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <th scope="row">{{ $package->id }}</th>
                            <td>{{ $package->description }}</td>
                            <td>$ {{ $package->price }}.00</td>
                            <td>{{ $package->class }}</td>
                            <td>
                                @can('admin.packages.edit')
                                    <x-adminlte-button wire:click="edit('{{ $package->id }}')" class="btn-sm"
                                        theme="primary" icon="fas fa-edit" data-toggle="modal" data-target="#updateModal" />
                                @endcan
                                @can('admin.packages.destroy')
                                    <x-adminlte-button wire:click="confirmDestroy('{{ $package->id }}')" class="btn-sm"
                                        theme="danger" icon="fas fa-trash-alt" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {{ $packages->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>{{ __('No hay registros') }}</strong>
        </div>
    @endif

    <x-modal-bootstrap modal="updateModal">
        <x-slot name="title">{{ __('Actualizar paquete') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="update('{{ $id }}')">
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
                <input type="number" class="form-control @error('class') is-invalid @enderror" wire:model="class"
                    required placeholder="Ingrese el numero de clases">
        </x-slot>

        <x-slot name="footer">
            @can('admin.packages.update')
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
            $('#createModal').modal('hide');
        });

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
        window.addEventListener('confirmDeleteAppointments', event => {
            const message = event.detail[0].message;
            const confirmButtonText = event.detail[0].confirmButtonText;

            Swal.fire({
                title: message,
                text: "Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: confirmButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy');
                }
            });
        });
        window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
    </script>
@endpush
