<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentosTable extends Migration
{
    public function up()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'empleado_fk_10429294')->references('id')->on('empleados');
        });
    }
}
