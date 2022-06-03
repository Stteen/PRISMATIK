<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Zona;
class Zonas extends Component
{
    public $accion, $zona;

    public $rules = [
        'zona.varNumeroZona' => 'required|string|max:255',
        'zona.varDepartamento' => 'required|string|max:255',
        'zona.varCiudad' => 'required|string|max:255',
    ];

    
    protected $validationAttributes = [
        'zona.varNumeroZona' => 'Numero de Zona',
        'zona.varDepartamento' => 'Despartamento',
        'zona.varCiudad' => 'Ciudad',
    ];

    public function crearZona(){
        $this->accion = 'formZonas';
        $this->zona = new Zona;
    }

    public function editarZona($id){
        $this->zona = Zona::find($id);
        $this->accion = 'formZonas';
    }

    public function guardarZona(){
        $this->validate();
      
        $this->zona->save();
        $this->accion = '';
    }

    public function cambiarEstado($id){
        $this->zona = Zona::find($id);
        if($this->zona->bolEstado == 1){
            $this->zona->bolEstado = 0;
        }else{
            $this->zona->bolEstado = 1;
        }
        $this->zona->save();
    }

    public function verZona($id){
        $this->zona = Zona::find($id);
        $this->accion = 'verZona';

    }

    public function volver(){
        $this->accion = '';
    }

    public function render()
    {
        return view('livewire.zonas', [
            'zonas' => Zona::paginate(10),
        ]);
    }
}
