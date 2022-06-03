<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $table ='TB_ZONAS';
    protected $primaryKey = 'IdZonas';
    public $timestamps = false;

}
