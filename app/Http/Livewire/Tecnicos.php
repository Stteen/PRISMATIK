<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tecnico;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;

class Tecnicos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $accion, $tecnico;

    public $rules = [
        'tecnico.varTipoIden' => 'required',
        'tecnico.varNumeroDoc' => 'required',
        'tecnico.varNombreRazon' => 'required',
        'tecnico.varTelefono' => 'required',
        'tecnico.varDireccion' => 'required',
        'tecnico.varCorreo' => 'required',
        'tecnico.varNombreCont' => 'required',
        'tecnico.varTelefonoCont' => 'required',
        'tecnico.varZona' => 'required',
    ];

    protected $validationAttributes = [
        'tecnico.varTipoIden'    => 'Tipo de Identificación',
        'tecnico.varNumeroDoc'   => 'Número de identificación',
        'tecnico.varNombreRazon' => 'Nombre o Razón Social',
        'tecnico.varTelefono'    => 'Teléfono',
        'tecnico.varDireccion'   => 'Dirección',
        'tecnico.varCorreo'      => 'Correo Electrónico',
        'tecnico.varNombreCont'  => 'Nombre de Contacto',
        'tecnico.varTelefonoCont' => 'Teléfono de Contacto',
        'tecnico.varZona'         => 'Zona',
    ];

    public function render()
    {
        return view('livewire.tecnicos', [
            'tecnicos' => Tecnico::orderBy('IdTecnicos', 'DESC')->paginate(10),
        ]);
    }

    public function volver(){
        $this->accion = '';
    }

    public function crearTecnico(){
        $this->resetValidation();
        $this->accion = 'formTecnicos';
        $this->tecnico = new Tecnico;

    }

    public function guardarTecnico(){
        $this->validate();
       $this->tecnico->save();
        $this->accion = '';
    }

    public function diligenciarTecnico($id){
        $this->tecnico = Tecnico::find($id);

        $this->accion = 'formTecnicos';
    }

    public function verTecnico($id){
        $this->tecnico = Tecnico::find($id);

        $this->accion = 'verTecnico';
    }
}
