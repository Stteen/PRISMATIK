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

class OrdenProceso extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.orden-proceso', [
            'ordenes' => OrdenesServicio::whereIn('Estado', ['ENVIADO','RECIBIDO'])
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->paginate(10),
        ]);
    }

    public function recibeProveedor($id){
        $this->orden = OrdenesServicio::find($id);
        $this->orden->Estado = 'RECIBIDO';
        $this->orden->save(); 
    }
}
