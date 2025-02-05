<?php

namespace App\Http\Requests;

use App\Models\Documento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('documento_edit');
    }

    public function rules()
    {
        return [
            'empleado_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
