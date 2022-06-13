<div>

    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        @switch($accion)
                        @case('verNuevaOrden')

                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">
                                    Orden de Servicio #{{ $orden->IdOrdenServicio }}
                                </h4>
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-row">

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Tipo de Orden</label>
                                    <input class="form-control" value="{{ $orden->varTipoOrden }}" readOnly>

                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Fecha de Entrega</label>
                                    <input type="date" class="form-control" value="{{ $orden->dtFechaEntrega }}"
                                        readOnly>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Responsable</label>
                                    <input type="text" class="form-control" value="{{ $orden->varResponsable }}"
                                        readOnly>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Consecutivo</label>
                                    <input type="text" class="form-control" value="{{ $orden->varConsecutivo }}"
                                        readOnly>
                                </div>

                                <div class="col-sm-12 row">
                                    <div class="col-sm-6">
                                        <button wire:click="aprobarOrden" class="btn btn-sm btn-success">Aprobar</button>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <button wire:click="vistaRechazarOrden"
                                            class="btn btn-sm btn-danger">Rechazar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12 mb-3">
                                <h4 class="card-title">
                                    Productos
                                </h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-sm table-bordered table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Categoria</th>

                                        <th style="width: 30%">Referencia Salida</th>

                                        <th style="width: 30%">Referencia Entrada</th>

                                        <th style="width: 30%">Cantidad</th>

                                        <th style="width: 30%">Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orden->ordenDetalles as $item)
                                    <tr>
                                        <td>{{$item['varTipoProducto']}}</td>
                                        <td>
                                            <small>
                                            <b>REF:&nbsp;</b> {{$item->productoSale->varReferencia}} <br />
                                            <b>{{ $item->productoSale->varDescripcion}}</b><br />
                                            <b>Color:&nbsp;</b>{{$item->productoSale->varColor}}</small>
                                        </td>
                                        <td>
                                            <small>
                                            <b>REF:&nbsp;</b> {{$item->producto->varReferencia}} <br />
                                            <b>{{ $item->producto->varDescripcion}}</b><br />
                                            <b>Color:&nbsp;</b>{{$item->producto->varColor}}</small>
                                        </td>
                                        <td>{{$item['cantidad']}}</td>
                                        <td>{{$item['varPrecio']}}</td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                @break
                @case('rechazarOrden')


                <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                    <div class="header-title">
                        <h4 class="card-title">
                            Orden de Servicio #{{ $orden->IdOrdenServicio }}
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                        <div class="mb-12 col-md-12">
                            <label class="form-label">Observación de Rechazo</label>
                            <textarea class="form-control" wire:model="orden.varObservacion" rows="5"></textarea>
                        </div>

                        <div class="col-sm-12 mt-3 text-right">
                            <button wire:click="rechazarOrden" class="btn btn-sm btn-success">Enviar</button>
                        </div>
                </div>
            </div>
            @break
            @default
            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Nuevas Ordenes</h4>
                </div>
            </div>
            <div class="card-body">
                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Fecha de la Orden</th>
                            <th>Fecha Estimada</th>
                            <th>Fecha Real</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordenes as $item)
                        <tr>
                            <td>{{$item->varConsecutivo}}</td>
                            <td>{{$item->dtFecha}}</td>
                            <td>{{$item->dtFecha}}</td>
                            <td>{{$item->dtFechaEntrega}}</td>
                            <td>
                                <button wire:click="verNuevaOrden({{$item->IdOrdenServicio}})"
                                    class="btn btn-sm btn-info">Ver</button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @break
            @endswitch
        </div>
    </div>
</div>
</div>
</div>

</div>
