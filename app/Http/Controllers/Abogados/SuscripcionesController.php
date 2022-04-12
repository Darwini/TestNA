<?php

namespace App\Http\Controllers\Abogados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestSuscripcion;

use App\Models\Suscripcion;
use App\Models\Pago;
use App\Models\UserCreditCard as creditCard;
use DB;

class SuscripcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'abogado']);
    }

    public function index(Request $request)
    {
        $datos = [
            'resp' => true,
            'suscripciones' => $request->user()->suscripcion,
        ];
        return response()->json($datos, 200);
    }

    public function store(RequestSuscripcion $request){
        $vS = $this->verificarSuscripcion($request);
        if($vS === true){
            $costo = '200 $';
            // Transacción para asegurar la integridad de la bd, en caso de fallar alguna consulta, fallarán todas
            DB::beginTransaction($request);
            // Realizar el proceso de suscripción y recibir el id que se creó para su reutilizacion
            $cS = $this->crearSuscripcion($request, $costo);
            // Registro de los datos de la tarjeta de crédito
            $rTC = $this->registrarTarjetaCredito($request);
            $rP = $this->registrarPago($costo, $cS, $rTC->id);
            DB::commit();
        }else{
            return response()->json(['resp' => false, 'msj' => 'usted ya posee suscripciones activas'], 200);
        }

        return response()->json([
            'resp' => true,
            'msj' => 'Suscripción procesada correctamente, en breve comprobaremos su pago.',
        ], 200);
    }

    public function update(RequestSuscripcion $request, $id)
    {
        // Busqueda del dato de la suscripción
        $s = Suscripcion::findOrFail($id);
        // Llamado a la función de actualización
        $this->actualizarSuscripcion($request, $s);
        // Emisión de respuesta
        return response()->json(['resp' => $s, 'msj' => 'Sus datos han sido actualizados'], 200);
    }

    public function destroy($id)
    {
        // Transacción 
        DB::beginTransaction();
            $s = Suscripcion::findOrFail($id);
            foreach($s->pagos as $pagos){
                foreach($pagos->creditcard as $creditcard){
                    $creditcard->update(['status' => 3]);
                    $creditcard->delete();
                }
            }
            foreach($s->pagos as $pagos){ $pagos->update(['status' => 0]);$pagos->delete(); }
            $s->update(['status' => 0]);
            $s->delete();
        DB::commit();
        return response()->json(['resp' => true, 'msj' => 'Los datos se han eliminados'], 200);
    }

    // Verificación de que haya una y solo una suscripción para el usuario.
    private function verificarSuscripcion($request){
        $v = $request->user()->has('suscripcion')->first() ? $request->user()->has('suscripcion')->first() : false;
        $r = $v != false ? $request->user()->suscripcion->whereIn('status', [1, 2])->first() : true;
        return $r;
    }

    private function crearSuscripcion($request, $costo){
        // Datos necesarios para la tabla
        $suscripcion = [
            'user_id' => $request->user()->id,
            'paquete_id' => $request->paquete_id,
            'codigo' => Suscripcion::codigo(),
            'costo' => $costo,
            'tipo_cobro' => 'mensual',
        ];
        // Realiza la inserción y devuelve el id del nuevo registro
        return Suscripcion::insertGetId($suscripcion);
    }

    private function actualizarSuscripcion($request, $s)
    {
        // Si el campo existe y es diferente de vacio, se actualiza el campo
        if(!empty($request->paquete_id)){
            $s->update(['paquete_id' => $request->paquete_id]);
        }
        // Si el campo existe y es diferente de vacio, se actualiza el campo
        if (!empty($request->tipo_cobro)){
            $s->update(['tipo_cobro' => $request->tipo_cobro]);
        }
        // Devuelve verdadero
        return true;
    }


    private function registrarTarjetaCredito($request){
        // Datos requeridos para la transacción
        $tc = [
            'user_id' => $request->user()->id,
            'nombre_titular' => $request->nombre_titular,
            'apellido_titular' => $request->apellido_titular,
            'referencia_pago' => $request->referencia_pago,
            'fecha_expiracion' => $request->fecha_expiracion,
            'codigo_seguridad' => $request->codigo_seguridad,
        ];
        // Si la tarjeta de credito ya existe, se actualiza, sino se registra
        return creditCard::updateOrCreate(['numero_tarjeta' => $request->numero_tarjeta], $tc);
    }

    private function registrarPago($costo, $id, $tc)
    {
        $pago = [
            'suscripcion_id' => $id,
            'credit_card_id' => $tc,
            'codigo' => Pago::codigo(),
            'monto_total' => floatval(preg_replace('/[^0-9]+/', '', $costo)),
        ];
        return Pago::create($pago);
    }
}
