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

        $responsable = User::where('name', $this->orden->varResponsable)->first();
        $proveedor = Proveedor::where('idProveedores', $this->orden->varProveedor)->first();

        $apiURL = "https://api.ultramsg.com/instance10658/messages/chat";
        $postFields = [
        'token' => "7eyim2lkk21gjrns",
        'to' => "57".$responsable->telephone,
        'body' => 'El proveedor '.$proveedor->varNombreRazon.' ha aprobado la orden '.$this->orden->varConsecutivo.' para revisar ingresa al siguiente link',
        'link' => 'www.prismaap.com',
        'priority' => "1",
        'referenceId' => ''
        ];
        $headers = [
            "Content-Type', 'text/plain"
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postFields);

        $this->orden->save();
        $this->accion = "";
    }

    public function rechazarOrden(){
        $this->orden->Estado = 'RECHAZADA';
        
        $responsable = User::where('name', $this->orden->varResponsable)->first();
        $proveedor = Proveedor::where('idProveedores', $this->orden->varProveedor)->first();

        $apiURL = "https://api.ultramsg.com/instance10658/messages/chat";
        $postFields = [
        'token' => "7eyim2lkk21gjrns",
        'to' => "57".$responsable->telephone,
        'body' => 'El proveedor '.$proveedor->varNombreRazon.' ha rechazado la orden '.$this->orden->varConsecutivo.' para revisar ingresa al siguiente link',
        'link' => 'www.prismaap.com',
        'priority' => "1",
        'referenceId' => ''
        ];
        $headers = [
            "Content-Type', 'text/plain"
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postFields);

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
