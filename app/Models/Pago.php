<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pagos';

    protected $fillable = [
        'suscripcion_id',
        'credit_card_id',
        'codigo',
        'monto_total',
        'reintentos',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static protected function codigo()
    {
        $idMax = Pago::max('id');
        $max = Pago::where('id', $idMax)->select('codigo')->first();
        $number = ($idMax) ? intval(preg_replace('/[^0-9]+/', '', $max->codigo)) + 1 : 1001;
        return 'Pago'.$number;
    }

    public function creditcard()
    {
        // return $this->hasMany('Class', 'nombre_clave_foranea', 'nombre_clave_primaria_local');
        return $this->hasMany(UserCreditCard::class, 'id', 'credit_card_id');
    }
}
