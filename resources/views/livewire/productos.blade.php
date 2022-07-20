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
                    @if( Session::has("success") )
                    <div class="alert alert-success alert-block" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {{ Session::get("success") }}
                    </div>
                    @endif
                    <div class="card">
                        @switch($accion)

                        @case('verProducto')

                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Producto</h4>
                            </div>
                            <div class="">
                                <button wire:click="volver"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">

                                    <label class="form-label mb-3">Descripcion del Producto:&nbsp;</label>
                                    {{$producto->varDescripcion}}<br />

                                    <label class="form-label mb-3">Referencia:&nbsp;</label>
                                    {{$producto->varReferencia}}<br />

                                    <label class="form-label mb-3">Color:&nbsp;</label>
                                    {{$producto->varColor}}<br />



                                    <label class="form-label">Tipo de Producto:&nbsp;</label>
                                    {{$producto->varTipoProducto}}
                                </div>


                                <div class="mb-3 col-md-7 text-center">
                                    <label class="form-label">Imagen del Producto: </label>
                                    @if(isset($this->producto['varImagenProd']))
                                    <div class="col-sm-12 responsive py-3 text-center">
                                        <img src="{{ $photo }}" width="300" height="200" alt="Sin imagen" />
                                    </div>
                                    @endif
                                </div>
                            </div>


                            @break

                            @case('formProducto')
                            <div class="card-header d-flex justify-content-between row"
                                style="margin-left:0px; margin-right:0px;">
                                <div class="header-title">
                                    @if(isset($producto['IdPortafolio']))
                                    <h4 class="card-title">Editar Producto: #{{ $producto['IdPortafolio'] }}</h4>
                                    @else
                                    <h4 class="card-title">Crear Producto</h4>
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
                                        <label class="form-label">Descripcion del Producto *</label>
                                        <input type="text" class="form-control" wire:model="producto.varDescripcion" />
                                        @error('producto.varDescripcion')
                                        <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Color *</label>
                                        <input type="text" class="form-control" wire:model="producto.varColor">
                                        @error('producto.varColor')
                                        <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Referencia *</label>
                                        <input type="text" class="form-control" wire:model="producto.varReferencia">
                                        @error('producto.varReferencia')
                                        <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Tipo de Producto *</label>
                                        <select type="selected" class="form-control" wire:model="producto.varTipoProducto">
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
                                        @error('producto.varTipoProducto')
                                        <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Foto del Producto *</label>
                                        <input type="file" wire:model="photo">
                                        @error('photo')
                                        <span class='text-danger'>{{ $message }}</span>
                                        @enderror

                                        @if(isset($this->producto['varImagenProd']))
                                        <div class="col-sm-4 responsive py-3">
                                            <img src="{{ $photo }}" width="300" height="200" />
                                        </div>
                                        @elseif(isset($photo) AND !isset($producto['IdPortafolio']))
                                        <div class="col-sm-4 responsive py-3">
                                            <img src="{{ $photo->temporaryUrl() }}" width="300" height="200" />
                                        </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="col-sm-12 text-right" wire:loading.remove>
                                    <button wire:click="guardarProducto" class="btn btn-primary">Guardar<i
                                            class="bi bi-plus-circle"></i></button>
                                </div>

                            </div>
                        </div>
                        @break
                        @default
                        <div class="card-header d-flex justify-content-between row"
                            style="margin-left:0px; margin-right:0px;">
                            <div class="header-title">
                                <h4 class="card-title">Productos</h4>
                            </div>
                            <div class="">
                                <button wire:click="crearProducto"
                                    class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear
                                    Producto</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class='table text-center'>
                                <thead>
                                    <tr>
                                        <th>Referencia</th>
                                        <th>Estado</th>
                                        <th>Color</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($productos as $item)
                                    <tr>
                                        <td>{{$item->varReferencia}}</td>
                                        <td>
                                            @if($item['bolEstado']== 1)
                                            <span class="badge badge-success">Activo</span>
                                            @else
                                            <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>{{$item->varColor}}</td>
                                        <td>
                                            @if($item['bolEstado'] == 1)
                                            <button wire:click="verProducto({{ $item['IdPortafolio'] }})"
                                                class="btn btn-sm btn-info" type="btn">Ver</button>
                                            <button wire:click="editProducto({{ $item['IdPortafolio'] }})"
                                                class="btn btn-sm btn-warning" type="btn">Editar</button>
                                            <button wire:click="cambiarEstado({{ $item['IdPortafolio'] }})"
                                                class="btn btn-sm btn-danger" type="btn">Inactivar</button>
                                            @else
                                            <button wire:click="cambiarEstado({{ $item['IdPortafolio'] }})"
                                                class="btn btn-sm btn-success" type="btn">Activar</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-info text-center">
                                                <h5 class="text-center">Aún no cuenta con Productos para su Empresa</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $productos->links() }}


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
