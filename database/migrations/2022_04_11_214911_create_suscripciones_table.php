<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('paquete_id');
            $table->string('codigo');
            $table->string('costo');
            $table->string('tipo_cobro');
            $table->unsignedTinyInteger('status')->default(2);
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
        Schema::dropIfExists('suscripciones');
    }
}
