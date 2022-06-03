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
            'ordenes' => OrdenesServicio::where('Estado', 'DESPACHADA')
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->paginate(10),
        ]);
    }
}
