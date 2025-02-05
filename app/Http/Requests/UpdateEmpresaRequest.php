<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmpresaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empresa_edit');
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
                'unique:empresas,ruc,' . request()->route('empresa')->id,
            ],
        ];
    }
}
