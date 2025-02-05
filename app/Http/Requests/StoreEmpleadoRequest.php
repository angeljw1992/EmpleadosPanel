<?php

namespace App\Http\Requests;

use App\Models\Empleado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmpleadoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empleado_create');
    }

    public function rules()
    {
        return [
            'id_employee' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:empleados,id_employee',
            ],
            'first_name' => [
                'string',
                'min:3',
                'max:40',
                'required',
            ],
            'last_names' => [
                'string',
                'min:3',
                'max:40',
                'required',
            ],
            'cedula' => [
                'string',
                'required',
                'unique:empleados',
            ],
            'direccion' => [
                'string',
                'required',
            ],
            'correo' => [
                'required',
            ],
            'unidad_de_negocio_id' => [
                'required',
                'integer',
            ],
            'fecha_nacimiento' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
