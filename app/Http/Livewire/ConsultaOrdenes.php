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
use Livewire\WithFileUploads;

class ConsultaOrdenes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $proveedor, $accion, $pendientes, $abiertas, $cerradas, $totalGeneradas;

    public function volver(){
        $this->accion = '';
    }

    public function pendientes($id){
        $this->pendientes = OrdenesServicio::where('varProveedor', $id)
        ->where('Estado', 'ENVIADO')
        ->orderBy('IdOrdenServicio', 'DESC')->get();
        $this->accion = "Pendientes";
    }

    public function abiertas($id){
        $this->abiertas = OrdenesServicio::where('varProveedor', $id)
        ->where('Estado', 'RECIBIDO')
        ->orderBy('IdOrdenServicio', 'DESC')->get();
        $this->accion = "Abiertas";
    }

    public function cerradas($id){
        $this->cerradas = OrdenesServicio::where('varProveedor', $id)
        ->where('Estado', 'FINALIZADO')
        ->orderBy('IdOrdenServicio', 'DESC')->get();
        $this->accion = "Cerradas";
    }

    public function totalGeneradas($id){
        $this->totalGeneradas = OrdenesServicio::where('varProveedor', $id)
        ->orderBy('IdOrdenServicio', 'DESC')->get();
        $this->accion = "totalGeneradas";
    }

    public function verOrden($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = "verOrden";
    }

    public function render()
    {
       
        return view('livewire.consulta-ordenes', [
            'ordenes' => OrdenesServicio::groupBy('varProveedor')->paginate(10),
        ]);
    }

}
