<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesServicio extends Model
{
    protected $table = "TB_ORDENSERVICIO";
    protected $primaryKey = 'IdOrdenServicio';
    public $timestamps = false;

    public function ordenDetalles(){
        return $this->hasMany('App\Models\OrdenDetalle','orden_id','IdOrdenServicio');
    }

    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor','varProveedor','IdProveedores');
    }
    
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente','varCliente','IdClientes');
    }


    use HasFactory;
}
