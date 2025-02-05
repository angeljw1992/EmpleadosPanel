<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_employee')->unique();
            $table->string('first_name');
            $table->string('last_names');
            $table->string('cedula')->unique();
            $table->string('direccion');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }
}
