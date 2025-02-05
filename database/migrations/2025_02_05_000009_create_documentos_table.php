<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_vencimiento_verde')->nullable();
            $table->date('fecha_vencimiento_blanco')->nullable();
            $table->timestamps();
        });
    }
}
