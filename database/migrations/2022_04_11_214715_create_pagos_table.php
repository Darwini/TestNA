<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedInteger('suscripcion_id');
            $table->unsignedInteger('credit_card_id');
            $table->string('codigo');
            $table->decimal('monto_total', 10, 2);
            $table->unsignedTinyInteger('reintentos')->default(0);
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
        Schema::dropIfExists('pagos');
    }
}
