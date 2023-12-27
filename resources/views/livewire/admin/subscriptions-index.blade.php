<div>
    <div class="card">
        <div class="card-header">
            <x-adminlte-input type="search" wire:model.live="search" name="iSearch" label="{{ __('Buscar') }}"
                placeholder="Ingrese la descripcion o el precio" igroup-size="md">
                <x-slot name="prependSlot">
                    <div class="input-group-text text-primary">
                        <i class="fas fa-search"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        @if ($subscriptions->count())
            <div class="card-body" wire:poll.10s>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Decripcion</th>
                            <th scope="col">Clases faltantes</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha de inicio</th>
                            <th scope="col">Fecha de vencimiento</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <th scope="row">{{ $subscription->id }}</th>
                                <th scope="row">{{ $subscription->user->name }}</th>
                                <td>{{ $subscription->description }}</td>
                                <td>{{ $subscription->class_limit }} clases</td>
                                <td>${{ $subscription->price }}.00 mxn</td>
                                <td>{{ $subscription->start_date }}</td>
                                <td>{{ $subscription->end_date }}</td>
                                <td>
                                    @if ($subscription->status == 'Activo')
                                        <span class="badge badge-success">{{ $subscription->status }}</span>
                                    @elseif ($subscription->status == 'Inactivo')
                                        <span class="badge badge-secondary">{{ $subscription->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    @can('admin.subscriptions.package')
                                        <x-adminlte-button wire:click="show_subscription('{{ $subscription->id }}')"
                                            class="btn-sm" theme="warning" icon="fas fa-unlock-alt" data-toggle="modal"
                                            data-target="#assignModal" />
                                    @endcan
                                    @can('admin.subscriptions.destroy')
                                        <x-adminlte-button wire:click="destroy('{{ $subscription->id }}')" class="btn-sm"
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
    </div>

    <x-modal-bootstrap modal="assignModal">
        <x-slot name="title">{{ __('Renovacion de la suscripción del usuario') }}</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="renew_subscription('{{ $id }}')">
                <label class="form-label mt-2">{{ __('Descripcion') }}</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    wire:model="description" required placeholder="Ingrese la descripcion" autofocus
                    autocomplete="description">

                <label class="form-label mt-2">{{ __('Precio') }}</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" wire:model="price"
                    required placeholder="Ingrese el precio" autofocus autocomplete="price">

                <label class="form-label mt-2">{{ __('Numero de clases') }}</label>
                <input type="number" class="form-control @error('class_limit') is-invalid @enderror"
                    wire:model="class_limit" required placeholder="Ingrese el numero de clases" autofocus>

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
        </x-slot>

        <x-slot name="footer">
            @can('admin.subscriptions.store')
                <x-adminlte-button type="submit" label="{{ __('Guardar') }}" theme="success" icon="fas fa-lg fa-save" />
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
            $('#assignModal').modal('hide');
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
