<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    protected $table ='TB_TECNICOS';
    protected $primaryKey = 'IdTecnicos';

    public $timestamps = false;

    public function zona(){
        return $this->belongsTo('App\Models\Zona','varZona','IdZonas');
    }
    
}
