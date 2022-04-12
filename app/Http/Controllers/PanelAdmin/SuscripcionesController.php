<?php

namespace App\Http\Controllers\PanelAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Suscripcion;
use App\Http\Controllers\Abogados\SuscripcionesController as Susa;
use DB;

class SuscripcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'admin']);
    }

    public function index(Request $request)
    {
        $stat = !empty($request->status) ? $status : 'activas';
        $validos = ['activas' => 1, 'inactivas' => 0];
        
        $datos = [
            'resp' => true,
            'Suscripciones' => Suscripcion::where('status', $validos[$stat])->withTrashed()->get(),
        ];
        return response()->json($datos, 200);
    }

    public function show($id)
    {
        $suscripcion = Suscripcion::firstOrFail($id);
        $datos = [
            'Suscripcion' => $suscripcion,
            'Pagos' => $suscripcion->pagos,
        ];
        return response()->json($datos, 200);
    }

    public function destroy($id)
    {
        $susa = new Susa();
        return $susa->destroy($id);
    }
}
