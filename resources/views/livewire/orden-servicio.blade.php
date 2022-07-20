<div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">

                        @switch($accion)
                        @case('verOrdenServicio')

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

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Proveedor</label>
                                    <input type="selected" class="form-control"
                                        value="{{ $orden->proveedor->varNombreRazon }}" readOnly>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Cliente Asignado</label>
                                    <input type="selected" class="form-control"
                                        value="{{ $orden->cliente->varNombreRazon }}" readOnly>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Tipo de Orden</label>
                                    <input type="selected" class="form-control" value="{{ $orden->varTipoOrden }}"
                                        readOnly>

                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Fecha de Entrega</label>
                                    <input type="date" class="form-control" wire:model="orden.dtFechaEntrega" readOnly>
                                </div>
                                @if($orden->varObservacion != "")
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{$orden->varObservacion}}
                                    </div>
                                </div>
                                @endif

                                @if($orden->Estado == "RECHAZADA")
                                <div class="col-sm-12 row">
                                    <div class="col-sm-6">
                                        <button wire:click="Finalizar"
                                            class="btn btn-sm btn-danger p-2">Finalizar</button>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button wire:click="Reabrir" class="btn btn-sm btn-success p-2">Re-abrir
                                        </button>
                                    </div>
                                </div>
                                @endif

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
                                        <td>{{$item->varTipoProducto}}</td>
                                        <td>{{$item->productoSale->varReferencia}}</td>
                                        <td>{{$item->producto->varReferencia}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->varPrecio}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($orden->Estado == "FINALIZADO" || $orden->Estado == "PENDIENTE")
                    <!-- Esta parte contiene la tabla para el seguimiento de los productos recibidos -->
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12 mb-3">
                                <h4 class="card-title">
                                    Seguimiento de Productos
                                </h4>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-sm text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">Referencia Salida</th>

                                        <th style="width: 25%">Referencia Entrada</th>

                                        <th>Cantidad Total</th>

                                        <th>Total Recibidas</th>

                                        <th>Total Malas</th>

                                        @if($orden->Estado != "FINALIZADO")
                                        <th>Malas</th>

                                        <th>Acciones</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orden->ordenDetalles->where('enviadas', '!=', '') as $key => $item)
                                    <tr>
                                        <td>
                                            <small>
                                                <b>REF:&nbsp;</b> {{$item->productoSale->varReferencia}} <br />
                                                <b>{{ $item->productoSale->varDescripcion}}</b><br />
                                                <b>Color:&nbsp;</b>{{$item->productoSale->varColor}}
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                <b>REF:&nbsp;</b> {{$item->producto->varReferencia}} <br />
                                                <b>{{ $item->producto->varDescripcion}}</b><br />
                                                <b>Color:&nbsp;</b>{{$item->producto->varColor}}
                                            </small>
                                        </td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->enviadas?$item->enviadas:'Sin ingreso'}}</td>
                                        <td>{{$item->malas?$item->malas:'Sin ingreso'}}</td>
                                        @if($item->enviadas != $item->cantidad)
                                        <td>
                                            @if($item->enviadas <= $item->cantidad)
                                                <input type="text" class="form-control"
                                                    wire:model="productoOrden.{{$key}}.malas" />
                                                @else
                                                <b>Este producto Finalizo</b>
                                                @endif
                                        </td>
                                        @if($item->enviadas <= $item->cantidad)
                                            <td>
                                                <button wire:click="agregaMalas({{ $item->id }})"
                                                    class="btn btn-sm btn-success">Agregar</button>
                                            </td>
                                            @endif
                                            @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if($orden->Estado == 'PENDIENTE')
                    <div class="col-sm-12 text-right">

                            <button wire:click="finalizaOrden()" class="btn btn-sm btn-success px-3 mb-3 ">Finalizar
                            Orden</button>

                    </div>
                    @endif

                    @break

                    @case('formOrdenServicio')

                    <div class="card-header d-flex justify-content-between row"
                        style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            <h4 class="card-title">
                                @if($orden->IdOrdenServicio != "")
                                Orden de Servicio #{{ $orden->varConsecutivo }}
                                @else
                                Crear Orden de Servicio
                                @endif
                            </h4>
                        </div>
                        <div class="">
                            <button wire:click="volver"
                                class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-row">
                            <!-- Aqui comienza -->
                            <!-- Si es una orden que se va a crear mostrara el formulario -->
                            @if($orden->IdOrdenServicio == "")
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Proveedor *</label>

                                <x-select2 action="getProveedores" type="selected" class="form-control"
                                    method="calcularFechaEntrega" model="orden.varProveedor"
                                    default="{{ $orden->varProveedor }}"></x-select2>
                                @error('orden.varProveedor')
                                <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Cliente Asignado *</label>
                                <x-select2 action="getClientes" type="selected" class="form-control"
                                    model="orden.varCliente" default="{{ $orden->varCliente }}"></x-select2>
                                </select>
                                @error('orden.varCliente')
                                <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Tipo de Orden *</label>
                                <select class="form-control" wire:model="orden.varTipoOrden">
                                    <option>Seleccione...</option>
                                    <option wire:key="Pedido">Pedido</option>
                                    <option wire:key="Muestra">Muestra</option>
                                    <option wire:key="Garantia">Garantia</option>
                                </select>
                                @error('orden.varTipoOrden')
                                <span class='text-danger'>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Fecha de Entrega *</label>
                                <input type="date" class="form-control" wire:model="orden.dtFechaEntrega" readOnly>
                            </div>
                            @error('orden.dtFechaEntrega')
                            <span class='text-danger'>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 text-right">
                            <button wire:click="guardarOrdenServicio" class="btn btn-primary" type="submit">Crear <i
                                    class="bi bi-plus-circle"></i></button>
                        </div>
                        <!-- Aqui termina la dondicion para mostrar formulario -->



                        <!-- Aqui comienza la condition si no -->
                        <!-- En caso de que ya sea una orden creada no se mostrara para poder editar -->
                        @else

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Proveedor *</label>
                            <input type="selected" class="form-control" value="{{ $orden->proveedor->varNombreRazon }}"
                                readOnly>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Cliente Asignado *</label>
                            <input type="selected" class="form-control" value="{{ $orden->cliente->varNombreRazon }}"
                                readOnly>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Tipo de Orden *</label>
                            <input type="selected" class="form-control" value="{{ $orden->varTipoOrden }}" readOnly>

                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Fecha de Entrega *</label>
                            <input type="date" class="form-control" wire:model="orden.dtFechaEntrega" readOnly>
                        </div>

                        @if($orden->Estado == "REABIERTA")
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Fecha real de Entrega</label>
                            <input type="date" class="form-control" wire:model="orden.cambio_fecha">
                        </div>
                        @endif

                    </div>

                    @endif
                </div>
            </div>

            @if( $orden->IdOrdenServicio != "")
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-6 mb-3">
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

                                <th style="width: 25%">Referencia Salida</th>

                                <th style="width: 25%">Referencia Entrada</th>

                                <th style="width: 20%">Cantidad</th>

                                <th style="width: 30%">Costo</th>
                                <th style="width: 10%">Accion</th>

                            </tr>
                            <tr>
                                <th>
                                    <select type="selected" class="form-control"
                                        wire:model="productoOrden.varTipoProducto">
                                        <option>Seleccione...</option>
                                        <option value="Grifería Lavamanos Alta">Grifería Lavamanos Alta</option>
                                        <option value="Grifería Lavamanos Media">Grifería Lavamanos Media</option>
                                        <option value="Grifería Lavamanos Baja">Grifería Lavamanos Baja</option>
                                        <option value="Grifería Lavamanos de Pared">Grifería Lavamanos de Pared</option>
                                        <option value="Grifería Lavaplatos">Grifería Lavaplatos</option>
                                        <option value="Grifería de Ducha">Grifería de Ducha</option>
                                        <option value="Regadera o Ducha">Regadera o Ducha</option>
                                        <option value="Accesorios de baño">Accesorios de baño</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                    @php
                                    $restrictors=['tipoProducto' => 'productoOrden.varTipoProducto'];
                                    @endphp


                                </th>
                                @if(isset($productoOrden['varTipoProducto']))
                                <th>
                                    <x-select2 action="getProductos" class="form-control"
                                        model="productoOrden.ref_salida" :restrictors="$restrictors"></x-select2>
                                </th>

                                <th>
                                    <x-select2 action="getProductos" class="form-control"
                                        model="productoOrden.ref_entrada" :restrictors="$restrictors"></x-select2>
                                </th>
                                
                                <th>
                                    <input type="number" class="form-control" wire:model="productoOrden.cantidad">
                                </th>
                                <th>
                                    <input type="text" class="form-control" wire:model="productoOrden.varPrecio">
                                </th>
                                <th><button wire:click="agregarProducto" class="btn btn-success p-2"><i
                                            class="fas fa-plus"></i></button></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orden->ordenDetalles as $item)
                            <tr>
                                <td>{{$item['varTipoProducto']}}</td>
                                <td>
                                    @if($ref_salida =
                                    App\Models\Producto::where('IdPortafolio',$item['ref_salida'])->first())
                                    <small>
                                        <b>REF:&nbsp;</b> {{$ref_salida->varReferencia}} <br />
                                        <b>{{ $ref_salida->varDescripcion}}</b><br />
                                        <b>Color:&nbsp;</b>{{$ref_salida->varColor}}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($ref_entrada =
                                    App\Models\Producto::where('IdPortafolio',$item['ref_entrada'])->first())
                                    <small>
                                        <b>REF:&nbsp;</b> {{$ref_entrada->varReferencia}} <br />
                                        <b>{{ $ref_entrada->varDescripcion}}</b><br />
                                        <b>Color:&nbsp;</b>{{$ref_entrada->varColor}}</small>
                                    @endif
                                </td>
                                <td>{{$item['cantidad']}}</td>
                                <td>{{$item['varPrecio']}}</td>
                                <td><button wire:click="eliminaProductos({{$item->id}})"
                                        class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            @endforeach

                            @foreach($productoOrdenes as $key => $item)
                            <tr>
                                <td>{{$item['varTipoProducto']}}</td>
                                <td>
                                    @if($ref_salida =
                                    App\Models\Producto::where('IdPortafolio',$item['ref_salida'])->first())
                                    <small>
                                        <b>REF:&nbsp;</b> {{$ref_salida->varReferencia}} <br />
                                        <b>{{ $ref_salida->varDescripcion}}</b><br />
                                        <b>Color:&nbsp;</b>{{$ref_salida->varColor}}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($ref_entrada =
                                    App\Models\Producto::where('IdPortafolio',$item['ref_entrada'])->first())
                                    <small>
                                        <b>REF:&nbsp;</b> {{$ref_entrada->varReferencia}} <br />
                                        <b>{{ $ref_entrada->varDescripcion}}</b><br />
                                        <b>Color:&nbsp;</b>{{$ref_entrada->varColor}}</small>
                                    @endif
                                </td>
                                <td>{{$item['cantidad']}}</td>
                                <td>{{$item['varPrecio']}}</td>
                                <td><button wire:click="eliminaProducto({{$key}})" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12 px-3 pb-3 text-right">
                    <button wire:click="guardaProductos" class="btn btn-sm btn-success">Enviar a Aprobación</button>
                </div>
            </div>
        </div>
        @endif



        @break

        @default
        <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
            <div class="header-title">
                <h4 class="card-title">Ordenes de Servicio</h4>
            </div>
            <div class="">
                <button wire:click="crearOrdenServicio"
                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Orden
                    Servicio</button>
            </div>
        </div>
        <div class="card-body">
            <table class='table text-center'>
                <thead>
                    <tr>
                        <th>Consecutivo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($ordenes as $orden)
                    <tr>
                        <td>{{$orden->varConsecutivo}}</td>
                        <td>{{$orden->dtFecha}}</td>
                        <td>
                            @if($orden->Estado == '')
                            <span class="badge badge-warning">En Diligenciamiento</span>

                            @elseif($orden->Estado == 'APROBADA')
                            <span class="badge badge-success">Aprobada</span>

                            @elseif($orden->Estado == 'RECHAZADA')
                            <span class="badge badge-danger">Rechazada</span>

                            @elseif($orden->Estado == 'CREADO')
                            <span class="badge badge-warning">En revision</span>

                            @elseif($orden->Estado == 'ENVIADO')
                            <span class="badge badge-success">En Envio</span>

                            @elseif($orden->Estado == 'RECIBIDO')
                            <span class="badge badge-success">Recibido</span>

                            @elseif($orden->Estado == 'PENDIENTE')
                            <span class="badge badge-warning">Pendiente</span>

                            @elseif($orden->Estado == 'FINALIZADO')
                            <span class="badge badge-danger">Finalizado</span>

                            @elseif($orden->Estado == 'REABIERTA')
                                <span class="badge badge-primary">Re-abierta</span>
                            @endif
                        </td>
                        <td>{{$orden->varResponsable}}</td>
                        <td>
                            <button wire:click="verOrdenServicio({{ $orden->IdOrdenServicio }}) "
                                class="btn btn-sm btn-info">Ver</button>
                            <button wire:click="imprimePDF({{ $orden->IdOrdenServicio }}) "
                                class="btn btn-sm btn-info">Imprimir PDF</button>

                            @if($orden->Estado == '' || $orden->Estado == 'REABIERTA')
                            <button wire:click="editarOrdenServicio({{ $orden->IdOrdenServicio }})"
                                class="btn btn-sm btn-warning">Diligenciar</button>
                            @elseif($orden->Estado == 'CREADO')
                            @elseif($orden->Estado == 'APROBADA')
                            <button wire:click="enviaProducto({{ $orden->IdOrdenServicio }})"
                                class="btn btn-sm btn-success">Enviar&nbsp;<i class="fas fa-paper-plane"></i></button>
                            @elseif($orden->Estado == 'ENVIADO')

                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="col-sm-12 text-center">
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
<!-- Page end  -->
</div>