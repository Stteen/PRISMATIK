<div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        @switch($accion)

                        @case('verZona')

                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">

                                <h4 class="card-title">Zona: #{{ $zona->IdZonas }}</h4>
    
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Nombre de Zona *</label>
                                    <input type="text" class="form-control" value="{{$zona->varNumeroZona}}" readOnly/>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Departamento *</label>
                                    <input type="text" class="form-control" value="{{$zona->varDepartamento}}" readOnly/>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Ciudad *</label>
                                    <input type="text" class="form-control" value="{{$zona->varCiudad}}" readOnly/>
                                </div>


                            </div>
                        </div>

                        @break

                        @case('formZonas')
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                @if($zona->IdZonas != "")
                                <h4 class="card-title">Editar Zona: #{{ $zona->IdZonas }}</h4>
                                @else
                                <h4 class="card-title">Crear Zona</h4>
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
                                    <label class="form-label">Nombre de Zona *</label>
                                    <input type="text" class="form-control" wire:model="zona.varNumeroZona" />
                                    @error('zona.varNumeroZona')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Departamento *</label>
                                    <input type="text" class="form-control" wire:model="zona.varDepartamento" />
                                    @error('zona.varDepartamento')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Ciudad *</label>
                                    <input type="text" class="form-control" wire:model="zona.varCiudad" />
                                    @error('zona.varCiudad')
                                    <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 text-right">
                                    <button wire:click="guardarZona" class="btn btn-primary">Guardar<i
                                            class="bi bi-plus-circle"></i></button>
                                </div>

                            </div>
                        </div>
                        @break
                        @default
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Zonas</h4>
                            </div>
                            <div class="">
                                <button wire:click="crearZona"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Zona</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class='table text-center'>
                                <thead>
                                    <tr>
                                        <th>Nombre de Zona</th>
                                        <th>Ciudad</th>
                                        <th>Estado</th>
                                        <th width="23%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zonas as $zona)
                                        <tr>
                                            <td>{{$zona->varNumeroZona}}</td>
                                            <td>{{$zona->varDepartamento}}</td>
                                            <td>
                                                @if($zona->bolEstado == 1)
                                                <span class="badge badge-success">Activo</span>
                                                @else
                                                <span class="badge badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="verZona({{ $zona->IdZonas }})" class="btn btn-sm btn-info">Ver</button>
                                                @if($zona->bolEstado == 1)
                                                <button wire:click="editarZona({{ $zona->IdZonas }})" class="btn btn-sm btn-warning">Editar</button>
                                                <button wire:click="cambiarEstado({{ $zona->IdZonas }})" class="btn btn-sm btn-danger">Inactivar</button>
                                                @else
                                                <button wire:click="cambiarEstado({{ $zona->IdZonas }})" class="btn btn-sm btn-success">Activar</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Linea que coloca el paginador del listadpo -->
                            {{ $zonas->links() }}  

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
