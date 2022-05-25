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
                      
                      @case('verProducto')

                      <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            <h4 class="card-title">Ver Producto</h4>
                        </div>
                        <div class="">
                            <button wire:click="volver" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button> 
                        </div>
                    </div>
                    <div class="card-body">
                           <div class="row">
                               <div class="col-md-4">
                       
                                <label class="form-label">Referencia: </label>
                                {{$this->producto['varReferencia']}}<br />
                       
                                <label class="form-label">Color:</label>
                                {{$this->producto['varColor']}}
                        
                                <label class="form-label">Descripcion del Producto: </label><br />
                                <textarea class="form-control" readOnly>{{$this->producto['varDescripcion']}}</textarea>
                                </div>

                        <div class="mb-3 col-md-8 text-center">
                                <label class="form-label">Imagen del Producto: </label>
                                @if(isset($this->producto['varImagenProd']))
                                <div class="col-sm-12 responsive py-3 text-center" >
                                <img src="{{ $photo }}" width="300" height="200" alt="{{$this->photo}}"/>
                                </div>
                                @endif
                        </div>
                        </div>
                        

                      @break

                        @case('formProducto')
                        <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            @if(isset($producto['IdPortafolio']))
                            <h4 class="card-title">Editar Producto: #{{ $producto['IdPortafolio'] }}</h4>
                            @else
                            <h4 class="card-title">Crear Producto</h4>
                           @endif
                        </div>
                        <div class="">
                            <button wire:click="volver" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Volver</button> 
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                           
                        <div class="mb-3 col-md-6">
                                <label class="form-label">Referencia *</label>
                                <input type="text" class="form-control" wire:model="producto.varReferencia" >
                                @error('producto.varReferencia')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>


                        <div class="mb-3 col-md-6">
                                <label class="form-label">Color *</label>
                                <input type="text" class="form-control" wire:model="producto.varDescripcion" >
                                @error('producto.varColor')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                        <div class="mb-3 col-md-12">
                                <label class="form-label">Descripcion del Producto  *</label>
                                <textarea type="text" class="form-control" wire:model="producto.varColor" ></textarea>
                                @error('producto.varDescripcion')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                <label class="form-label">Foto del Producto *</label>
                                <input type="file" wire:model="photo" >
                                @error('photo')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror

                                @if(isset($this->producto['varImagenProd']))
                                <div class="col-sm-4 responsive py-3" >
                                <img src="{{ $photo }}" width="300" height="200"/>
                                </div>
                                @elseif(isset($photo))
                                <div class="col-sm-4 responsive py-3" >
                                <img src="{{ $photo->temporaryUrl() }}" width="300" height="200"/>
                                </div>
                                @endif
                                </div>
                               
                                </div>
                                
                                <div class="col-sm-12 text-right">
                               <button wire:click="guardarProducto" class="btn btn-primary">Guardar<i class="bi bi-plus-circle"></i></button>
                               </div>
                            
                            </div>
                        </div>
                        @break
                        @default
                    <div class="card-header d-flex justify-content-between row" style="margin-left:0px; margin-right:0px;">
                        <div class="header-title">
                            <h4 class="card-title">Productos</h4>
                        </div>
                        <div class="">
                            <button wire:click="crearProducto" class="btn border add-btn shadow-none mx-2 d-none d-md-block">Crear Producto</button> 
                        </div>
                    </div>
                    <div class="card-body">
                    @if($productos>0)
                    <table class='table table-bordered table-sm text-center'>
                                    <thead>
                                        <tr>
                                            <th>Referencia</th>
                                            <th>Estado</th>
                                            <th>Color</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach($productos as $item)
                                            <tr>
                                                <td>{{$item['varReferencia']}}</td>
                                                <td>
                                                    @if($item['bolEstado']== 1)
                                                        <span class="badge badge-success">Activo</span>
                                                        @else
                                                        <span class="badge badge-danger">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>{{$item['varColor']}}</td>
                                                <td>
                                                    <button wire:click="verProducto({{$item['IdPortafolio']}})" class="btn btn-sm btn-info" type="btn" >Ver</button>
                                                    <button wire:click="editProducto({{$item['IdPortafolio']}})" class="btn btn-sm btn-warning" type="btn" >Editar</button>
                                                    <button wire:click="" class="btn btn-sm btn-success" type="btn" >Activar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>    
                            </table>
                            @else
                                <div class="alert alert-info text-center">
                                    <h5 class="text-center">Aún no cuenta con Productos para su Empresa</h5>   
                                </div>
                            @endif
                        
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
