<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{

    public $clientes,$accion,$cliente;
    public $mensaje=[];

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

    public function mount()
    {
    }

    public function crearCliente(){
        $this->accion = 'formCliente';
        $this->cliente = [];
    }
    public function editarCliente($id){
        $this->accion = 'formCliente';
        $this->cliente = Http::get(env('API_URL').'/client/getById?id='.$id)->json();

    }

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

    public function activarCliente($id){

        $response=Http::put(env('API_URL')."/client/activateById?id={$id}")->json();

        if($response===TRUE){

            $this->mensaje=["type"=>"success","message"=>"Cliente activado correctamente"];
        }
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al activar el cliente"];
        }
    }

    public function desactivarCliente($id){
        $response=Http::delete(env('API_URL')."/client/deleteById?id={$id}")->json();

        if ($response===true) {
            $this->mensaje=["type"=>"success","message"=>"Cliente desactivado correctamente"];
        } else {
            $this->mensaje=["type"=>"danger","message"=>"Error al desactivar el cliente"];
        }
    }



    public function volver(){
        $this->accion = '';
        $this->cliente = [];
    }


    public function render()
    {
        $this->clientes = Http::get('https://prismapi-docker.herokuapp.com/client/getAllComplete')->json();
        return view('livewire.clientes');
    }
}
