<?php

namespace App\Http\Requests;

use App\Models\Contrato;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContratoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contrato_edit');
    }

    public function rules()
    {
        return [
            'contrato_id' => [
                'required',
                'integer',
            ],
            'contratodesde' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'contratohasta' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'contratoestado' => [
                'required',
            ],
        ];
    }
}
