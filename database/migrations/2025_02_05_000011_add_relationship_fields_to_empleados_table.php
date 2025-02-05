<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('unidad_de_negocio_id')->nullable();
            $table->foreign('unidad_de_negocio_id', 'unidad_de_negocio_fk_10426352')->references('id')->on('empresas');
            $table->unsignedBigInteger('prueba_contrato_id')->nullable();
            $table->foreign('prueba_contrato_id', 'prueba_contrato_fk_10429259')->references('id')->on('contratos');
        });
    }
}
