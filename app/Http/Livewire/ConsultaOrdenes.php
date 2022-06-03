<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OrdenesServicio;
use App\Models\OrdenDetalle;
use App\Models\Producto;
use App\Models\Proveedor;

class ConsultaOrdenes extends Component
{
    public $proveedor, $ordenes, $accion, $pendientes, $abiertas, $cerradas, $totalGeneradas;

    public function volver(){
        $this->accion = '';
    }

    public function pendientes($id){
        $this->pendientes = OrdenesServicio::where('varProveedor', $id)->where('Estado', 'CREADO')->get();
        $this->accion = "Pendientes";
    }

    public function abiertas($id){
        $this->abiertas = OrdenesServicio::where('varProveedor', $id)->where('Estado', 'RECIBIDO')->get();
        $this->accion = "Abiertas";
    }

    public function cerradas($id){
        $this->cerradas = OrdenesServicio::where('varProveedor', $id)->where('Estado', 'CERRADO')->get();
        $this->accion = "Cerradas";
    }

    public function totalGeneradas($id){
        $this->totalGeneradas = OrdenesServicio::where('varProveedor', $id)->get();
        $this->accion = "totalGeneradas";
    }

    public function verOrden($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = "verOrden";
    }

    public function render()
    {
            $this->ordenes = OrdenesServicio::groupBy('varProveedor')->get();
        return view('livewire.consulta-ordenes');
    }

}
