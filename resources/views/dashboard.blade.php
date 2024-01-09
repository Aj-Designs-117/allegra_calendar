<x-base-layout>
    <div class="container mt-3 mb-5">
        <div class="row">
            <small class="text-danger mb-2"><span class="badge badge-warning">Advertencia:</span> Lea las reglas antes de
                agendar su clase.</small>
            <small class="text-primary mb-2"><span class="badge badge-primary">Guia:</span> Solo deben dar click sobre el
                horario deseado y dar click en el boton agendar.</small>
            <div class="col-md-6">
                <div id='calendar'></div>
            </div>
            <div class="col-md-6 mt-3">
                <table class="table table-striped" id="tableListAppointments">
                    <thead>
                        <tr>
                            <th scope="col">Clase</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="infoModal">{{ __('Informes de tu suscripción') }}</h1>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if ($subscriptions->status == 'Activo')
                        <div class="alert alert-success" role="alert">
                            <h5 class="card-title">Suscripción Activa</h5>
                        </div>
                        <label class="form-label">{{ __('Suscripción:') }} </label>
                        <input type="text" class="form-control" value="{{ $subscriptions->package->description }}"
                            disabled>
                        <label class="form-label mt-2">{{ __('Precio:') }} </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" value="{{ $subscriptions->package->price }}"
                                wire:model="price" required placeholder="Ingrese el precio" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text">.00 mxn</span>
                            </div>
                        </div>

                        <label class="form-label mt-2">{{ __('Clases faltantes:') }} </label>
                        <input type="text" class="form-control" value="{{ $subscriptions->limit_class }}" disabled>
                        <label class="form-label mt-2">{{ __('Fecha de suscripción:') }} </label>
                        <input type="text" class="form-control" value="{{ $subscriptions->start_date }}" disabled>
                        <label class="form-label mt-2">{{ __('Fecha de vencimiento:') }} </label>
                        <input type="text" class="form-control" value="{{ $subscriptions->end_date }}" disabled>
                    @elseif($subscriptions->status == 'Inactivo')
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Vencimiento de su suscripción</h4>
                            <p>Esperamos que se encuentre bien. Nos dirigimos a usted con respecto a su
                                suscripción y lamentamos informarle que su suscripción ha vencido.</p>
                            <hr>
                            <p class="mb-0">Si tiene alguna pregunta o tiene problemas con la aplicacion, contacte a
                                la administradora para ayudarle.</p>
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">No cuenta con una suscripcion</h4>
                            <p>Esperamos que se encuentre bien. Nos dirigimos a usted con respecto a su
                                suscripción y lamentamos informarle que aun no tiene suscripción.</p>
                            <hr>
                            <p class="mb-0">Si tiene alguna pregunta o tiene problemas con la aplicacion, contacte a
                                la administradora para ayudarle.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                        data-mdb-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Horario') }}</h1>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Appointmentform">
                        @csrf
                        <label class="form-label">{{ __('Clase:') }} </label>
                        <input type="text" class="form-control" name="eventTitle" id="eventTitle" disabled>
                        <label class="form-label mt-2">{{ __('Fecha:') }}</label>
                        <input type="date" id="eventDate" name="eventDate" class="form-control" disabled>
                        <label class="form-label mt-2">{{ __('hora:') }}</label>
                        <input type="time" id="eventTime" name="eventTime" class="form-control" disabled>
                        <label class="form-label mt-2">{{ __('Cupos disponibles:') }}</label>
                        <input type="text" id="appointmentQuota" class="form-control" disabled>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                        data-mdb-dismiss="modal">{{ __('Close') }}</button>
                    <button class="btn btn-success" type="submit">
                        <i class="fa-solid fa-calendar-check "></i>
                        Agendar
                    </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-base-layout>
