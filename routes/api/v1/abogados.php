<?php
    use App\Http\Controllers\Abogados\SuscripcionesController as Suscripciones;
    
    Route::prefix('Abogado')->group(function(){
        Route::resource('suscripciones', Suscripciones::class);
    });
?>