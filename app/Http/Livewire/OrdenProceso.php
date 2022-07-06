<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrdenesServicio;
use App\Models\OrdenDetalle;
use App\Models\User;
use App\Models\Proveedor;

class OrdenProceso extends Component
{
    use WithPagination;
    public $accion, $orden, $detalles;
    
    protected $paginationTheme = 'bootstrap';

    public $rules = [
        'detalles.*.enviadas' => 'required',
    ];

    public function render()
    {
        return view('livewire.orden-proceso', [
            'ordenes' => OrdenesServicio::whereIn('Estado', ['RECIBIDO','PENDIENTE'])
            ->where('varProveedor', auth()->user()->proveedor_id)
            ->orderBy('IdOrdenServicio', 'DESC')
            ->paginate(10),
        ]);
    }

    public function mount(){
      
    }

    public function verOrden($id){
        $this->orden = OrdenesServicio::find($id);
        $this->accion = 'verOrden';
    }

    public function diligenciar($id){
        $this->orden = OrdenesServicio::find($id);
        $this->detalles = [];
        $this->accion = 'diligenciarOrden';
    }

    public function envioParcial($id){
        $this->validate();
      
        $ordenDetalles = OrdenDetalle::find($id);
        
        foreach($this->detalles as $key => $envio) {
             $ordenDetalles->enviadas = $envio['enviadas']; 
          
        /* Si la orden no contiene pendientes y la cantidad es mayor que le cantidad que envia alamacenara los pendientes a enviar */
           if($ordenDetalles->cantidad >= $envio || $ordenDetalles->pendientes == ''){
            $ordenDetalles->pendientes = $ordenDetalles->cantidad - $envio['enviadas'];

            $this->orden->Estado = 'PENDIENTE';
            $this->orden->save();
        } 
        
        /* En caso de que pendientes exista la resta se le hara directamente al pendientes y la cantidad enviada */
          elseif($ordenDetalles->pendientes !== ""){
            $ordenDetalles->enviadas = $ordenDetalles->enviadas + $envio['enviadas']; 
            $ordenDetalles->pendientes = $ordenDetalles->pendientes - $ordenDetalles->enviadas;
            if($ordenDetalles->pendientes <= $ordenDetalles->pendientes){
                $ordenDetalles->pendientes = 0;
            }
            $this->orden->Estado = 'PENDIENTE';
            $this->orden->save();
        }  

        $responsable = User::where('name', $this->orden->varResponsable)->first();
        $proveedor = Proveedor::where('idProveedores', $this->orden->varProveedor)->first();
     
    
        $apiURL = "https://api.ultramsg.com/instance10658/messages/chat";
        $postFields = [
        'token' => "7eyim2lkk21gjrns",
        'to' => "57".$responsable->telephone,
        'body' => 'El proveedor '.$proveedor->varNombreRazon.' ha enviado '.$envio['enviadas'].'/U productos de la orden '.$this->orden->varConsecutivo.' ingrese al maestro de ordenes al siguiente link',
        'link' => 'www.prismaap.com',
        'priority' => "1",
        'referenceId' => ''
        ];
        $headers = [
            "Content-Type', 'text/plain"
        ];
    
        $response = Http::withHeaders($headers)->post($apiURL, $postFields);
    
    }
        $ordenDetalles->save();
        $this->detalles = [];
        /* dd($this->ordenDetalles);
        $this->ordenDetalle->push(); */
        
    }

    public function volver(){
        $this->accion = '';
    }

    public function recibeProveedor($id){
        $this->orden = OrdenesServicio::find($id);
        $this->orden->Estado = 'RECIBIDO';
        
        $responsable = User::where('name', $this->orden->varResponsable)->first();
        $proveedor = Proveedor::where('idProveedores', $this->orden->varProveedor)->first();

        $apiURL = "https://api.ultramsg.com/instance10658/messages/chat";
        $postFields = [
        'token' => "7eyim2lkk21gjrns",
        'to' => "57".$responsable->telephone,
        'body' => 'El proveedor'.$proveedor->varNombreRazon.' ha recibido la orden '.$this->orden->varConsecutivo.' y rectificado las cantidades de los productos enviados',
        'link' => 'www.prismaap.com',
        'priority' => "1",
        'referenceId' => ''
        ];
        $headers = [
            "Content-Type', 'text/plain"
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postFields);

        $this->orden->save(); 
    }
}
