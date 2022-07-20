<div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                    @switch($accion)
                        @case('verOrden')

                        
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">
                                    Orden de Servicio #{{ $orden->varConsecutivo }}
                                </h4>
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Fecha de Entrega</label>
                                    <input type="date" class="form-control" value="{{ $orden->dtFechaEntrega }}"
                                        readOnly>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Responsable</label>
                                    <input type="text" class="form-control" value="{{ $orden->varResponsable }}"
                                        readOnly>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orden->ordenDetalles as $item)
                                    <tr>
                                        <td>{{$item['varTipoProducto']}}</td>
                                        <td>
                                        <small>
                                            <b>REF:&nbsp;</b> {{$item->producto->varReferencia}} <br />
                                            <b>{{ $item->producto->varDescripcion}}</b><br />
                                            <b>Color:&nbsp;</b>{{$item->producto->varColor}}
                                        </small>
                                        </td>
                                        <td>
                                        <small>
                                            <b>REF:&nbsp;</b> {{$item->productoSale->varReferencia}} <br />
                                            <b>{{ $item->productoSale->varDescripcion}}</b><br />
                                            <b>Color:&nbsp;</b>{{$item->productoSale->varColor}}
                                        </small>
                                        </td>
                                        <td>{{$item['cantidad']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 p-2">
                            <button wire:click="recibeProveedor"
                                                class="btn btn-sm btn-primary">Recibir</button>
                            </div>
                        </div>
                    </div>
                </div>

                @break
                @default
                        <div class="card-header d-flex justify-content-between"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Ordenes Despachadas</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table text-center'>
                                <thead>
                                    <tr>
                                        <th>Consecutivo</th>
                                        <th>Fecha</th>
                                        <th>Fecha de Entrega</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordenes as $orden)
                                    <tr>
                                        <td>{{ $orden->varConsecutivo }}</td>
                                        <td>{{ $orden->dtFecha }}</td>
                                        <td>{{ $orden->dtFechaEntrega }}</td>
                                        <td>{{ $orden->varConsecutivo }}</td>
                                        <td>
                                            <button wire:click="verOrden({{$orden->IdOrdenServicio}})"
                                                class="btn btn-sm btn-info">Ver</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $ordenes->links() }}
                        </div>
                    </div>
                    @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
