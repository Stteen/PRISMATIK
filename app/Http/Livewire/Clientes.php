<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
/* Declaramos las variables necesarias para el manejo de los datos */
    public $accion,$cliente;

/* Declaramos la variable para el manejo de los mensajes de error */
    public $mensaje=[];

    /* Declaramos las reglas del formulario para indicar cuales son requeridas */
    public $rules=[
        "cliente.varTipoIdCliente" => "required",
        "cliente.idDocumentos" => "required",
        "cliente.varNombreRazon" => "required",
        "cliente.varTelefono" => "required",
        "cliente.varCorreo" => "required",
        "cliente.varNombreConta" => "required",
        "cliente.varDireccion" => "required",
        "cliente.varTelContacto" => "required",
        "cliente.varTecnicoAsig" => "required",
        "cliente.varZona" => "required"
    ];

    /* Declaramos una variable protegida para los mensajes de error de los campos al enviar un campo vacio */
    protected $validationAttributes = [
        "cliente.varTipoIdCliente" => "Tipo de Documento",
        "cliente.idDocumentos" => "Documento",
        "cliente.varNombreRazon" => "Razón Social",
        "cliente.varTelefono" => "Teléfono",
        "cliente.varCorreo" => "Correo",
        "cliente.varNombreConta" => "Nombre de Contacto",
        "cliente.varDireccion" => "Dirección",
        "cliente.varTelContacto" => "Teléfono de Contacto",
        "cliente.varTecnicoAsig" => "Técnico Asignado",
        "cliente.varZona" => "Ruta"
    ];

    /* esta funcion inciara un objeto y nos enviara al caso FormClientes donde se encuentra el formulario para crear o editar */
    public function crearCliente(){
        $this->accion = 'formCliente';
        $this->cliente = [];
    }

    /* una funcion que mediante una peticion obtenemos el id y lo tratamos como una coleccion de tipo json*/
    public function editarCliente($id){
        $this->accion = 'formCliente';
        $this->cliente = Http::get(env('API_URL').'/client/getById?id='.$id)->json();

    }

    /* Mediante la peticion que obtenemos del Request $id, enviamos una peticion a la api para obtener
    un cliente por el request $id pasado e indicamos a que caso (accion) nos enviara*/
    public function verCliente($id){
        $this->accion = 'verCliente';
        $this->cliente = Cliente::find($id);

    }

    /* creamos una condicion si  idClientes contiene datos hara una peticion para actualizar en caso contrario 
    Enviara una peticion para crear un cliente*/
    public function guardarCliente(){

        $this->validate();
        if(isset($this->cliente['idClientes'])){
            $response=Http::put(env('API_URL').'/client/updateById',$this->cliente)->json();
        }
        else{
            $response=Http::post(env('API_URL').'/client/create',$this->cliente)->json();
        }


        if($response===TRUE){
            $this->accion="";
            $this->mensaje=["type"=>"success","message"=>"Cliente creado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al crear el cliente"];
        }

    }
    
    /* hace una peticion a la api de Prisma mediante el request $id para activar el Cliente */
    public function activarCliente($id){
        $response=Http::put(env('API_URL')."/client/activateById?id={$id}")->json();

        if($response===TRUE){

            $this->mensaje=["type"=>"success","message"=>"Cliente activado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al activar el cliente"];
        }
    }


    /* hace una peticion a la api de Prisma mediante el request $id para desactivar el Cliente */
    public function desactivarCliente($id){
        $response=Http::delete(env('API_URL')."/client/deleteById?id={$id}")->json();

        if ($response===true) {
            $this->mensaje=["type"=>"success","message"=>"Cliente desactivado correctamente"];
        } else {
            $this->mensaje=["type"=>"danger","message"=>"Error al desactivar el cliente"];
        }
    }

    /* Esta funcion permite enviar al default que en este caso donde se encuentra el listado */
    public function volver(){
        $this->accion = '';
        $this->cliente = [];
    }
    
    /* Esta funcion permite incializar la variable para obtener el listado llamando y almacenandola en la variable
    cliente*/
    public function render(){
        return view('livewire.clientes', [
            'clientes' => Cliente::orderBy('IdClientes', 'DESC')->paginate(10),
        ]);
    }
}
