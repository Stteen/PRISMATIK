<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'TB_PORTAFOLIO';
    protected $primaryKey = 'IdPortafolio';
    public $timestamps = false;
}
