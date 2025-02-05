<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmpresaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empresa_create');
    }

    public function rules()
    {
        return [
            'businessname' => [
                'string',
                'nullable',
            ],
            'ruc' => [
                'string',
                'required',
                'unique:empresas',
            ],
        ];
    }
}
