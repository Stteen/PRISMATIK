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

    
    public function recibeProveedor(){
        $this->orden->Estado = 'RECIBIDO';
    
        $responsable = User::where('name', $this->orden->varResponsable)->first();
        $proveedor = Proveedor::where('idProveedores', $this->orden->varProveedor)->first();

        $apiURL = "https://api.ultramsg.com/instance10658/messages/chat";
        $postFields = [
        'token' => "7eyim2lkk21gjrns",
        'to' => "57".$responsable->telephone,
        'body' => 'El proveedor '.$proveedor->varNombreRazon.' ha recibido la orden '.$this->orden->varConsecutivo.' y rectificado las cantidades y productos enviados',
        'link' => 'www.prismaap.com',
        'priority' => "1",
        'referenceId' => ''
        ];
        $headers = [
            "Content-Type', 'text/plain"
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postFields);

        $this->orden->save(); 
        $this->accion = '';
    }

    public function volver(){
        $this->accion = '';
    }

}
