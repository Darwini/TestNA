<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_credit_cards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre_titular', 250);
            $table->string('apellido_titular', 250);
            $table->string('numero_tarjeta', 20);
            $table->string('referencia_pago', 250);
            $table->date('fecha_expiracion');
            $table->unsignedTinyInteger('codigo_seguridad');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_credit_cards');
    }
}
