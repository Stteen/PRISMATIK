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

                        @case('formCliente')

                        <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">
                                    @if(!isset($cliente['idClientes']))
                                    Crear Cliente
                                    @else
                                    Editar Cliente
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
                                    <select wire:model='cliente.varTipoIdCliente' class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                        <option value="NIT">NIT</option>
                                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                    @error('cliente.varTipoIdCliente')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Identificación:</b>
                                    <input wire:model='cliente.idDocumentos' type="text" class="form-control" placeholder="Identificación">
                                    @error('cliente.idDocumentos')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Razón Social:</b>
                                    <input wire:model='cliente.varNombreRazon' type="text" class="form-control" placeholder="Nombre">
                                    @error('cliente.varNombreRazon')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Teléfono:</b>
                                    <input wire:model='cliente.varTelefono' type="text" class="form-control" placeholder="Teléfono">
                                    @error('cliente.varTelefono')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Correo:</b>
                                    <input wire:model='cliente.varCorreo' type="email" class="form-control" placeholder="Correo">
                                    @error('cliente.varCorreo')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Nombre del Contacto:</b>
                                    <input wire:model='cliente.varNombreConta' type="text" class="form-control" placeholder="Nombre del Contacto">
                                    @error('cliente.varNombreConta')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-12">
                                    <b>Dirección:</b>
                                    <input wire:model='cliente.varDireccion' type="text" class="form-control" placeholder="Dirección">
                                    @error('cliente.varDireccion')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Teléfono Contacto:</b>
                                    <input wire:model='cliente.varTelContacto' type="text" class="form-control" placeholder="Teléfono Contacto">
                                    @error('cliente.varTelContacto')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <b>Técnico Asignado:</b>
                                    <input wire:model="cliente.varTecnicoAsig" type="text" class="form-control" placeholder="Técnico Asignado">
                                    @error('cliente.varTecnicoAsig')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="col-lg-3">
                                    <b>Zona:</b>
                                    <select wire:model='cliente.varZona' class="form-control">
                                        <option value="">Seleccione</option>
                                        <option wire:key='Bello'>Bello</option>
                                        <option wire:key='Medellín'>Medellín</option>

                                    </select>
                                    @error('cliente.varZona')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-4 text-right">
                                    <button type="button" wire:click="guardarCliente" class="btn btn-success">Guardar</button>
                                </div>



                            </div>

                        </div>





                        @break




                        @default

                        <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Clientes</h4>
                            </div>
                            <div class="">
                                <a wire:click='crearCliente' class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Cliente</a>
                            </div>
                        </div>
                        <div class="card-body">

                        <table class='table table-bordered table-sm text-center'>
                                        <thead>
                                            <tr>
                                                <th>Documento</th>
                                                <th>Razon Social</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clientes as $cliente)

                                            <tr
                                            @if($cliente['bolEstado']==false)
                                                class="table-danger"
                                                @endif
                                            >

                                                <td>{{ $cliente['idDocumentos'] }}</td>
                                                <td>{{ $cliente['varNombreConta'] }}</td>
                                                <td>{{ $cliente['varTelContacto'] }}</td>
                                                <td>{{ $cliente['varCorreo'] }}</td>
                                                <td>
                                                    @if($cliente['bolEstado']==false)
                                                    <button wire:click="activarCliente({{ $cliente['idClientes'] }})" class="btn btn-success btn-sm btn-icon icon-only"><i class="fa fa-check"></i></button>
                                                    @else
                                                    <button wire:click="desactivarCliente({{ $cliente['idClientes'] }})" class="btn btn-danger btn-sm btn-icon icon-only"><i class="fa fa-times"></i></button>
                                                    @endif
                                                    <button wire:click="editarCliente({{ $cliente['idClientes'] }})" class="btn btn-warning btn-sm btn-icon icon-only"><i class="fa fa-pen"></i></button>
                                                    {{ $cliente['idClientes'] }}</td>
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
