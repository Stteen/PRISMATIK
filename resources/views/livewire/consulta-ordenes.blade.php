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
                                    <th style="width: 20%">Referencia Salida</th>

                                    <th style="width: 30%">Descripcion Salida</th>

                                    <th style="width: 30%">Referencia de Entrada</th>

                                    <th style="width: 30%">Descripcion Entrada</th>

                                    <th style="width: 30%">Cantidad</th>

                                    <th style="width: 30%">Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orden->ordenDetalles->count()>0)
                                @foreach($orden->ordenDetalles as $item)
                                <tr>
                                    <td>{{$item->productoSale->varReferencia}}</td>
                                    <td>{{$item->productoSale->varDescripcion}}
                                        <p class="text-muted">{{$item->productoSale->varColor}}</p>
                                    </td>
                                    <td>{{$item->producto->varReferencia}}</td>
                                    <td>{{$item->producto->varDescripcion}}
                                    <p class="text-muted">{{$item->producto->varColor}}</p>
                                    </td>
                                    <td>{{$item->cantidad}}</td>
                                    <td>{{$item->varPrecio}}</td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">No hay productos</td>
                                    </tr>   
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @break

            @case('Pendientes')
            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Ordenes Pendientes</h4>
                </div>
                <div class="">
                    <button wire:click="volver"
                        class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>

                </div>
            </div>
            <div class="card-body">

                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Fecha de Generación</th>
                            <th>Tipo de Orden</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendientes as $item)
                        <tr>
                            <td>
                                {{ $item->varConsecutivo }}
                            </td>
                            <td>
                                {{ $item->dtFecha }}
                            </td>
                            <td>
                                {{ $item->varTipoOrden }}
                            </td>
                            <td>
                                {{ $item->dtFechaEntrega }}
                            </td>
                            <td>
                                {{ $item->Estado }}
                            </td>
                            <td>
                                <button wire:click="verOrden({{$item->IdOrdenServicio}})"
                                    class="btn btn-sm btn-primary">Ver</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Linea que coloca el paginador del listadpo -->
            </div>
            @break

            @case('Abiertas')

            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Ordenes Abiertas</h4>
                </div>
                <div class="">
                    <button wire:click="volver"
                        class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>

                </div>
            </div>
            <div class="card-body">

                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Fecha de Generación</th>
                            <th>Tipo de Orden</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($abiertas as $item)
                        <tr>
                            <td>
                                {{ $item->varConsecutivo }}
                            </td>
                            <td>
                                {{ $item->dtFecha }}
                            </td>
                            <td>
                                {{ $item->varTipoOrden }}
                            </td>
                            <td>
                                {{ $item->dtFechaEntrega }}
                            </td>
                            <td>
                                {{ $item->Estado }}
                            </td>
                            <td>
                                <button wire:click="verOrden({{$item->IdOrdenServicio}})"
                                    class="btn btn-sm btn-primary">Ver</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Linea que coloca el paginador del listadpo -->
            </div>

            @break

            @case('Cerradas')

            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Ordenes Cerradas</h4>
                </div>
                <div class="">
                    <button wire:click="volver"
                        class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>

                </div>
            </div>
            <div class="card-body">

                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Fecha de Generación</th>
                            <th>Tipo de Orden</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cerradas as $item)
                        <tr>
                            <td>
                                {{ $item->varConsecutivo }}
                            </td>
                            <td>
                                {{ $item->dtFecha }}
                            </td>
                            <td>
                                {{ $item->varTipoOrden }}
                            </td>
                            <td>
                                {{ $item->dtFechaEntrega }}
                            </td>
                            <td>
                                {{ $item->Estado }}
                            </td>
                            <td>
                                <button wire:click="verOrden({{$item->IdOrdenServicio}})"
                                    class="btn btn-sm btn-primary">Ver</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Linea que coloca el paginador del listadpo -->
            </div>

            @break

            @case('totalGeneradas')

            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Ordenes Totales</h4>
                </div>
                <div class="">
                    <button wire:click="volver"
                        class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>

                </div>
            </div>
            <div class="card-body">

                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Consecutivo</th>
                            <th>Fecha de Generación</th>
                            <th>Tipo de Orden</th>
                            <th>Fecha de Entrega</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalGeneradas as $item)
                        <tr>
                            <td>
                                {{ $item->varConsecutivo }}
                            </td>
                            <td>
                                {{ $item->dtFecha }}
                            </td>
                            <td>
                                {{ $item->varTipoOrden }}
                            </td>
                            <td>
                                {{ $item->dtFechaEntrega }}
                            </td>
                            <td>
                                {{ $item->Estado }}
                            </td>
                            <td>
                                <button wire:click="verOrden({{$item->IdOrdenServicio}})"
                                    class="btn btn-sm btn-primary">Ver</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Linea que coloca el paginador del listadpo -->
            </div>

            @break
            @default
            <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                <div class="header-title">
                    <h4 class="card-title">Trazabilidad de Ordenes</h4>
                </div>
            </div>
            <div class="card-body">

                <table class='table text-center'>
                    <thead>
                        <tr>
                            <th>Nombre Proveedor</th>
                            <th>Total Pendientes</th>
                            <th>Total Abiertas</th>
                            <th>Total Cerradas</th>
                            <th>Total Generadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ordenes as $item)
                        <tr>
                            <td>
                                {{ $item->proveedor->varNombreRazon }}
                            </td>
                            <td>
                                <button wire:click="pendientes({{$item->proveedor->IdProveedores}})"
                                    class="btn btn-warning px-2 pl-3 pr-3 border-0"
                                    style="background-color:#f9f0ec; border-radius: 100px;"><b style="color:#dd2222;">
                                        {{ $item->where('Estado', 'ENVIADO')->where('varProveedor', $item->proveedor->IdProveedores)->count() }}</b></button>
                            </td>
                            <td>
                                <button wire:click="abiertas({{$item->proveedor->IdProveedores}})"
                                    class="btn btn-secondary px-2 pl-3 pr-3 border-0"
                                    style="background-color:#CFFFCE; border-radius: 100px;"><b style="color:#04CD00;">
                                        {{ $item->where('Estado', 'RECIBIDO')->where('varProveedor', $item->proveedor->IdProveedores)->count() }}</b></button>
                            </td>
                            <td>
                                <button wire:click="cerradas({{$item->proveedor->IdProveedores}})"
                                    class="btn px-2 pl-3 pr-3 border-0"
                                    style="background-color:#D8D8D8; border-radius: 100px;"><b style="color:#322F2F;">
                                        {{ $item->where('Estado', 'FINALIZADO')->where('varProveedor', $item->proveedor->IdProveedores)->count() }}</b></button>
                            </td>
                            <td>
                                <button wire:click="totalGeneradas({{$item->proveedor->IdProveedores}})"
                                    class="btn btn-info px-2 pl-3 pr-3 border-0"
                                    style="background-color:#CFDAFF; border-radius: 100px;"><b style="color:#000000;">
                                        {{ $item->where('varProveedor', $item->proveedor->IdProveedores)->count() }}</b></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Linea que coloca el paginador del listadpo -->
            </div>
            @break
            @endswitch
        </div>
    </div>
</div>
</div>
</div>
</div>
