<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedor;

class Proveedores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    /* Declaramos las variables necesarias para el manejo de los datos */
    public $accion,$proveedor;

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
        $this->proveedor = new Proveedor;
    }

    /* Creamos una funcion que nos llamara a la peticion del listado de Proveedores y la llamamos $id para
    que nos traiga su coleccion. Enviandonos a la vez al caso formproveedor para mostrar sus respectivos datos mediante la peticion, 
    le indicamos que la variable global proveedor enviara una peticion de tipo get con el id pasado mediante la peticion*/
    public function editarproveedor($id){
        $this->accion = 'formproveedor';
        $this->proveedor = Proveedor::find($id);
    }

    /* Creamos una funcion que nos enviara al caso verProveedor con un requisito $id y le indicamos que envie la peticion
    a la api con la url e indicandole que es de tipo json */
    public function verproveedor($id){
        $this->accion = 'verproveedor';
        $this->proveedor = Proveedor::find($id);
    }

    /* Agregamos una condicional si se tiene datos enviara una peticion de tipo put con el id enviado mediante la peticion
    En caso contrario enviara un metodo post para agregar un nuevo dato*/
    public function guardarproveedor(){

        $this->validate();
        $this->proveedor->save();
        $this->accion = "";


    }

    /* Esta funcion envia una peticion con el requisito $id para activar el estado al proveedor */
    public function cambiarEstado($id){

       $this->proveedor = Proveedor::find($id);
       $this->proveedor->bolEstado == 1? $this->proveedor->bolEstado = 0 : $this->proveedor->bolEstado = 1;
         $this->proveedor->save();

    }

    /* la funcion nos envia al default de nuestro switch para poder observar el listado de Proveedores */
    public function volver(){
        $this->accion = '';
      
    }

    /* Almacenamos en una variable la peticion de tipo get a la api para poder obtener el listado de Proveedores 
    a su vez returnando la vista de Proveedores*/
    public function render()
    {
        return view('livewire.proveedores', [
            'proveedores' => Proveedor::paginate(2),
        ]);
    }

    public function mount()
    {
    }
}
