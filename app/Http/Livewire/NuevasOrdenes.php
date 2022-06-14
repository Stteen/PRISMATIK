<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Producto;
use App\Models\OrdenesServicio;
use App\Models\Proveedor;
use App\Models\OrdenDetalle;
use App\Models\User;

class NuevasOrdenes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $accion, $orden, $proveedor, $producto, $rechazo;
    
    public $rules = [
        'orden.varObservacion' => 'required',
    ];

      // Funcion para el boton que envia al listado de Ordenes de servicio
      public function volver(){
        $this->accion = '';
    }

    public function verNuevaOrden($id){
        $this->accion = 'verNuevaOrden';
        $this->rechazo = false;
        $this->orden = OrdenesServicio::find($id);
    }

    public function aprobarOrden(){
        $this->orden->Estado = 'APROBADA';
        $this->orden->save();
        $this->accion = "";
    }

    public function rechazarOrden(){
        $this->orden->Estado = 'RECHAZADA';
        $this->orden->save();
        $this->accion = "";
    }

    public function vistaRechazarOrden(){
        $this->orden = OrdenesServicio::find($this->orden->IdOrdenServicio);
        $this->accion = "rechazarOrden";
    }

    public function render()
    {
        return view('livewire.nuevas-ordenes', [
            'ordenes' => OrdenesServicio::where('Estado', 'CREADO')
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->paginate(10),
        ]);
    }
}
