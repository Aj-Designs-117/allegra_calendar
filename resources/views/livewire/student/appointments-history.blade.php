<div>
  <div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-search text-primary"></i></span>
                    <input type="search" wire:model.live="search" class="form-control"
                        placeholder="Ingrese el nombre o fecha para su busquedad" />
                </div>
            </div>
           <div class="card-body">
                @if ($records->count())
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->date }}</td>
                                    <td>{{ $record->time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <div class="d-flex justify-content-end">
                        {{ $records->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <strong>{{ __('No hay registros') }}</strong>
                    </div>
                @endif
           </div>
        </div>
    </div>
  </div>
</div>
