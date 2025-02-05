<?php

namespace App\Http\Requests;

use App\Models\Contrato;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContratoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contrato_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:contratos,id',
        ];
    }
}
