<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Productos extends Component
{
    use WithFileUploads;

    public $accion, $producto, $productos, $photo; 
    public $mensaje=[];
    
    protected $rules = [
    'producto.varReferencia' => 'required',
    'photo' => 'required|image',
    'producto.varDescripcion' => 'required',
    'producto.varColor' => 'required',
    ];

    protected $validationAttributes = [
        'producto.varReferencia' => 'Referencia',
        'photo' => 'Imagen del Producto',
        'producto.varDescripcion' => 'Descripcion',
        'producto.varColor' => 'Color',
    ];

    public function render()
    {
        $this->productos = Http::get(env('API_URL').'/portfolio/getAllComplete')->json();
        return view('livewire.productos');
    }

    public function action($action){
        $this->accion = $action;
    }

    public function volver(){
        $this->mensaje = '';
        $this->accion = '';
    }

    public function crearProducto(){
        $this->resetValidation();
        $this->mensaje = "";
        $this->producto = [];
        $this->photo = null;    
        $this->accion = 'formProducto';
    }

    public function guardarProducto(){
        $this->validate();
        if(isset($this->producto['IdPortafolio'])){
               /* actualizar la url de una imagen */
                $nombrePhoto = $this->photo->getClientOriginalName();
                $this->producto['varImagenProd'] = Storage::url('app/'.$this->photo->storeAs('image/productos', $nombrePhoto));

                $this->producto['varTipoProducto'] = "Lavaplatos";
                
            $response=Http::put(env('API_URL').'/portfolio/updateById',$this->producto)->json();
        }else{
           
            $this->producto['bolEstado'] = 1;
                $nombrePhoto = $this->photo->getClientOriginalName();
                $filePath = Storage::url('app/'.$this->photo->storeAs('image/productos', $nombrePhoto));
                $this->producto['varImagenProd'] = $filePath;
                $this->producto['varTipoProducto'] = "CONJUNTO DUCHA";
                $response=Http::post(env('API_URL').'/portfolio/create',$this->producto)->json();
        }

         /* En caso de que el envio sea verdadero enviara un mensaje de tipo success */
         if($response!==FALSE){
            $this->accion="";
            $this->mensaje=["type"=>"success","message"=>"Producto creado correctamente"];
        }
        /* En caso contrario mostrara una alerta de color roja indicando que no pudo ser creado */
        else{
            $this->mensaje=["type"=>"danger","message"=>"Error al crear el producto"];
        }

    }

    public function verProducto($id){
        $this->accion = 'verProducto';
        $this->mensaje = "";
        $this->producto = Http::get(env('API_URL').'/portfolio/getById?id='.$id)->json();

        $this->producto['varImagenProd'] = str_replace('/storage/app/','',$this->producto['varImagenProd']);
        $this->photo = 'data:'.Storage::mimeType($this->producto['varImagenProd']).';base64, '.base64_encode(Storage::get($this->producto['varImagenProd']));
     
    } 

    public function editProducto($id){
        $this->accion = "formProducto";
        $this->mensaje = "";
        $this->producto = Http::get(env('API_URL').'/portfolio/getById?id='.$id)->json();
        $this->producto['varImagenProd'] = str_replace('/storage/app/','',$this->producto['varImagenProd']);
        $this->photo = 'data:'.Storage::mimeType($this->producto['varImagenProd']).';base64, '.base64_encode(Storage::get($this->producto['varImagenProd']));
     
    }


}
