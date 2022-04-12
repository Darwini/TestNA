<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserCreditCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_credit_cards';

    protected $fillable = [
    	'user_id',
    	'nombre_titular',
    	'apellido_titular',
    	'numero_tarjeta',
    	'referencia_pago',
    	'fecha_expiracion',
    	'codigo_seguridad',
    	'status',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	// return $this->belongsTo('App\Writer', 'nombre_clave_foranea', 'nombre_clave_otra_tabla');
    	return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
