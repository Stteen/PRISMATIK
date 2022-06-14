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

class OrdenDespachada extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $accion, $orden, $proveedor, $producto;
  
    public function verNuevaOrden($id){
        $this->accion = 'verNuevaOrden';
        $this->orden = OrdenesServicio::find($id);
    }

    public function render()
    {
        return view('livewire.orden-despachada', [
            'ordenes' => OrdenesServicio::where('Estado', 'ENVIADO')
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->paginate(10),
        ]);
    }

    public function verOrden($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = 'verOrden';
    }

    
    public function recibeProveedor($id){
        $this->orden = OrdenesServicio::find($id);
        $this->orden->Estado = 'RECIBIDO';
        $this->orden->save(); 
    }

    public function volver(){
        $this->accion = '';
    }

}
