<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContratosTable extends Migration
{
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id', 'contrato_fk_10426381')->references('id')->on('empleados');
        });
    }
}
