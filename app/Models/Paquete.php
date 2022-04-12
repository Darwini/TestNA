<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    use HasFactory;
    
    protected $table = 'paquetes';

    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'status',
    ];

    public function suscripciones(){
    	// return $this->hasMany('Class', 'nombre_clave_foranea', 'nombre_clave_primaria_local');
        return $this->hasMany(Pago::class, 'paquete_id', 'id');
    }
}
