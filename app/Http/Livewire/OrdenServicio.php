<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;


class OrdenServicio extends Component
{
    public $ordenes,$accion,$orden, $proveedores, $clientes, $productos, $productoOrden, $productoOrdenes;

    public $rules=[
        "orden.varProveedor" => "required",
        "orden.varResponsable" => "required",
        "orden.varTipoOrden" => "required",
        "orden.dtFechaEntrega" => "",
        "orden.varCliente" => "required"
    ];


    protected $validationAttributes = [
        "orden.varProveedor" => "Proveedor",
        "orden.varResponsable" => "Responsable",
        "orden.varTipoOrden" => "Tipo de Orden",
        "orden.dtFechaEntrega" => "Fecha de Entrega",
        "orden.varCliente" => "Cliente"
    ];

    public function crearOrdenServicio(){
        $this->accion = 'formOrdenServicio';
        $this->orden = [];
        $this->proveedores =  Http::get(env('API_URL').'/providers/getAll')->json();
        $this->clientes =  Http::get(env('API_URL').'/client/getAll')->json();
    }

    /* Creamos una funcion que nos llamara a la peticion del listado de Proveedores y la llamamos $id para
    que nos traiga su coleccion. Enviandonos a la vez al caso formproveedor para mostrar sus respectivos datos mediante la peticion, 
    le indicamos que la variable global proveedor enviara una peticion de tipo get con el metodo */
    public function editarOrdenServicio($id){
        $this->accion = 'formOrdenServicio';
        $this->orden = Http::get(env('API_URL').'/serviceOrder/getById?id='.$id)->json();
        $this->proveedores =  Http::get(env('API_URL').'/providers/getAll')->json();
        $this->clientes =  Http::get(env('API_URL').'/client/getAll')->json();
        $this->productos = Http::get(env('API_URL').'/portfolio/getAll')->json();
        $this->productoOrden = [];
        $this->productoOrdenes = [];
    }

    public function agregarProducto(){
        $this->productoOrdenes[] = $this->productoOrden;
        $this->productoOrden = [];
    }

    public function verOrdenServicio($id){
        $this->accion = 'verproveedor';
        $this->proveedor = Http::get(env('API_URL').'/providers/getById?id='.$id)->json();

    }

    public function guardarOrdenServicio(){
        $this->validate();
        /* Preguntamos si la variable orden contiene un id si es asi ejecutara el metodo PUT que envia a la api */
        if(isset($this->orden['idOrdenServicio'])){

            $response=Http::put(env('API_URL').'/serviceOrder/updateById',$this->orden)->json();
        }
        /* En caso de que la vista no traiga un id este ejecutara el metodo post agregandole automaticamente 
        Los campos que el usuario no registra en la plataforma */
        else{
            $this->orden['dtFecha'] = date('Y-m-d');
            $this->orden['varResponsable'] = "Admin";
            
            if($this->orden['varTipoOrden'] == 'Pedido de Muestra'){
                $this->orden['varConsecutivo'] = $this->orden['dtFecha']."-OM"; 
            }else{
                $this->orden['varConsecutivo'] = $this->orden['dtFecha']."-OS"; 
            }

            $response=Http::post(env('API_URL').'/serviceOrder/create',$this->orden)->json();
          
        }


        if($response!==FALSE){
            $this->mensaje=["type"=>"success","message"=>"Orden de Servicio guardado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al guardar la orden de Servicio"];
        }



    }

    public function activarOrdenServicio($id){

        $response=Http::put(env('API_URL')."/serviceOrder/activateById?id=".$id)->json();

        if($response===TRUE){

            $this->mensaje=["type"=>"success","message"=>"Orden de Servicio activado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al activar la Orden de Servicio"];
        }
    }

    public function desactivarOrdenServicio($id){
        $response=Http::delete(env('API_URL')."/serviceOrder/deleteById?id=".$id)->json();

        if ($response===TRUE) {
            $this->mensaje=["type"=>"success","message"=>"proveedor desactivado correctamente"];
        } else {
            $this->mensaje=["type"=>"danger","message"=>"Error al desactivar el proveedor"];
        }
    }


    public function render()
    {
        $this->ordenes = Http::get('https://prismapi-docker.herokuapp.com/serviceOrder/getAllComplete')->json();
        return view('livewire.orden-servicio');
    }

    public function volver(){
        $this->accion = '';
        $this->mensaje = '';
    }

    public function mount()
    {
    }
}
