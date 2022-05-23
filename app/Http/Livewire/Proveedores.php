<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedores extends Component
{
    /* Declaramos las variables necesarias para el manejo de los datos */
    public $proveedores,$accion,$proveedor;

    /* Declaramos la variable para el manejo de los mensajes de error */
    public $mensaje=[];

    /* Declaramos las reglas del formulario para indicar cuales son requeridas y cuales no */
    public $rules=[
        "proveedor.varTipoDoc" => "required",
        "proveedor.intNumeroDoc" => "required",
        "proveedor.varNombreRazon" => "required",
        "proveedor.varTelefono" => "required",
        "proveedor.varNombreConta" => "required",
        "proveedor.varDireccion" => "required",
        "proveedor.varCorreo" => "required",
        "proveedor.varTelefonoConta" => "required",
        "proveedor.intPlazoEntr" => "required"
    ];

    /* Declaramos una variable protegida para los mensajes de error de los campos al enviar un campo vacio */
    protected $validationAttributes = [
        "proveedor.varTipoDoc" => "Tipo de Documento",
        "proveedor.intNumeroDoc" => "Documento",
        "proveedor.varNombreRazon" => "Razón Social",
        "proveedor.varTelefono" => "Teléfono",
        "proveedor.varCorreo" => "Correo",
        "proveedor.varNombreConta" => "Nombre de Contacto",
        "proveedor.varDireccion" => "Dirección",
        "proveedor.varTelefonoConta" => "Teléfono de Contacto",
        "proveedor.intPlazoEntr" => "Plazo de Entrega"
    ];

    /* Creamos una funcion que nos llamara al caso del switch de Proveedores ("Formproveedor") e
    Inicializamos variable globla y le indicaremos que es de tipo array [] */
    public function crearproveedor(){
        $this->accion = 'formproveedor';
        $this->proveedor = [];
    }

    /* Creamos una funcion que nos llamara a la peticion del listado de Proveedores y la llamamos $id para
    que nos traiga su coleccion. Enviandonos a la vez al caso formproveedor para mostrar sus respectivos datos mediante la peticion, 
    le indicamos que la variable global proveedor enviara una peticion de tipo get con el id pasado mediante la peticion*/
    public function editarproveedor($id){
        $this->accion = 'formproveedor';
        $this->proveedor = Http::get(env('API_URL').'/providers/getById?id='.$id)->json();
    }

    /* Creamos una funcion que nos enviara al caso verProveedor con un requisito $id y le indicamos que envie la peticion
    a la api con la url e indicandole que es de tipo json */
    public function verproveedor($id){
        $this->accion = 'verproveedor';
        $this->proveedor = Http::get(env('API_URL').'/providers/getById?id='.$id)->json();
    }

    /* Agregamos una condicional si se tiene datos enviara una peticion de tipo put con el id enviado mediante la peticion
    En caso contrario enviara un metodo post para agregar un nuevo dato*/
    public function guardarproveedor(){

        $this->validate();
        if(isset($this->proveedor['IdProveedores'])){
            $response=Http::put(env('API_URL').'/providers/updateById',$this->proveedor)->json();
        }
        else{
           $response=Http::post(env('API_URL').'/providers/create',$this->proveedor)->json();
        }

    /* En caso de que el envio sea verdadero enviara un mensaje de tipo success */
        if($response!==FALSE){
            $this->accion="";
            $this->mensaje=["type"=>"success","message"=>"proveedor creado correctamente"];
        }
        /* En caso contrario mostrara una alerta de color roja indicando que no pudo ser creado */
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al crear el proveedor"];
        }

    }

    /* Esta funcion envia una peticion con el requisito $id para activar el estado al proveedor */
    public function activarproveedor($id){

        $response=Http::put(env('API_URL')."/providers/activateById?id=".$id)->json();

        if($response===TRUE){

            $this->mensaje=["type"=>"success","message"=>"proveedor activado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al activar el proveedor"];
        }
    }

    /* Esta funcion envia una peticion con el requisito $id para desactivar el estado al proveedor */
    public function desactivarproveedor($id){
        $response=Http::delete(env('API_URL')."/providers/deleteById?id=".$id)->json();

        if ($response===TRUE) {
            $this->mensaje=["type"=>"success","message"=>"proveedor desactivado correctamente"];
        } else {
            $this->mensaje=["type"=>"danger","message"=>"Error al desactivar el proveedor"];
        }
    }

    /* la funcion nos envia al default de nuestro switch para poder observar el listado de Proveedores */
    public function volver(){
        $this->accion = '';
      
    }

    /* Almacenamos en una variable la peticion de tipo get a la api para poder obtener el listado de Proveedores 
    a su vez returnando la vista de Proveedores*/
    public function render()
    {
        $this->proveedores = Http::get('https://prismapi-docker.herokuapp.com/providers/getAllComplete')->json();
        return view('livewire.proveedores');
    }

    public function mount()
    {
    }
}
