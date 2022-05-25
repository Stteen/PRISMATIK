<div>
<div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    @if(isset($mensaje['message']))
                    <div class="alert alert-{{ $mensaje['type'] }}">
                        {{$mensaje['message']}}
                    </div>
                    @endif
                    <div class="card">

                        @switch($accion)

                        @case('verproveedor')

                        <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">
                                    Proveedor: {{ $proveedor['varNombreConta']}} - {{$proveedor['intNumeroDoc']}}
                                </h4>
                            </div>
                            <div class="">
                                <a wire:click='volver' class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <b>Tipo de Identificación:</b> {{$proveedor['varTipoDoc']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Identificación:</b> {{$proveedor['intNumeroDoc']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Razón Social:</b> {{$proveedor['varNombreRazon']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Teléfono:</b>    {{$proveedor['varTelefono']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Correo:</b>  {{$proveedor['varCorreo']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Nombre del Contacto:</b> {{$proveedor['varNombreConta']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Teléfono Contacto:</b>   {{$proveedor['varTelefonoConta']}}
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <b>Plazo (Días):</b>    {{$proveedor['intPlazoEntr']}}
                                </div>
                                <div class="col-lg-12 ">
                                    <b>Dirección:</b>   {{$proveedor['varDireccion']}}
                                </div>

                            </div>

                        </div>

                        @break

                        @case('formproveedor')

                        <div class="card-header d-flex justify-content-between row">
                            <div class="header-title">
                                <h4 class="card-title">
                                    @if(!isset($proveedor['IdProveedores']))
                                    Crear Proveedor
                                    @else
                                    Editar Proveedor
                                    @endif
                                </h4>
                            </div>
                            <div class="">
                                <a wire:click='volver' class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <b>Tipo de Identificación:</b>
                                    <select wire:model='proveedor.varTipoDoc' class="form-control">
                                        <option>Seleccione...</option>
                                        <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                        <option value="NIT">NIT</option>
                                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                    @error('proveedor.varTipoDoc')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Identificación:</b>
                                    <input wire:model='proveedor.intNumeroDoc' type="number" class="form-control" placeholder="Identificación">
                                    @error('proveedor.intNumeroDoc')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Razón Social:</b>
                                    <input wire:model='proveedor.varNombreRazon' type="text" class="form-control" placeholder="Nombre">
                                    @error('proveedor.varNombreRazon')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Teléfono:</b>
                                    <input wire:model='proveedor.varTelefono' type="number" class="form-control" placeholder="Teléfono">
                                    @error('proveedor.varTelefono')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Correo:</b>
                                    <input wire:model='proveedor.varCorreo' type="email" class="form-control" placeholder="Correo">
                                    @error('proveedor.varCorreo')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Nombre del Contacto:</b>
                                    <input wire:model='proveedor.varNombreConta' type="text" class="form-control" placeholder="Nombre del Contacto">
                                    @error('proveedor.varNombreConta')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-12">
                                    <b>Dirección:</b>
                                    <input wire:model='proveedor.varDireccion' type="text" class="form-control" placeholder="Dirección">
                                    @error('proveedor.varDireccion')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Teléfono Contacto:</b>
                                    <input wire:model='proveedor.varTelefonoConta' type="text" class="form-control" placeholder="Teléfono Contacto">
                                    @error('proveedor.varTelefonoConta')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Plazo (Días):</b>
                                    <input wire:model="proveedor.intPlazoEntr" type="number" class="form-control" placeholder="plazo de entrega">
                                    @error('proveedor.intPlazoEntr')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="col-lg-12 mt-4 text-right">
                                    <button type="button" wire:click="guardarproveedor" class="btn btn-success">Guardar</button>
                                </div>



                            </div>

                        </div>
                        @break
                    @default
                <div class="col-sm-12 col-lg-12">
           
                    <div class="card-header d-flex justify-content-between row">
                        <div class="header-title">
                            <h4 class="card-title">Proveedores</h4>
                        </div>
                        <div class="">
                            <button wire:click="crearproveedor" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Proveedor</button> 
                        </div>
                    </div>
                    <div class="card-body">

                    <table class='table table-bordered table-sm text-center'>
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Razon Social</th>
                                            <th>Telefono</th>
                                            <th>Correo</th>
                                            <th width="15%;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proveedores as $proveedor)

                                        <tr
                                        @if($proveedor['bolEstado']==false)
                                            class="table-danger"
                                            @endif
                                        >

                                            <td>{{ $proveedor['intNumeroDoc'] }}</td>
                                            <td>{{ $proveedor['varNombreConta'] }}</td>
                                            <td>{{ $proveedor['varNombreConta'] }}</td>
                                            <td>{{ $proveedor['varCorreo'] }}</td>
                                            <td>
                                                @if($proveedor['bolEstado']==false)
                                                <button wire:click="activarproveedor({{ $proveedor['IdProveedores'] }})" class="btn btn-success btn-sm ">Activar</button>
                                                @else
                                                <button wire:click="desactivarproveedor({{ $proveedor['IdProveedores'] }})" class="btn btn-danger btn-sm icon-only">Inactivar</button>
                                                <button wire:click="editarproveedor({{ $proveedor['IdProveedores'] }})" class="btn btn-warning btn-sm  icon-only">Editar</button>   
                                                @endif
                                                <button wire:click="verproveedor({{ $proveedor['IdProveedores'] }})" class="btn btn-info btn-sm icon-only">Ver</button>
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
