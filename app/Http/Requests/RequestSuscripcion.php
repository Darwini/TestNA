<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSuscripcion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paquete_id' => 'required|exists:paquetes,id',
            'nombre_titular' => 'required',
            'apellido_titular' => 'required',
            'numero_tarjeta' => 'required|numeric|unique:users_credit_cards,numero_tarjeta',
            'fecha_expiracion' => 'required',
            'codigo_seguridad' => 'required|min:3|max:4',
        ];
    }
}
