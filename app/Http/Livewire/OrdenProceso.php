<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrdenesServicio;
use App\Models\OrdenDetalle;

class OrdenProceso extends Component
{
    use WithPagination;
    public $accion, $orden, $ordenDetalle;
    protected $paginationTheme = 'bootstrap';

    public $rules = [
        'orden.ordenDetalle.*.enviadas' => 'required',
    ];

    public function render()
    {
        return view('livewire.orden-proceso', [
            'ordenes' => OrdenesServicio::whereIn('Estado', ['ENVIADO','RECIBIDO'])
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->paginate(10),
        ]);
    }

    public function verOrden($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = 'verOrden';
    }

    public function diligenciar($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = 'diligenciarOrden';
    }

    public function envioParcial($id){
        $this->validate();
        $this->ordenDetalle = OrdenDetalle::find($id);
        $this->ordenDetalle->enviadas = $this->orden->ordenDetalle['enviadas'];
        dd($this->ordenDetalle);
        $this->ordenDetalle->push();
        
    }

    public function volver(){
        $this->accion = '';
    }

    public function recibeProveedor($id){
        $this->orden = OrdenesServicio::find($id);
        $this->orden->Estado = 'RECIBIDO';
        $this->orden->save(); 
    }
}
