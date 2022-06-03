<div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        @switch($accion)

                        @case('verTecnico')

                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">

                                <h4 class="card-title">Tecnico: #{{ $tecnico->varNombreCont }}</h4>
    
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                            <div class="mb-3 col-md-4">
                                    <label class="form-label">Nombre de Contacto: </label>
                                        {{ $tecnico->varNombreCont }}
                                </div>

                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Tipo de Identificación:</label>
                                        {{ $tecnico->varTipoIden }}
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Numero de Documento:</label>
                                        {{ $tecnico->varNumeroDoc }}
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Nombre o Razon Social:</label>
                                    
                                    {{ $tecnico->varNombreRazon }}
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Telefono:</label>
                                    
                                    {{ $tecnico->varTelefono }}
                                </div>

                
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Telefono de Contacto:</label>
                                   
                                    {{ $tecnico->varTelefonoCont }}
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Correo Electrónico:</label>
                                    {{ $tecnico->varCorreo??'No registrado' }}
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Zona </label>
                                  
                                    {{ $tecnico->zona->varCiudad }}
                                </div> 

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Dirección:</label>
                                
                                    {{ $tecnico->varDireccion }}
                                </div>

                            </div>
                        </div>

                        @break

                        @case('formTecnicos')
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                @if($tecnico->IdTecnicos != "")
                                <h4 class="card-title">Editar Tecnico: #{{ $tecnico->IdTecnicos }}</h4>
                                @else
                                <h4 class="card-title">Crear Tecnico</h4>
                                @endif
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Tipo de Identificación *</label>
                                    <select wire:model="tecnico.varTipoIden" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                        <option value="NIT">NIT</option>
                                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                    @error('tecnico.varTipoIden')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Numero de Documento *</label>
                                    <input type="number" class="form-control" wire:model="tecnico.varNumeroDoc" />
                                    @error('tecnico.varNumeroDoc')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Nombre o Razon Social *</label>
                                    <input type="text" class="form-control" wire:model="tecnico.varNombreRazon" />
                                    @error('tecnico.varNombreRazon')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Telefono *</label>
                                    <input type="text" class="form-control" wire:model="tecnico.varTelefono" />
                                    @error('tecnico.varTelefono')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Telefono de Contacto *</label>
                                    <input type="text" class="form-control" wire:model="tecnico.varTelefonoCont" />
                                    @error('tecnico.varTelefonoCont')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Dirección *</label>
                                    <input type="text" class="form-control" wire:model="tecnico.varDireccion" />
                                    @error('tecnico.varDireccion')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Correo Electrónico*</label>
                                    <input type="email" class="form-control" wire:model="tecnico.varCorreo" />
                                    @error('tecnico.varCorreo')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Nombre de Contacto  *</label>
                                    <input type="text" class="form-control" wire:model="tecnico.varNombreCont" />
                                    @error('tecnico.varNombreCont')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Zona *</label>
                                  
                                    <x-select2 action="getZonas" method="" model="tecnico.varZona"></x-select2>
                                    @error('tecnico.varZona')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 text-right">
                                    <button wire:click="guardarTecnico" class="btn btn-primary">Guardar<i
                                            class="bi bi-plus-circle"></i></button>
                                </div>

                            </div>
                        </div>
                        @break
                        @default
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Tecnicos</h4>
                            </div>
                            <div class="">
                                <button wire:click="crearTecnico"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Tecnico</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class='table text-center'>
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Email</th>
                                        <th>Zona</th>
                                        <th>Nombre</th>
                                        <th width="23%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tecnicos as $item)
                                        <tr>
                                            <td>{{ $item->varNumeroDoc}}</td>
                                            <td>{{ $item->varCorreo}}</td>
                                            <td>{{ $item->zona->varCiudad}}</td>
                                            <td>{{ $item->varNombreRazon}}</td>
                                            <td>
                                                <button wire:click="diligenciarTecnico({{$item->IdTecnicos }})" class="btn btn-sm btn-warning">Diligenciar</button>
                                                <button wire:click="verTecnico({{$item->IdTecnicos }})" class="btn btn-sm btn-info">Ver</button>
                                            </td>
                                        </tr>
                                    @endforeach                               
                                </tbody>
                            </table>
                            <!-- Linea que coloca el paginador del listadpo -->
                            {{ $tecnicos->links() }}  

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

