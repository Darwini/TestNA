<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suscripciones';

    protected $fillable = [
        'user_id',
        'paquete_id',
        'codigo',
        'costo',
        'tipo_cobro',
        'status',
    ];

    protected $dates = ['deleted_at'];

    // Inverso de relación muchos a uno
    public function user()
    {
        // return $this->belongsTo('Clase', 'nombre_clave_foranea', 'nombre_clave_otra_tabla');
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    // Relación uno a muchos
    public function pagos()
    {
        // return $this->hasMany('Clase', 'nombre_clave_foranea', 'nombre_clave_primaria_local');
        return $this->hasMany(Pago::class, 'suscripcion_id', 'id');
    }

    // Inverso de relación muchos a uno
    public function paquetes()
    {
        // return $this->belongsTo('Clase', 'nombre_clave_foranea', 'nombre_clave_otra_tabla');
        return $this->belongsTo(Paquete::class, 'id', 'paquete_id');
    }

    static protected function codigo(){
        $idMax = Suscripcion::max('id');
        $max = Suscripcion::where('id', $idMax)->select('codigo')->first();
        $number = ($idMax) ? intval(preg_replace('/[^0-9]+/', '', $max->codigo)) + 1 : 1001;
        return 'Susc-'.$number;
    }
    
}
