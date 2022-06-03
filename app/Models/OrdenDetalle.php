<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    use HasFactory;
    
    protected $table = 'TB_ORDENDETALLE';
    protected $primaryKey = 'IdOrdenDetalle';
    public $timestamps = false;
   

    public function producto(){
        return $this->belongsTo('App\Models\Producto','ref_entrada','IdPortafolio');
    }

    public function productoSale(){
        return $this->belongsTo('App\Models\Producto','ref_salida','IdPortafolio');
    }
    
}
