<?php
	use App\Http\Controllers\PanelAdmin\SuscripcionesController as PanelSuscripciones;
	
	Route::prefix('PanelAdministrativo')->middleware('admin')->group(function(){
        Route::resource('suscripciones', PanelSuscripciones::class);
        Route::get('suscriptions/{id}',[PanelSuscripciones::class, 'getSuscriptions']);
    });
?>