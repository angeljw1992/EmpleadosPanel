<?php

namespace App\Http\Requests;

use App\Models\Empleado;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmpleadoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empleado_edit');
    }

    public function rules()
    {
        return [
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
