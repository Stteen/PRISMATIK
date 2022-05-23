<div>
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">

                    @switch($accion)

                    @case('verOrdenServicio')


                    @break

                    @case('formOrdenServicio')
                    @if(isset($mensaje['message']))
                    <div id="flash-message" class="alert alert-{{ $mensaje['type'] }}" >
                        {{$mensaje['message']}}
                    </div>
                    @endif
                    <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            <h4 class="card-title">
                                @if(isset($orden['idOrdenServicio']))
                                Editar Orden de Servicio #{{$orden['idOrdenServicio']}}
                                @else
                                Crear Orden de Servicio 
                                @endif
                            </h4>
                        </div>
                        <div class="">
                            <button wire:click="volver" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button> 
                        </div>
                    </div>
                    <div class="card-body">

                    <div class="form-row">

                                <div class="mb-3 col-md-4">
                                <label class="form-label">Proveedor *</label>
                                <select type="selected" class="form-control" wire:model="orden.varProveedor">
                                    <option>
                                        @if(isset($orden['idOrdenServicio']))
                                        {{$orden['varProveedor']}}
                                        @else
                                        Seleccione ...
                                        @endif
                                    </option>
                                    @foreach($proveedores as $proveedor)
                                        <option wire:key="{{$proveedor['IdProveedores']}}" value="{{$proveedor['varNombreConta']}}">{{$proveedor['varNombreConta']}}</option>
                                    @endforeach
                                </select>
                                @error('orden.varProveedor')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                <label class="form-label">Responsable *</label>
                                <input type="text" class="form-control" wire:model="orden.varResponsable" >
                                @error('orden.varResponsable')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
              
                                <div class="mb-3 col-md-4">
                                <label class="form-label">Cliente Asignado *</label>
                                <select type="selected" class="form-control" wire:model="orden.varCliente">
                                    <option>
                                    </option>
                                    @foreach($clientes as $cliente)
                                        <option wire:key="{{$cliente['idClientes']}}" value="{{$cliente['varNombreConta']}}">{{$cliente['varNombreConta']}}</option>
                                    @endforeach
                                </select>
                                @error('orden.varCliente')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                <label class="form-label">Tipo de Orden *</label>
                                <select type="selected" class="form-control" wire:model="orden.varTipoOrden">
                                    <option> Seleccione...</option>
                                    <option wire:key="Orden de Pedido">Orden de Pedido</option>
                                    <option wire:key="Orden de Muestra">Orden de Muestra</option>
                                </select>
                                @error('orden.varTipoOrden')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                <label class="form-label">Fecha de Entrega *</label>
                                <input type="date" class="form-control" wire:model="orden.dtFechaEntrega" >
                                </div>
                                @error('orden.dtFechaEntrega')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                
                                <div class="col-sm-12 text-right">
                               <button wire:click="guardarOrdenServicio" class="btn btn-primary" type="submit">Crear <i class="bi bi-plus-circle"></i></button>
                               </div>

                               @if(isset($orden['idOrdenServicio']))
                               <div class="col-sm-12 mt-5">
                                    <h3>Productos de la Orden</h3>
                                    <hr />
                                </div>
                                
                               <div class="col-sm-12 mt-3">
                                <table class="table table-sm table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Referencia Salida</th>
                                            <th>Color Salida</th>
                                            <th>Referencia Entrada</th>
                                            <th>Color Entrada</th>
                                            <th>Acciones</th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <select type="selected" class="form-control" wire:model="productoOrden.producto">
                                                    <option></option>
                                                    @foreach($productos as $producto)
                                                        <option>{{$producto['varReferencia']}}</option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control" wire:model="productoOrden.cantidad"></th>
                                            <th><input type="text" class="form-control" wire:model="productoOrden.refSalida"></th>
                                            <th><input type="text" class="form-control" wire:model="productoOrden.colorSalida"></th>
                                            <th><input type="text" class="form-control" wire:model="productoOrden.refEntrada"></th>
                                            <th><input type="text" class="form-control" wire:model="productoOrden.colorEntrada"></th>
                                            <th><button wire:click="agregarProducto" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productoOrdenes as $item)
                                            <tr>
                                                <td>{{$item['producto']}}</td>
                                                <td>{{$item['cantidad']}}</td>
                                                <td>{{$item['refSalida']}}</td>
                                                <td>{{$item['colorSalida']}}</td>
                                                <td>{{$item['refEntrada']}}</td>
                                                <td>{{$item['colorEntrada']}}</td>
                                                <td><button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                                @endif
   

                            </div>
                        </div>
                    @break

                    @default
                    <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            <h4 class="card-title">Ordenes de Servicio</h4>
                        </div>
                        <div class="">
                            <button wire:click="crearOrdenServicio" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Orden Servicio</button> 
                        </div>
                    </div>
                    <div class="card-body">

                    <table class='table table-bordered table-sm text-center'>
                                    <thead>
                                        <tr>
                                            <th>Consecutivo</th>
                                            <th>Fecha</th>
                                            <th>Tipo de Orden</th>
                                            <th>Responsable</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($ordenes as $orden)
                                            <tr @if($orden['bolEstado']==false)
                                            class="table-danger"
                                            @endif>
                                                <td>{{$orden['varConsecutivo']}}</td>
                                                <td>{{$orden['dtFecha']}}</td>
                                                <td>{{$orden['varTipoOrden']}}</td>
                                                <td>{{$orden['varResponsable']}}</td>
                                                <td>
                                                @if($orden['bolEstado']==false)
                                                <button wire:click="activarOrdenServicio({{$orden['idOrdenServicio']}})" class="btn btn-success btn-sm "><i class="fa fa-check" ></i></button>
                                                @else
                                                    <button wire:click="editarOrdenServicio({{ $orden['idOrdenServicio']}})" class="btn btn-sm btn-warning">Editar</button>
                                                    <button wire:click="desactivarOrdenServicio({{$orden['idOrdenServicio']}})" class="btn btn-sm btn-danger">Inactivar</button>
                                                @endif
                                                <button wire:click="verOrdenServicio" class="btn btn-sm btn-info">Ver</button>
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
        <!-- Page end  -->
</div>
