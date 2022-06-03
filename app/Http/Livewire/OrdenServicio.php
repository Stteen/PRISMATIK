<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Producto;
use App\Models\OrdenesServicio;
use App\Models\Proveedor;
use App\Models\OrdenDetalle;
use Barryvdh\DomPDF\Facade\Pdf;


class OrdenServicio extends Component
{
 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    /* Inicializamos las variables necesarias para el funcionamiento*/
    public $accion, $orden, 
    $proveedores, $clientes, $productos, 
    $productoOrden, $productoOrdenes;

    /* Declaramos las reglas para el formulario */
    public $rules=[
        "orden.varProveedor" => "required",
        "orden.varTipoOrden" => "required",
        "orden.dtFechaEntrega" => "",
        "orden.varCliente" => "required",
        "productoOrden.varTipoProducto" => "",
        "productoOrden.cantidad" => "",
        "productoOrden.ref_entrada" => "",
        "productoOrden.ref_salida"=> "",
        "productoOrden.varPrecio" => "",
    ];

    /* Le damos un valor personalizado para los errores del formulario */
    protected $validationAttributes = [
        "orden.varProveedor" => "Proveedor",
        "orden.varTipoOrden" => "Tipo de Orden",
        "orden.dtFechaEntrega" => "Fecha de Entrega",
        "orden.varCliente" => "Cliente"
    ];

    /* Lleva a la accion de crear Ordenes de Servicios */
    public function crearOrdenServicio(){

        // Reseteamos los errores de validacion al entrar a la vista
        $this->resetValidation();
        $this->accion = 'formOrdenServicio';

        // Inicializamos la variable que contiene los valores del formulario
        $this->orden = new OrdenesServicio;
    }

    public function calcularFechaEntrega(){
        $proveedor = Proveedor::find($this->orden->varProveedor);
        $fechaEntrega = Carbon::now()->add($proveedor->intPlazoEntr, 'days');
       
        $this->orden->dtFechaEntrega = $fechaEntrega->format('Y-m-d');
    }

    /* La funcion recibe un parametro desde el listado para la seleccion a editar */
    public function editarOrdenServicio($id){
        // Reseteamos los errores de validacion al entrar a la vista
        $this->resetValidation();
      
        // Enviamos a la accion de la vista Formulario
        $this->accion = 'formOrdenServicio';

        // Obtenemos los valores necesarios para editar y mostrar ejecutados por la api PRISMA
        $this->orden = OrdenesServicio::find($id);

        // Inicializamos un array vacio para el agregado de productos a la orden
        $this->productoOrden = new OrdenDetalle;

    }

    // Funcion para agregar los productos a la orden de servicio 
    public function agregarProducto(){

        $this->productoOrden->orden_id = $this->orden->IdOrdenServicio; ;
        $this->productoOrden->save();
        
        $this->editarOrdenServicio($this->orden->IdOrdenServicio);
    }

    // Envia al caso para la vista de Ordenes de servicio pasando el parametro id
    public function verOrdenServicio($id){
        // Indicamos la accion a donde queremos ingresar
        $this->accion = 'verOrdenServicio';

        // Ejecutamos una peticion de tipo Get con el parametro id y la almacenamos en la variable global de Orden
        $this->orden = OrdenesServicio::find($id);
    }

    // Funcion para Guardar y Actualizar las Ordenes de servicio
    public function guardarOrdenServicio(){
        // Validamos las reglas del formulario
        $this->validate();
        // Almacenamos y enviamos la fecha en formato de hoy
        $this->orden->dtFecha = date('Y-m-d');
            // le indicamos quien es el responsable
            $this->orden->varResponsable = auth()->user()->name;

            // Le indicamos cual será el prefijo del consecutivo a buscar
            switch($this->orden->varTipoOrden){
                case 'Muestra': $prefijo =date('Y')."-OM"; break;
                case 'Pedido': $prefijo =date('Y')."-OS"; break;

            }
            // Buscamos el último consecutivo dentro de las ordenes de servicio
            $consecutivo = OrdenesServicio::where('varConsecutivo','LIKE',$prefijo.'%')->orderBy('IdOrdenServicio','DESC')->first();
            
            // Si no existe un consecutivo le asignamos el valor 1
            if(!$consecutivo){
                $proximo = 1;
            }else{
                // Si existe un consecutivo le sumamos 1
                $proximo=str_replace($prefijo,'',$consecutivo->varConsecutivo)+1;
               
            }
            $this->orden->varConsecutivo = $prefijo.str_pad($proximo,5,'0',STR_PAD_LEFT);
            
         $this->orden->save();
    }

    // Funcion para cambiar el estado y avisar al proveedor que ya el producto ha sido enviado
    public function enviaProducto($id){
        $this->orden = OrdenesServicio::find($id);
        $this->orden->Estado = 'ENVIADO';
        $this->orden->save();
    }

    // Funcion para el renderizado de la pagina de listado de Ordenes de servicio
    public function render(){
        // Nos regresa la vista de Ordenes de Servicio
        return view('livewire.orden-servicio', [
            'ordenes' => OrdenesServicio::orderBy('IdOrdenServicio', 'DESC')->paginate(5),
        ]);
    }

    // Funcion para el boton que envia al listado de Ordenes de servicio
    public function volver(){
        $this->accion = '';
        $this->mensaje = [];
    }

    public function mount()
    {
    }

    public function imprimePDF($id){
        $orden = OrdenesServicio::find($id);
       $pdf =  PDF::loadView('ordenPDF', ['orden' => $orden])->stream('orden'.$orden->varConsecutivo.'.pdf');
       return response()->stream(function() use ($pdf) {
            echo $pdf;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ordenPDF.pdf"',
            'Content-Transfer-Encoding' => 'binary',
        ]);
     
        
    }
}
