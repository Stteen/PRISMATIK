<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "TB_CLIENTES";
    protected $primaryKey = 'IdClientes';
    public $timestamp = false;

    public function zona(){
        return $this->belongsTo('App\Models\Zona','varZona','IdZonas');
    }

    public function tecnico(){
        return $this->belongsTo('App\Models\Tecnico','varTecnicoAsig','IdTecnicos');
    }
}
