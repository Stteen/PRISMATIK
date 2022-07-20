<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;

class Productos extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $accion, $producto, $photo; 
    
    public $rules = [
    'producto.varReferencia' => 'required',
    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'producto.varDescripcion' => 'required',
    'producto.varTipoProducto' => 'required',
    'producto.varColor' => 'required',
    ];

    protected $validationAttributes = [
        'producto.varReferencia' => 'Referencia',
        'photo' => 'Imagen del Producto',
        'producto.varDescripcion' => 'Descripcion',
        'producto.varTipoProducto' => 'Tipo de Producto',
        'producto.varColor' => 'Color',
    ];

    public function volver(){
        $this->accion = '';
    }

    public function crearProducto(){
        $this->resetValidation();
        $this->producto = new Producto;
        $this->photo = null;    
        $this->accion = 'formProducto';
    }

    public function guardarProducto(){
        $this->validate();
        $this->producto->save();
        
               /* actualizar la url de una imagen si esta contiene valor */
               $nombrePhoto = $this->photo->getClientOriginalName();
               if(isset($this->photo)){
               
                $this->producto->varImagenProd = Storage::url('app/'.$this->photo->storeAs('image/productos', $nombrePhoto));
               }

      
        $this->producto->save();
        $this->accion = '';

    }

    public function verProducto($id){
        $this->accion = 'verProducto';

        $this->producto = Producto::find($id);

        $imagenURL = str_replace('/storage/app/','',$this->producto->varImagenProd);
        $this->photo = 'data:'.Storage::mimeType($imagenURL).';base64, '.base64_encode(Storage::get($imagenURL));
     
    } 

    public function editProducto($id){
        $this->resetValidation();
        $this->accion = "formProducto";
        $this->producto = Producto::find($id);
        $imagenURL = str_replace('/storage/app/','',$this->producto->varImagenProd);
        $this->photo = 'data:'.Storage::mimeType($imagenURL).';base64, '.base64_encode(Storage::get($imagenURL));
     
    }

    public function cambiarEstado($id){

        $this->producto = Producto::find($id);
        $this->producto->bolEstado = ($this->producto->bolEstado == '1') ? '0' : '1';
          $this->producto->save();
 
     }

    
    public function render()
    {
  
        return view('livewire.productos', [
            'productos' => Producto::orderBy('IdPortafolio', 'DESC')->paginate(10),
        ]);
    }


}
